<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apprentice extends Model
{
    use HasFactory;

     protected $fillable = [
         'user_id',
         'candidate_number',
         'start_date',
         'end_date',
     ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function modules(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Module::class)->withPivot('start_date', 'end_date', 'grade', 'id');
    }

    public function managers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Manager::class);
    }

//    public function getProgrammeStartDate(){
//        return $this->modules()->orderByDesc('pivot_start_date')->first()->pivot->start_date;
//    }

//    public function getProgrammeEndDate(){
//        return $this->modules()->orderByDesc('pivot_end_date')->first()->pivot->end_date;
//    }
}


