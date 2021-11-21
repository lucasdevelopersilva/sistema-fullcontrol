<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;
    
     protected $fillable = [
        'name',
        'email',
        'cpf',
        'phone',
        'promotion_id'
    ];
    
     public function promotion(){
        return $this->belongsTo(Promotion::class);
    }
}
