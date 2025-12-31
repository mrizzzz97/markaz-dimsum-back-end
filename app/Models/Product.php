<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'stock',
        'rating',
        'image',
        'description',
        'tokopedia_url',
        'shopee_url',
        'offline_available',
    ];

}
