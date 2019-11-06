<?php

namespace Dewsign\NovaEvents\Providers;

use Dewsign\NovaEvents\Models\Event;
use Illuminate\Support\Facades\Gate;
use Dewsign\NovaEvents\Models\EventCategory;
use Dewsign\NovaEvents\Models\EventLocation;
use Dewsign\NovaEvents\Policies\EventPolicy;
use Dewsign\NovaEvents\Models\EventOrganiser;
use Silvanite\Brandenburg\Traits\ValidatesPermissions;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    use ValidatesPermissions;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Event::class => EventPolicy::class,
        EventCategory::class => EventPolicy::class,
        EventLocation::class => EventPolicy::class,
        EventOrganiser::class => EventPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        collect([
            'viewEvents',
            'manageEvents',
        ])->each(function ($permission) {
            Gate::define($permission, function ($user) use ($permission) {
                if ($this->nobodyHasAccess($permission)) {
                    return true;
                }
                return $user->hasRoleWithPermission($permission);
            });
        });

        $this->registerPolicies();
    }
}
