<?php

namespace App\Policies\Blog;

use App\Models\Blog\Category;
use Illuminate\Auth\Access\HandlesAuthorization;
use MoonShine\Models\MoonshineUser;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user): bool
    {
        return true;
    }

    public function view(MoonshineUser $user, Category $item): bool
    {
        return true;
    }

    public function create(MoonshineUser $user): bool
    {
        return true;
    }

    public function update(MoonshineUser $user, Category $item): bool
    {
        return true;
    }

    public function delete(MoonshineUser $user, Category $item): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function restore(MoonshineUser $user, Category $item): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function forceDelete(MoonshineUser $user, Category $item): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function massDelete(MoonshineUser $user): bool
    {
        return $user->moonshine_user_role_id === 1;
    }
}
