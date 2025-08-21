<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;
use App\Models\User;
class Department extends Model
{
    //
    protected $fillable=['user_id','department_name','head_of_department_id'];

    public function users(){
        return $this->hasMany(User::class);
    }
    
    public function head_of_department(){
        return $this->belongsTo(User::class,'head_of_department_id');
    }

    public function ticket(){
        return $this->hasMany(Ticket::class);
    }
}
