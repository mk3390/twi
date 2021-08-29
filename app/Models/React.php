<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class React extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'post_id', 'type'];

    protected $data = [];

    public function validate($request)
    {
        $this->data = $request;
    }

    public function store()
    {
        $react = React::where('user_id', $this->data['user_id'])->where('post_id', $this->data['post_id'])->where('type', $this->data['type'])->first();
        if ($react) {
            return $react->delete();
        }
        return $this->create($this->data);
    }
}
