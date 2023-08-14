<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Builder extends Model
{
    use HasFactory;
    
    public function getBuilderName()
    {
        return $this->belongsTo('App\Models\Property', 'builder_id', 'id');
    }
    
    public function builderName()
    {
        return $this->hasMany('App\Models\Property', 'builder_id', 'id');
    }
}
