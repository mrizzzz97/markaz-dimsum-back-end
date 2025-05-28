<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'Dimsum mix isi 50 HALAL HARGA PABRIK',
                'price' => 105000,
                'stock' => 20,
                'rating' => 4.9,
                'image' => 'images/products/isi 50.png',
                'description' => 'Dimsum frozen isi 50, halal, harga pabrik.'
            ],
            [
                'name' => 'Dimsum mix isi 20 HALAL HARGA PABRIK',
                'price' => 50000,
                'stock' => 15,
                'rating' => 4.9,
                'image' => 'images/products/isi 20.jpg',
                'description' => 'Dimsum frozen isi 20, halal, harga pabrik.'
            ],
            [
                'name' => 'Dimsum mix isi 100 HALAL HARGA PABRIK',
                'price' => 210000,
                'stock' => 10,
                'rating' => 4.9,
                'image' => 'images/products/isi 100.png',
                'description' => 'Dimsum frozen isi 100, halal, harga pabrik.'
            ],
            [
                'name' => 'Dimsum mentai',
                'price' => 26000,
                'stock' => 12,
                'rating' => 4.9,
                'image' => 'images/products/mentai.png',
                'description' => 'Dimsum mentai matang.'
            ],
            [
                'name' => 'Sambosa Isi Daging Sapi Isi 9',
                'price' => 40000,
                'stock' => 7,
                'rating' => 4.7,
                'image' => 'images/products/sambosa.jpg',
                'description' => 'Sambosa isi daging sapi, isi 9.'
            ],
            [
                'name' => 'Bento homemade kaki Naga isi 10',
                'price' => 25000,
                'stock' => 9,
                'rating' => 5.0,
                'image' => 'images/products/bento.jpg',
                'description' => 'Bento homemade kaki naga isi 10.'
            ],
            [
                'name' => 'Saos Dimsum',
                'price' => 6000,
                'stock' => 30,
                'rating' => 4.9,
                'image' => 'images/products/saos.jpg',
                'description' => 'Saos dimsum homemade.'
            ],
            [
                'name' => 'Dimsum isi 3 (Tartar)',
                'price' => 12000,
                'stock' => 25,
                'rating' => 4.8,
                'image' => 'images/products/tartar.png',
                'description' => 'Dimsum isi 3 (Tartar).'
            ],
        ]);
    }
}
