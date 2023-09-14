<?php

namespace App\Policies\Blog;

use App\Models\Blog\Article;
use Illuminate\Auth\Access\HandlesAuthorization;
use MoonShine\Models\MoonshineUser;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user): bool
    {
        return true;
    }

    public function view(MoonshineUser $user, Article $item): bool
    {
        return $user->moonshine_user_role_id === 1 || $user->id === $item->author_id;
    }

    public function create(MoonshineUser $user): bool
    {
        return true;
    }

    public function update(MoonshineUser $user, Article $item): bool
    {
        return $user->moonshine_user_role_id === 1 || $user->id === $item->author_id;
    }

    public function delete(MoonshineUser $user, Article $item): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function restore(MoonshineUser $user, Article $item): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function forceDelete(MoonshineUser $user, Article $item): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function massDelete(MoonshineUser $user): bool
    {
        return false;
    }
}
