<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomizeProduct extends Model
{
    protected $guarded = [];
    public $timestamps  = false;
    protected $table = 'customize_products';
}
