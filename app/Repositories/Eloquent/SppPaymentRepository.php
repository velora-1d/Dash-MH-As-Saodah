<?php

namespace App\Repositories\Eloquent;

use App\Models\SppPayment;
use App\Repositories\Contracts\SppPaymentRepositoryInterface;

class SppPaymentRepository extends BaseRepository implements SppPaymentRepositoryInterface
{
    public function __construct(SppPayment $model)
    {
        parent::__construct($model);
    }
}