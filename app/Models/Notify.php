<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'status',  
        'cover',  
        "user_id"
    ];
    
     public function user(){
        return $this->belongsTo(User::class);
    }
}
