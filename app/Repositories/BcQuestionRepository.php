<?php

namespace App\Repositories;

use App\Models\BcQuestion;
use App\Repositories\BaseRepository;

class BcQuestionRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'bc_result_id',
        'bc_fact_id',
        'question',
        'code_name'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return BcQuestion::class;
    }
}
