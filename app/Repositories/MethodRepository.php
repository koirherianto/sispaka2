<?php

namespace App\Repositories;

use App\Models\Method;
use App\Repositories\BaseRepository;

class MethodRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'slug',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Method::class;
    }
}
