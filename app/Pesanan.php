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
        'kode_pesanan',
        'metode_pengiriman',
    	'no_hp',
    ];

    protected $appends = ['total', 'total_rupiah'];

    protected $rupiahs = ['ongkir', 'jumlah'];

    protected $casts = [
        'metode_pengiriman' => 'array',
    ];

    public function getTotalAttribute()
    {
        return $this->jumlah + $this->ongkir;
    }

    public function getTotalRupiahAttribute()
    {
        return 'Rp '.number_format($this->jumlah + $this->ongkir, 0, ',','.');
    }

    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'pesanan_details')->withPivot('id', 'pesanan_id', 'produk_id', 'quantity', 'harga', 'jumlah')->withTimestamps();
    }

    public function calculateTotal()
    {
        // hitung subtotal
        $jumlah = $this->produks()->sum('jumlah');

        // update subtotal pesanan
        $this->jumlah = $jumlah;
        
        $this->save();
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

        // calculate total
        $this->calculateTotal();
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

        // calculate total
        $this->calculateTotal();
    }

    public function updatePesanan($all_produks)
    {
        foreach ($this->produks as $produk) 
        {
            if (!isset($all_produks[$produk->slug])) continue;

            $adjusmentQuantity = min($produk->stock, $all_produks[$produk->slug] - $produk->pivot->quantity);
            // dd($adjusmentQuantity);

            if ($adjusmentQuantity == 0) continue;

            $produk->pivot->increment('quantity', $adjusmentQuantity);
            
            $jumlah = $produk->pivot->harga * $produk->pivot->quantity;
            // masukkan ke pesanan;
            $this->produks()->updateExistingPivot($produk->id, compact('jumlah'));
            
            $produk->decrement('stock', $adjusmentQuantity);

            if ($produk->pivot->quantity <= 0) $this->produks()->detach($produk->id);
        }

        // calculate total
        $this->calculateTotal();
    }

    public function update(Array $attributes = [])
    {
        parent::update($attributes);

        $this->calculateTotal();
    }
}   
