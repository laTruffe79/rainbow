<?php

namespace App\Models;

use Database\Factories\SessionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Session extends Model
{
    use HasFactory;

    const DEFAULT_SESSION_TITLE = 'Classes 3eA à 3eC';

    protected $guarded = [];
    protected $table = 'sessions';

    /**
     * @return SessionFactory
     */
    public static function newFactory(): SessionFactory
    {
        return SessionFactory::new();
    }

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * @return HasMany
     */
    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    /**
     * @return BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * @return BelongsTo
     */
    public function animator(): BelongsTo
    {
        return $this->belongsTo(Animator::class);
    }

    /**
     * @return BelongsTo
     */
    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class);
    }

}
