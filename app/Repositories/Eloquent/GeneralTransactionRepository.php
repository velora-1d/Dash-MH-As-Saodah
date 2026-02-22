<?php

namespace App\Repositories\Eloquent;

use App\Models\GeneralTransaction;
use App\Repositories\Contracts\GeneralTransactionRepositoryInterface;

class GeneralTransactionRepository extends BaseRepository implements GeneralTransactionRepositoryInterface
{
    public function __construct(GeneralTransaction $model)
    {
        parent::__construct($model);
    }
}