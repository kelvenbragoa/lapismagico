<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tax(){
        return $this->hasOne('App\Models\Taxes', 'id', 'tax_id');
    }
}
