<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class MessageGroup extends Model
{
    use HasFactory;
    
    /**
     * Get all of the user for the MessageGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function members()
    {
        return $this->belongsToMany(User::class, MessageGroupMember::class,'group_id','member_id');
    }
}
