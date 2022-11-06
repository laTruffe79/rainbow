<?php

namespace App\Models;

use Database\Factories\QuestionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Question extends Model
{
    use HasFactory;

    const IMAGES_ARRAY = ['buddies','grandma','having_fun','inlove','pride','waiting'];
    const QUESTIONS_ARRAY = [
        'Êtes vous satisfait(e) du contenu de l\'intervention ?',
        'Êtes vous satisfait(e) de la possibilité de prendre la parole ?',
        'Vous vous sentiez à l\'aise pour parler du sujet ?',
        'Avez-vous appris quelque chose ?',
        'Êtes vous satisfait(e) de la compétence de l\'intervenant ?',
        'Êtes vous satisfait(e) des vidéos ?'
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
        return $this->hasMany(Purpose::class);
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

}
