<?php

namespace App;

use App\BaseModel;

class Pesanan extends BaseModel
{
    protected $fillable = [
		'customer_id',
    	'penerima',
        'email',
    	'alamat',
    	'propinsi_id',
        'kota_id',
    	'kodepos',
    	'jumlah',
    	'diskon',
    	'ongkir',
    	'total',
        'kode_pesanan',
    	'metode_pengiriman',
    ];

    protected $casts = [
        'metode_pengiriman' => 'array',
    ];

    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'pesanan_details')->withPivot('id', 'pesanan_id', 'produk_id', 'quantity', 'jumlah')->withTimestamps();
    }

    public function tambahProduk(Produk $produk, $quantity = 1)
    {
        $adjusmentQuantity = $quantity;

        // jika stock < request order
        if ($produk->stock < $adjusmentQuantity) return false;

        // masukkan data pesanan detail
        // jika produk yang sama sudah ada ambil quantity nya
        foreach ($this->produks as $produk_pesanan) {
            if ($produk_pesanan->pivot->produk_id == $produk->id) 
            {
                $quantity += $produk_pesanan->pivot->quantity;
                $this->produks()->detach($produk->id);
            }
        }

        $detail = [
            'produk' => $produk->produk,
            'harga' => $produk->isSale ? $produk->harga_diskon : $produk->harga,
            'quantity' => $quantity,
            'diskon' => $produk->isSale ? $produk->harga - $produk->harga_diskon : 0,
        ];
        // hitung jumlah
        $detail['jumlah'] = $detail['harga'] * $detail['quantity'];
        // masukkan ke pesanan;
        $this->produks()->attach($produk->id, $detail);

        // adjustment stock produk
        $produk->decrement('stock', $adjusmentQuantity);

        // hitung subtotal
        $jumlah = $this->produks()->sum('jumlah');

        // set adjusment total 
        $adjusmentTotal = $jumlah - $this->jumlah;

        // update subtotal pesanan
        $this->jumlah = $jumlah;
        
        // update total
        $this->increment('total', $adjusmentTotal);
        $this->save();
    }

    public function kurangProduk(Produk $produk, $quantity = 1)
    {

        // masukkan data pesanan detail
        // jika produk yang sama sudah ada ambil quantity nya
        foreach ($this->produks as $produk_pesanan) {
            if ($produk_pesanan->pivot->produk_id == $produk->id) 
            {
                // jika quantity = 'all' maka quantity = 0 atau quantity * -1
                if ($quantity == 'all') $quantity = $produk_pesanan->pivot->quantity;
                // set adjustent stock
                $adjusmentQuantity = $quantity;
                // quantity dijadikan (minus)
                $quantity *= -1; 
                $quantity += $produk_pesanan->pivot->quantity; 
                $this->produks()->detach($produk->id);
            }
        }


        if ($quantity > 0)
        {
            $detail = [
                'produk' => $produk->produk,
                'harga' => $produk->isSale ? $produk->harga_diskon : $produk->harga,
                'quantity' => $quantity,
                'diskon' => $produk->isSale ? $produk->harga - $produk->harga_diskon : 0,
            ];
            // hitung jumlah
            $detail['jumlah'] = $detail['harga'] * $detail['quantity'];
            // masukkan ke pesanan;
            $this->produks()->attach($produk->id, $detail);
        }

        // adjustment stock produk
        $produk->increment('stock', $adjusmentQuantity);

        // hitung subtotal
        $jumlah = $this->produks()->sum('jumlah');

        // set adjusment total 
        $adjusmentTotal = $jumlah - $this->jumlah;

        // update subtotal pesanan
        $this->jumlah = $jumlah;
        
        // update total
        $this->increment('total', $adjusmentTotal);
        $this->save();
    }

    public function updatePesanan($all_produks)
    {
        foreach ($this->produks as $produk) 
        {
            if (!isset($all_produks[$produk->slug])) continue;

            $adjusmentQuantity = min($produk->stock, $all_produks[$produk->slug] - $produk->pivot->quantity);

            if ($adjusmentQuantity == 0) continue;

            $produk->pivot->increment('quantity', $adjusmentQuantity);

            $produk->decrement('stock', $adjusmentQuantity);

            if ($produk->pivot->quantity <= 0) $this->produks()->detach($produk->id);
        }

        // hitung subtotal
        $jumlah = $this->produks()->sum('jumlah');

        // set adjusment total 
        $adjusmentTotal = $jumlah - $this->jumlah;

        // update subtotal pesanan
        $this->jumlah = $jumlah;
        
        // update total
        $this->increment('total', $adjusmentTotal);
        $this->save();
    }
}   
