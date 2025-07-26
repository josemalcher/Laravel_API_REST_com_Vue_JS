<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = ['name', 'price'];

    protected $with = ['categories'];

    protected $withCount = ['categories'];

    // protected $guarded = []; // permite tudo

/*    public  function price():Attribute
    {
        return new Attribute(
            get: fn($price) => $price / 100
        );
    }*/
    protected $casts = [
        'created_at' => 'date:d-m-Y',
    ];
    protected $appends = ['price_float'];
    protected function priceFloat(): Attribute
    {
        return new Attribute(
            get: fn ($price, $attributes) => $attributes['price'] / 100,
        );
    }
//    protected function serializeDate(DateTimeInterface $date)
//    {
//        return $date->format('Y-m-d H:i:s');
//    }
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
