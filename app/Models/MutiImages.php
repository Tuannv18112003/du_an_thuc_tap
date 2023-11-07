<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutiImages extends Model
{
    use HasFactory;

    public function books() {
        return $this->belongsTo(Books::class);
    }  

    protected $fillable = ['book_id', 'photo_name'];

    protected $casts = [
        'photo_name' => 'array',
    ];
}
