<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'apprentice_id',
        'manager_id',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        // when manager sends notification to apprentice remove any old value from cache
        static::created(function (Notification $notification) {
            Cache::forget('notification-count-' . $notification->apprentice->user->id);
        });

        // when manger deletes notification remove value from cache
        static::deleted(function (Notification $notification) {
            Cache::forget('notification-count-' . $notification->manager->user->id);
        });

        // when apprentice accepts or denies notification value forgotten from cache
        static::updating(function (Notification $notification) {
            Cache::forget('notification-count-' . $notification->manager->user->id);
            Cache::forget('notification-count-' . $notification->apprentice->user->id);
        });
    }

    public function apprentice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Apprentice::class);
    }

    public function manager(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Manager::class);
    }
}
