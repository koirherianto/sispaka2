<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BcQuestion extends Model
{
    public $table = 'bc_questions';

    public $fillable = [
        'bc_result_id',
        'bc_fact_id',
        'question',
        'code_name'
    ];

    protected $casts = [
        'question' => 'string',
        'code_name' => 'string'
    ];

    public static array $rules = [
        'bc_result_id' => 'required',
        'bc_fact_id' => 'required',
        'question' => 'required|string|max:254',
        'code_name' => 'required|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function bcFact(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\BcFact::class, 'bc_fact_id');
    }

    public function bcResult(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\BcResult::class, 'bc_result_id');
    }
}
