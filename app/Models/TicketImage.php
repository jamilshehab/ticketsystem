<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketImage extends Model
{
    //
    protected $fillable=['ticket_id','path'];
    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }
}
