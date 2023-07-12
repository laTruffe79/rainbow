<?php

namespace App\Models;

use Database\Factories\SurveyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Survey extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    const STANDARD_SURVEY_TITLE = 'Votre avis est important';
    const STANDARD_SURVEY_DESCRIPTION = 'description du questionnaire standard avec commentaires etc...';
    const STANDARD_SURVEY_ILLUSTRATIONS = [
        'undraw.buddies',
        'undraw.grandma',
        'undraw.having_fun',
        'undraw.inlove',
        'undraw.waiting',
        'undraw.pride',
    ];
    /**
     * @return SurveyFactory
     */
    public static function newFactory(): SurveyFactory
    {
        return SurveyFactory::new();
    }

    /**
     * @return HasMany
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

    /**
     * @return BelongsToMany
     */
    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class)->orderBy('id','asc');
    }


}
