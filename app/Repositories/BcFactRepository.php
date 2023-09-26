<?php

namespace App\Repositories;

use App\Models\BC\BcFact;
use App\Repositories\BaseRepository;

class BcFactRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'backward_chaining_id',
        'name',
        'code_name',
        'value_fact'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return BcFact::class;
    }
}
