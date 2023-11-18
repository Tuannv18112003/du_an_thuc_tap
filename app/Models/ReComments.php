<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReComments extends Model
{
    use HasFactory;

    protected $table = 'recomments';

    protected $fillable = [
        'user_id',
        'comment_id',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->orderBy('created_at', 'desc');
    }
}
