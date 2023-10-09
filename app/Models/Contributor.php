<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    public $table = 'contributors';

    public $fillable = [
        'project_id',
        'user_id',
        'name',
        'contribution',
        'email',
        'contact'
    ];

    protected $casts = [
        'name' => 'string',
        'contribution' => 'string',
        'email' => 'string',
        'contact' => 'string'
    ];

    public static array $rules = [
        'project_id' => 'required',
        'user_id' => 'nullable',
        'name' => 'nullable|string|max:45',
        'contribution' => 'nullable|string|max:45',
        'email' => 'nullable|string|max:255',
        'contact' => 'nullable|string|max:45',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
