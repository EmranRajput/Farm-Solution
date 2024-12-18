<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function ranch()
    {
        return $this->belongsTo(Ranch::class);
    }
    public function acres()
    {
        return $this->hasMany(Acre::class);
    }

   
    public function setuppage()
    {
        return $this->hasOne(setuppage::class, 'block_id','id');
    }


}
