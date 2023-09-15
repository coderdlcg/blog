<?php

namespace App\Providers;

use App\MoonShine\Resources\Blog\ArticleResource;
use App\MoonShine\Resources\Blog\CategoryResource;
use App\MoonShine\Resources\Blog\CommentResource;
use App\MoonShine\Resources\UserResource;
use Illuminate\Support\ServiceProvider;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\MoonShine;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([

            MenuGroup::make('moonshine::ui.blog.self', [
                MenuItem::make('moonshine::ui.blog.articles', new ArticleResource())
                    ->translatable()
                    ->icon('heroicons.outline.document-text'),
                MenuItem::make('moonshine::ui.blog.categories', new CategoryResource())
                    ->translatable()
                    ->icon('heroicons.list-bullet'),
                MenuItem::make('moonshine::ui.blog.comments', new CommentResource())
                    ->translatable()
                    ->icon('heroicons.outline.chat-bubble-bottom-center-text'),
            ])->translatable()->icon('heroicons.outline.pencil-square'),

            MenuItem::make('moonshine::ui.users', new UserResource(), )
                ->translatable()
                ->icon('heroicons.outline.users'),

            MenuGroup::make('moonshine::ui.resource.system', [
                MenuItem::make('moonshine::ui.resource.admins_title', new MoonShineUserResource())
                    ->translatable()
                    ->icon('users'),
                MenuItem::make('moonshine::ui.resource.role_title', new MoonShineUserRoleResource())
                    ->translatable()
                    ->icon('bookmark'),
            ])->translatable()->icon('app'),
        ]);
    }
}
