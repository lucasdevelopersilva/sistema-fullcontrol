<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'status',
        'timestart',
        'timeend',
        'repeat',
        "user_id"
    ];
    
      public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function participant(){
        return $this->hasMany(Participant::class);
    }
    
}
