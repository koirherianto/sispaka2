<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Str;

class Project extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    public $table = 'projects';

    public $fillable = [
        'title',
        'status_publish',
        'slug',
        'short_description',
        'tag_keyword',
        'description',
    ];

    protected $casts = [
        'title' => 'string',
        'status_publish' => 'string',
        'slug' => 'string',
        'short_description' => 'string',
        'tag_keyword' => 'string',
        'description' => 'string'
    ];

    public static array $rules = [
        'title' => 'required|string|max:100',
        'status_publish' => 'required|string',
        'slug' => 'required|string|max:130,unique:projects.slug', 
        'short_description' => 'required|string|max:160',
        'tag_keyword' => 'required|string|max:45',
        'description' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static function createUniqueSlug($title) : string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        // Cek apakah slug sudah digunakan sebelumnya
        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function backwardChainings(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(\App\Models\BC\BackwardChaining::class, 'project_id');
    }

    public function contributors(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Contributor::class, 'project_id');
    }

    public function methods(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Method::class, 'project_has_methods');
    }

    public function sessionProject(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(\App\Models\User::class, 'session_project');
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\User::class, 'user_has_projects');
    }
}
