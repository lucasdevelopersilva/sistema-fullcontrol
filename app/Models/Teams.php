<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;
    
     protected $fillable = [
        'user_id',
        "name",
        "description",
        "cover",
        "status"
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}