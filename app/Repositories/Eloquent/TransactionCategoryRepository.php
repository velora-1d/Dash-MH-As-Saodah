<?php

namespace App\Repositories\Eloquent;

use App\Models\TransactionCategory;
use App\Repositories\Contracts\TransactionCategoryRepositoryInterface;

class TransactionCategoryRepository extends BaseRepository implements TransactionCategoryRepositoryInterface
{
    public function __construct(TransactionCategory $model)
    {
        parent::__construct($model);
    }
}