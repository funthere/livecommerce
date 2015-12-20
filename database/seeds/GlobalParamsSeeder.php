<?php

use Illuminate\Database\Seeder;
use App\Param;

class GlobalParamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	\Cache::forget('global_params');
    	DB::table('params')->truncate();
        Param::create(['key' => 'nama_toko', 'value' => 'Irin Nuget']);
        Param::create(['key' => 'deskripsi_toko', 'value' => 'Irin Nuget adalah distributor nugget terpecaya berlokasi di bilangan kota bekasi']);
        Param::create(['key' => 'alamat_toko', 'value' => 'Jalan Raya Kota Bekasi, Bekasi, Jawa Barat']);
        Param::create(['key' => 'nama_perusahaan', 'value' => 'PT. Irin Nuget Sentosa']);
        Param::create(['key' => 'telepon', 'value' => '085710340924']);
        Param::create(['key' => 'email', 'value' => 'irinnuget@gmail.com']);
        Param::create(['key' => 'facebook', 'value' => 'https://facebook.com/irin.nuget']);
        Param::create(['key' => 'twitter', 'value' => 'http://twitter.com/irin_nuget']);
        Param::create(['key' => 'lama_hari_produk_baru', 'value' => '7']);

        
    }
}
