<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acre extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function ranch(){
        return $this->belongsTo(Ranch::class, 'ranch_id', 'id');
    }

}
