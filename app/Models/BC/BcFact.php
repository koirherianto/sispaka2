<?php

namespace App\Models\BC;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class BcFact extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    public $table = 'bc_facts';

    public $fillable = [
        'backward_chaining_id',
        'name',
        'code_name',
        'value_fact'
    ];

    protected $casts = [
        'name' => 'string',
        'code_name' => 'string',
        'value_fact' => 'float'
    ];

    public static array $rules = [
        'backward_chaining_id' => 'required',
        'name' => 'required|string|max:200',
        'code_name' => 'required|string|max:100',
        'value_fact' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function backwardChaining(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\BC\BackwardChaining::class, 'backward_chaining_id');
    }

    public function bcQuestions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\BC\BcQuestion::class, 'bc_fact_id');
    }
}
