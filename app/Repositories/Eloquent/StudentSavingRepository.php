<?php

namespace App\Repositories\Eloquent;

use App\Models\StudentSaving;
use App\Repositories\Contracts\StudentSavingRepositoryInterface;

class StudentSavingRepository extends BaseRepository implements StudentSavingRepositoryInterface
{
    public function __construct(StudentSaving $model)
    {
        parent::__construct($model);
    }
}