<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'stream', 
        'token_notify',
        'id_notify',
        'facebook',
        'instagram',
        'whatsapp',
        'twitter',
        'site',
        'logotipo',
        'background',
        'webtv',
        'user_id'
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
