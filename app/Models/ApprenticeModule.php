<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprenticeModule extends Model
{
    use HasFactory;

    protected $table = 'apprentice_module';

    protected $fillable = [
        'start_date',
        'end_date',
        'grade',
    ];

    public function apprentice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Apprentice::class);
    }

    public function module(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}
