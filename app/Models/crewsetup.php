<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class crewsetup extends Model
{
    use HasFactory;
    protected $table = 'crew_setup';
    protected $fillable = [
        'id', // Add 'id' to the fillable array
        'crewboss_id',
        'job_id',
        'labor_contructor',
        'comission_rate',
        'wage_rate',
        'crewboss_wage_high',
        'crewboss_wage_low',
        'graft_chainsaw',
        'lunch_break',
        'break1',
        'break2',
        'status',
    ];

    public $timestamps = true;

    public function users(){
        return $this->belongsTo(User::class, 'crewboss_id', 'id');

    }

    public function jobs(){
        return $this->belongsTo(Jobdescription::class, 'job_id', 'id');
    }

}
