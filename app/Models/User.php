<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use hasRoles;
    public $table = 'users';

    public $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'remember_token' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255|string|max:255',
        'email' => 'nullable|string|max:255|nullable|string|max:255',
        'email_verified_at' => 'nullable|nullable',
        'password' => 'required|string|max:255|string|max:255',
        'remember_token' => 'nullable|string|max:100|nullable|string|max:100',
        'created_at' => 'nullable|nullable',
        'updated_at' => 'nullable|nullable',
        'deleted_at' => 'nullable|nullable'
    ];

    public function projects() : \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'user_has_projects', 'user_id', 'project_id');
    }

    public function sessionProjects()
    {
        return $this->belongsTo(Project::class,'session_project');
    }
}
