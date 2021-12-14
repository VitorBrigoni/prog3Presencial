<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    
    public $timestamps = false;

    public function getAuthIdentifierName(){
        return 'id';
    }
    public function getAuthIdentifier(){
        return $this->id;
    }
    public function getAuthPassword(){
        return $this->password;
    }
    public function getRememberToken(){
        return $this->remember_token;
    }
    public function setRememberToken($value){
        $this->remember_token = $value;
    }
    public function getRememberTokenName(){
        return 'remember_token';
    }

    protected $hidden = [
        'password',
       ];
}
