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
    	'kota_id',
    	'propinsi_id',
    	'kodepos',
    	'jumlah',
    	'diskon',
    	'ongkir',
    	'total',
    	'kode_pesanan',
    ];

    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'pesanan_details')->withPivot('pesanan_id', 'produk_id', 'quantity', 'jumlah')->withTimestamps();
    }

    public function tambahProduk(Produk $produk, $quantity = 1)
    {
        // masukkan data pesanan detail
        // jika produk yang sama sudah ada ambil quantity nya
        foreach ($this->produks as $produk_pesanan) {
            if ($produk_pesanan->pivot->produk_id == $produk->id) 
            {
                $quantity += $produk_pesanan->pivot->quantity;
                $this->produks()->detach($produk->   id);
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

        // hitung total
        $total = $this->produks()->sum('jumlah');

        // update total pesanan
        $this->total = $total;
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
                // quantity dijadikan (minus)
                $quantity *= -1; 
                $quantity += $produk_pesanan->pivot->quantity;
                $this->produks()->detach($produk->   id);
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

        // hitung total
        $total = $this->produks()->sum('jumlah');

        // update total pesanan
        $this->total = $total;
        $this->save();
    }
}
