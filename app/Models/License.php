<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    public $table = 'licences';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
