<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$add = new User;
    	$add->name = "Admin";
    	$add->email ="admin@gmail.com";
    	$add->password = Hash::make("123456789");
    	$add->save();


       	 Shop::factory()->count(100)->create();
    }
}
