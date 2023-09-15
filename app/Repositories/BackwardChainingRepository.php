<?php

namespace App\Repositories;

use App\Models\BackwardChaining;
use App\Repositories\BaseRepository;

class BackwardChainingRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'project_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return BackwardChaining::class;
    }
}
