<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'host', 'type_type', 'type_id', 'deleted'];

    public function store($data)
    {
        $this->name = $data['name'];
        $this->host = $data['host'];
        $this->type_type = $data['type_type'];
        $this->type_id = $data['type_id'];
        $this->save();
    }

    public function productable(){
        return $this->morphTo('type','type','type_id');   
    }
}
