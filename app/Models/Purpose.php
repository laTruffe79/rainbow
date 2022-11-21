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

    const SMILEYS = [
        'icon-fontawesome.svgs.regular.face-laugh-beam',
        'icon-fontawesome.svgs.regular.face-smile',
        'icon-fontawesome.svgs.regular.face-meh',
        'icon-fontawesome.svgs.regular.face-frown'
    ];
    const STANDARD_PURPOSES  =
        [
            'Très satisfait(e)',
            'Satisfait(e)',
            'Peu satisfait(e)',
            'Insatisfait(e)',
        ];

    const STANDARD_PURPOSES2  =
        [
            'Très utile',
            'Utile',
            'Peu utile',
            'Inutile',
        ];

    const STANDARD_PURPOSES3  =
        [
            'Oui',
            'Non',
        ];



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
