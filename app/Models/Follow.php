<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'followed_by', 'following_to', 'status'];

    public function follower()
    {
        return $this->belongsTo(User::class, 'followed_by', 'id');
    }

    public function following()
    {
        return $this->belongsTo(User::class, 'following_to', 'id');
    }
}
