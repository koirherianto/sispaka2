<?php

namespace App\Repositories;

use App\Models\Permision;
use App\Repositories\BaseRepository;

class PermisionRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'guard_name'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Permision::class;
    }
}
