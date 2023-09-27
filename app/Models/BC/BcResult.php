<?php

namespace App\Models\BC;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class BcResult extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    public $table = 'bc_results';

    public $fillable = [
        'backward_chaining_id',
        'name',
        'code_name',
        'reason',
        'solution'
    ];

    protected $casts = [
        'name' => 'string',
        'code_name' => 'string',
        'reason' => 'string',
        'solution' => 'string'
    ];

    public static array $rules = [
        'backward_chaining_id' => 'required',
        'name' => 'required|string|max:200',
        'code_name' => 'required|string|max:100',
        'description' => 'nullable|string|max:65535',
        'description' => 'nullable|string|max:65535',
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
        return $this->hasMany(\App\Models\BC\BcQuestion::class, 'bc_result_id');
    }
}
