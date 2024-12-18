<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allocatelabor extends Model
{
    use HasFactory;
    protected $table = 'allocatelabor';
    protected $fillable = ['client_id','date', 'crew_boss', 'people', 'ranch_id', 'block_id', 'acre_id', 'description', 'time', 'total_amount', 'boss_amount', 'status'];

    public $timestamps = true;


    public function crewuser(){
        return $this->belongsTo(User::class, 'crew_boss','id');
    }

    public function clientuser(){
        return $this->belongsTo(User::class, 'client_id','id');
    }
    
    public function ranchuser(){
        return $this->belongsTo(Ranch::class, 'ranch_id','id');
    }
    
    public function blockuser(){
        return $this->belongsTo(Block::class, 'block_id','id');
    }
    public function acreuser(){
        return $this->belongsTo(Acre::class, 'acre_id','id');
    }

    public function jobuser(){
        return $this->belongsTo(Jobdescription::class, 'description','id');
    }


}
