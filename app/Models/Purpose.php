<?php

namespace App\Models;

use Database\Factories\PurposeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Purpose extends Model
{
    use HasFactory;

    protected $guarded = [];

    const SMILEYS = ['225-happy2','227-smile2','253-wondering2','239-angry-2'];
    const STANDARD_PURPOSES  = ['Très satisfait(e)', 'Satisfait(e)','Peu satisfait(e)','Très insatisfait(e)'];


    /**
     * @return PurposeFactory
     */
    public static function newFactory(): PurposeFactory
    {

        return PurposeFactory::new();

    }

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * @return BelongsTo
     */
    public function questions(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

}
