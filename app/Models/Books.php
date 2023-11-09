<?php

namespace App\Models;

use App\Enums\BooksStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Books extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'rating',
        'selling_price',
        'discount_price',
        'image',
        'multi_image',
        'short_title',
        'description',
        'category_id'
    ];

    protected $casts = [
        'multi_image' => 'array',
        // 'status' =>  BooksStatus::class
    ];

    public function categories() {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }

    public function mutiImages() {
        return $this->hasMany(mutiImages::class);
    }
}
