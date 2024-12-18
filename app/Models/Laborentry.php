<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laborentry extends Model
{
    use HasFactory;
    protected $table = 'labor_entry';
    protected $fillable = ['client_id', 'entry_date', 'crew_boss', 'of_people', 'ranch_id', 'block_id', 'acre_id', 'job_id', 'amount', 'starttime', 'endtime', 'status'];

    public $timestamps = true;

    public function laboruser(){
        return $this->belongsTo(User::class, 'crew_boss', 'id');
    }
    public function crewuser(){
        return $this->belongsTo(User::class, 'of_people', 'id');
    }

    public function clientuser(){
        return $this->belongsTo(User::class, 'client_id','id');
    }

    public function ranchuser(){
        return $this->belongsTo(Ranch::class, 'ranch_id', 'id');
    }
    public function blockuser(){
        return $this->belongsTo(Block::class, 'block_id', 'id');
    }
    public function jobuser(){
        return $this->belongsTo(Jobdescription::class, 'job_id', 'id');
    }
    
}
