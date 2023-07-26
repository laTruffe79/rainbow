<?php

namespace App\Models;

use Database\Factories\QuestionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;


class Question extends Model
{
    use HasFactory, SoftDeletes;

    const IMAGES_ARRAY = ['buddies','grandma','having_fun','inlove','pride','waiting'];
    const QUESTIONS_ARRAY = [
        'Êtes vous satisfait(e) du contenu de l\'intervention ?',
        'Vous vous sentiez à l\'aise pour prendre la parole ?',
        'Avez-vous appris quelque chose ?',
        'Êtes vous satisfait(e) de la compétence de l\'intervenant ?',
    ];

    const QUESTIONS_ARRAY3 = [
        'Cette intervention a-t-elle changé votre regard sur l\'homosexualité et la transidentité de façon positive ?',
    ];
    const QUESTIONS_ARRAY2 = [
        'À l\'issue de cette intervention, quel est votre ressenti ? ',
    ];


    protected $guarded = [];

    public static function newFactory(): QuestionFactory
    {
        return QuestionFactory::new();
    }
    /**
     * @return HasMany
     */
    public function purposes(): HasMany
    {
        return $this->hasMany(Purpose::class)->orderBy('order');
    }

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * @return BelongsToMany
     */
    public function surveys(): BelongsToMany
    {
        return $this->belongsToMany(Survey::class);
    }

    /**
     * @return BelongsToMany
     */
    public function purposesThroughAnswers():BelongsToMany
    {
        return $this->belongsToMany(AvailablePurpose::class,'answers','available_purpose_id');
    }

}
