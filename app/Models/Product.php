<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
// use Carbon\Carbon;
// use BeyondCode\Vouchers\Facades\Vouchers;

class Product extends Model
{
    use HasFactory, SoftDeletes, Sluggable;


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'product_name_en'
            ]
        ];
    }
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function sizes()
    {
        return $this->hasMany(Size::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }


    // //************* voucher method */
    // /**
    //  * @param int $amount
    //  * @param array $data
    //  * @param null $expires_at
    //  * @return Voucher[]
    //  */
    // public function createVouchers(int $amount, array $data = [], $expires_at = null)
    // {
    //     return Vouchers::create($this, $amount, $data, $expires_at);
    // }
}
