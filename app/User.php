<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'phone',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function savedProduct()
    {
        return $this->hasMany(SavedProduct::class);
    }

    public function checkSavedProduct($id)
    {
        return $this->savedProduct()->where('product_id', $id)->count();
    }

    public function socialAccount()
    {
        return $this->hasOne(SocialAccount::class);
    }

    public function checkRole($role)
    {
        // 1 = buyer, 2 = admin
        if($role == 'buyer')
            return $this->role == 1;

        if($role == 'admin')
            return $this->role == 2;
    }


}
