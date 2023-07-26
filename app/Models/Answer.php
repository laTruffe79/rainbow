<?php

namespace App\Models;

use Database\Factories\AnswerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Answer extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    /**
     * @return AnswerFactory
     */
    public static function newFactory(): AnswerFactory
    {
        return AnswerFactory::new();
    }

    /**
     * @return BelongsTo
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }


    /**
     * @return BelongsTo
     */
    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }

    /**
     * @return BelongsTo
     */
    public function purpose(): BelongsTo
    {
        return $this->belongsTo(AvailablePurpose::class,'available_purpose_id');
    }

    /**
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

}
