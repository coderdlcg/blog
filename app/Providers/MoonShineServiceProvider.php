<?php

namespace App\Providers;

use App\MoonShine\Resources\ArticleResource;
use Illuminate\Support\ServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([

            MenuGroup::make('moonshine::ui.blog.blog', [
                MenuItem::make('moonshine::ui.blog.articles', new ArticleResource())
                    ->translatable()
                    ->icon('heroicons.outline.document-text'),
                MenuItem::make('moonshine::ui.blog.categories', '#')
                    ->translatable()
                    ->icon('heroicons.list-bullet'),
                MenuItem::make('moonshine::ui.blog.comments', '#')
                    ->translatable()
                    ->icon('heroicons.outline.chat-bubble-bottom-center-text'),
            ])->translatable()->icon('app'),

            MenuGroup::make('moonshine::ui.resource.system', [
                MenuItem::make('moonshine::ui.resource.admins_title', new MoonShineUserResource())
                    ->translatable()
                    ->icon('users'),
                MenuItem::make('moonshine::ui.resource.role_title', new MoonShineUserRoleResource())
                    ->translatable()
                    ->icon('bookmark'),
            ])->translatable()->icon('app'),

            MenuItem::make('Documentation', 'https://laravel.com')
                ->badge(fn() => 'Check'),
        ]);
    }
}
