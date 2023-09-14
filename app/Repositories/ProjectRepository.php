<?php

namespace App\Repositories;

use App\Models\Project;
use App\Repositories\BaseRepository;

class ProjectRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title',
        'status_publish',
        'institution',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Project::class;
    }
}
