<?php

namespace App\Models;

use App\Events\ProductCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use function Illuminate\Events\queueable;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'price',
        'userId'
    ];


    protected $dispatchesEvents = [

        'saved'=> ProductCreated::class
    ];

/*    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }*/
}
