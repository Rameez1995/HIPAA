<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use Notifiable;

    protected $guard = 'vendor';

    protected $fillable = [
           'firstname','lastname','email', 'password','category_id','training_id','company_id','amount','status'
        ];

    protected $hidden = [
            'password', 'remember_token',
        ];

    public function companies()
    {
        return $this->belongsTo(Company::class, 'company_id','id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }

    public function trainings()
    {
        return $this->belongsTo(Training::class, 'training_id','id');
    }
 }