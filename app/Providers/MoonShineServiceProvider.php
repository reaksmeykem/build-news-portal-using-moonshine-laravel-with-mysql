<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\PostResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Menu\MenuElement;
use MoonShine\Pages\Page;
use Closure;
use App\MoonShine\Resources\UserResource;
use Illuminate\Support\Facades\App;


class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [];
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [];
    }

    /**
     * @return Closure|list<MenuElement>
     */
    protected function menu(): array
    {
        return [
            // MenuGroup::make(static fn() => __('moonshine::ui.resource.system'), [
            //     MenuItem::make(
            //         static fn() => __('moonshine::ui.resource.admins_title'),
            //         new MoonShineUserResource()
            //     ),
            //     MenuItem::make(
            //         static fn() => __('moonshine::ui.resource.role_title'),
            //         new MoonShineUserRoleResource()
            //     ),
            // ]),
            MenuGroup::make('System', [
                MenuItem::make('Admins', new \Sweet1s\MoonshineRBAC\Resource\UserResource(), 'heroicons.outline.users'),
                MenuItem::make('Roles', new \Sweet1s\MoonshineRBAC\Resource\RoleResource(), 'heroicons.outline.shield-exclamation'),
                MenuItem::make('Permissions', new \Sweet1s\MoonshineRBAC\Resource\PermissionResource(), 'heroicons.outline.shield-exclamation'),
            ], 'heroicons.outline.user-group'),

            MenuGroup::make('Posts', [
                MenuItem::make('All Post', new PostResource()),
                MenuItem::make('Category', new CategoryResource()),
                MenuItem::make('User', new UserResource()),
            ]),
        ];
    }

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
