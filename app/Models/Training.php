<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id','training_name','pass_percentage','description','image','status','category_id'
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }

    public function quizes()
    {
    	return $this->hasMany(Quiz::class);
    }

    public function resources()
    {
    	return $this->hasMany(Resource::class);
    }

    public function vendors()
    {
        return $this->hasOne(Vendor::class);
    }
}
