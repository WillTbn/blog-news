<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;

class BlogNew extends Model
{
    use HasFactory;
    protected $fillable = [
        'hash_id',
        'title',
        'content',
        'photo',
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
    public function getPhotoAttribute($value)
    {
        return asset('storage/'.$value);
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}
