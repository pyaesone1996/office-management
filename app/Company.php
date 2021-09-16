<?php

namespace App;

use App\Department;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];

    public function departments()
    {
        return $this->belongsToMany(Department::class)->withTimestamps();
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
