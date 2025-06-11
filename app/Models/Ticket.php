<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
 class Ticket extends Model
{
    //
    protected $fillable=["title","content","image","user_id"];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
