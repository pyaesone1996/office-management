<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded = [];

    public function companies()
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
