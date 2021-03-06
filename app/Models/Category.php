<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id','category_name',
    ];

    public function trainings()
    {
    	return $this->hasMany(Training::class);
    }

    
    public function vendors()
    {
        return $this->hasOne(Vendor::class);
    }
}
