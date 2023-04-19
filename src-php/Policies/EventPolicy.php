<?php

namespace Dewsign\NovaEvents\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Authenticatable;

class EventPolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {
        return Gate::any(['viewEvents', 'manageEvents']);
    }

    public function view($model)
    {
        return Gate::any(['viewEvents', 'manageEvents'], $model);
    }

    public function create($user)
    {
        return $user->can('manageEvents');
    }

    public function update($user, $model)
    {
        return $user->can('manageEvents', $model);
    }

    public function delete($user, $model)
    {
        return $user->can('manageEvents', $model);
    }

    public function restore($user, $model)
    {
        return $user->can('manageEvents', $model);
    }

    public function forceDelete($user, $model)
    {
        return $user->can('manageEvents', $model);
    }

    public function viewInactive(?Authenticatable $user, $model)
    {
        if (config('maxfactor-support.canViewInactive')) {
            return true;
        }
        if ($model->active) {
            return true;
        }
        if (Gate::allows('viewNova')) {
            return true;
        }
        return false;
    }
}
