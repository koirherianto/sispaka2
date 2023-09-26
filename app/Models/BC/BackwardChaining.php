<?php

namespace App\Models\BC;

use Illuminate\Database\Eloquent\Model;

class BackwardChaining extends Model
{
    public $table = 'backward_chainings';

    public $fillable = [
        'project_id'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'project_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }

    public function bcFacts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\BC\BcFact::class, 'backward_chaining_id');
    }

    public function bcResults(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\BC\BcResult::class, 'backward_chaining_id');
    }
}
