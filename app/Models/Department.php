<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;
use App\Models\User;
class Department extends Model
{
    //
    protected $fillable=['user_id','department_name'];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function ticket(){
        return $this->hasMany(Ticket::class);
    }
}
