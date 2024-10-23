<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BlogNew extends Model
{
    use HasFactory;
    protected $fillable = [
        'hash_id',
        'title',
        'content',
        'hash_id',
    ];

    public function comments():HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function user():HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function scopeCountComment($query){
        return $query->withCount('comments');
    }
}
