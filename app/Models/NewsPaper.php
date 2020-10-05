<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsPaper extends Model
{
    use HasFactory;

    public function Language(){
        return $this->belongsTo(Language::class);
    }

    public function Country(){
        return $this->belongsTo(Country::class);
    }
}
