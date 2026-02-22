<?php

namespace App\Repositories\Eloquent;

use App\Models\SppBill;
use App\Repositories\Contracts\SppBillRepositoryInterface;

class SppBillRepository extends BaseRepository implements SppBillRepositoryInterface
{
    public function __construct(SppBill $model)
    {
        parent::__construct($model);
    }
}