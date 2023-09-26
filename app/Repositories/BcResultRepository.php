<?php

namespace App\Repositories;

use App\Models\BC\BcResult;
use App\Repositories\BaseRepository;

class BcResultRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'backward_chaining_id',
        'name',
        'code_name',
        'reason',
        'solution'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return BcResult::class;
    }
}
