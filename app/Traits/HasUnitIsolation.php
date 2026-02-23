<?php

namespace App\Traits;

use App\Models\UserScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait HasUnitIsolation
{
    /**
     * Boot the trait and apply the global scope and creating listener.
     */
    protected static function bootHasUnitIsolation()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $user = Auth::user();
                // Set entity_id and unit_id if not already set
                if (!$model->unit_id) {
                    $scope = UserScope::where('user_id', $user->id)
                        ->whereNotNull('unit_id')
                        ->first();
                        
                    if ($scope) {
                        $model->unit_id = $scope->unit_id;
                        $model->entity_id = $scope->entity_id;
                    }
                }
            }
        });

        static::addGlobalScope('unit_isolation', function (Builder $builder) {
            if (Auth::check()) {
                /** @var \App\Models\User $user */
                $user = Auth::user();
                $isGlobal = in_array($user->role, ['superadmin', 'kepsek', 'bendahara']);
                
                if (!$isGlobal) {
                    $unitIds = UserScope::where('user_id', $user->id)
                        ->whereNotNull('unit_id')
                        ->pluck('unit_id');
                    
                    $builder->whereIn($builder->getQuery()->from . '.unit_id', $unitIds);
                }
            }
        });
    }

    /**
     * Scope a query to only include specific unit.
     */
    public function scopeForUnit(Builder $query, $unitId)
    {
        return $query->where('unit_id', $unitId);
    }
}
