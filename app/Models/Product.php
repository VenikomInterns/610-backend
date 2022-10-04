<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $name
 * @property mixed $price
 * @property mixed $description
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }//good

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }//good
}
