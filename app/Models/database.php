<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class database extends Model
{
    use HasFactory;
    protected $table = 'database';
    protected $fillable = ['client_id', 'date','crew_boss', 'invoice_category', 'invoice', 'company', 'people', 'ranch_id', 'block_id', 'acre_id', 'description', 'total_amount', 'full_time', 'comission', 'crewboss_amount', 'tab_type'];


    public function ranchuser(){
        return $this->belongsTo(Ranch::class, 'ranch_id','id');
    }
    
    public function blockuser(){
        return $this->belongsTo(Block::class, 'block_id','id');
    }
    
    public function jobuser(){
        return $this->belongsTo(Jobdescription::class, 'description','id');
    }
}
