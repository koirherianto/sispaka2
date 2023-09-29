<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Auth;

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
        'name' => 'required|string|max:255',
        'email' => 'nullable|string|max:255',
        'email_verified_at' => 'nullable',
        'password' => 'required|string|max:255',
        'remember_token' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function sessionProjecthasBackwardChainingMethod(): bool
    {
        $sessionProject = Auth::user()->session_project;
        $project = Project::find($sessionProject);

        // Dapatkan semua metode yang dimiliki oleh proyek ini
        $methods = $project->methods ?? [];

        // Loop melalui metode-metode dan periksa jika ada yang memiliki nama "backward-chaining"
        foreach ($methods as $method) {
            if ($method->slug === 'backward-chaining') {
                return true;
            }
        }

        return false;
    }

    public function projects() : \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'user_has_projects', 'user_id', 'project_id');
    }

    public function sessionProjects()
    {
        return $this->belongsTo(Project::class,'session_project');
    }

    
}
