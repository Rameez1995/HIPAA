<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

     protected $fillable = [
        'resource_name','description','image'
    ];


    public function trainings()
    {
        return $this->belongsTo(Training::class, 'training_id','id');
    }
}
