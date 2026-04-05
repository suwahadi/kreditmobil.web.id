<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Category;
use App\Models\Leasing;
use App\Models\CarModel;
use App\Models\CarType;
use App\Models\CarColor;
use App\Models\Lead;
use App\Models\Customer;
use App\Models\News;
use App\Models\Promo;
use App\Policies\UserPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\LeasingPolicy;
use App\Policies\CarModelPolicy;
use App\Policies\CarTypePolicy;
use App\Policies\CarColorPolicy;
use App\Policies\LeadPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\NewsPolicy;
use App\Policies\PromoPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Category::class => CategoryPolicy::class,
        Leasing::class => LeasingPolicy::class,
        CarModel::class => CarModelPolicy::class,
        CarType::class => CarTypePolicy::class,
        CarColor::class => CarColorPolicy::class,
        Lead::class => LeadPolicy::class,
        News::class => NewsPolicy::class,
        Promo::class => PromoPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
        //
    }
}
