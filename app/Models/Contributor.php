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
        'link'
    ];

    protected $casts = [
        'name' => 'string',
        'contribution' => 'string',
        'email' => 'string',
        'link' => 'string'
    ];

    public static array $rules = [
        'project_id' => 'required',
        'user_id' => 'nullable',
        'name' => 'required|string|max:45',
        'contribution' => 'required|string|max:45',
        'email' => 'nullable|string|max:255',
        'link' => 'nullable|string|max:255',
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
