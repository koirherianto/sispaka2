<?php

namespace App\Repositories;

use App\Models\Contributor;
use App\Repositories\BaseRepository;

class ContributorRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'project_id',
        'user_id',
        'name',
        'contribution',
        'email',
        'link'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Contributor::class;
    }
}
