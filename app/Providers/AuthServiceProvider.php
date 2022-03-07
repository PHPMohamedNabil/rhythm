<?php

namespace App\Providers;

use App\Models\Category;
use App\Policies\CategoryPolicy;
use App\Models\Question;
use App\Policies\QuestionPolicy;
use App\Models\Page;
use App\Policies\PagePolicy;
use App\Models\ShortCut;
use App\Policies\ShortCutPolicy;
use App\Models\SystemLink;
use App\Policies\SystemLinkPolicy;
use App\Models\Wall;
use App\Policies\WallPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         Category::class => CategoryPolicy::class,
         Question::class => QuestionPolicy::class,
         Page::class     => PagePolicy::class,
         ShortCut::class     => ShortCutPolicy::class,
         SystemLink::class     => SystemLinkPolicy::class,
         Wall::class     => WallPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
