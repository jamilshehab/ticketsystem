<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Department;
 class Ticket extends Model
{
    //
    protected $fillable = ["title", "content", "status", "user_id", "department_id"];


    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function department(){
        return $this->belongsTo(Department::class);
    }
 public function agents()
{
    return $this->belongsToMany(User::class, 'agent_ticket', 'ticket_id', 'user_id')
                ->withPivot('department_id') // include department in pivot data
                ->whereHas('roles', fn($q) => $q->where('name', 'agent'));
}

    public function images(){
      return $this->hasMany(TicketImage::class);
    }
}
