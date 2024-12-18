<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranch extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function blocks(){
        return $this->hasMany(Block::class);
    }

    public function setuppage(){
        return $this->hasOne(setuppage::class, 'ranch_id', 'id');
    }
}
