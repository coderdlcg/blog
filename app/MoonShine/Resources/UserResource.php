<?php

namespace App\MoonShine\Resources;

use App\Models\User;
use App\MoonShine\Controllers\UserFetchController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Email;
use MoonShine\Fields\ID;
use MoonShine\Fields\Password;
use MoonShine\Fields\PasswordRepeat;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;

class UserResource extends Resource
{
    public static string $model = User::class;

    public static string $title = 'Users';

    public string $titleField = 'name';

    public function fields(): array
    {
        return [
            Grid::make([
                Column::make([
                    Block::make(trans('moonshine::ui.user'), [
                        ID::make()->sortable(),
                        Text::make(trans('moonshine::ui.blog.users.name'), 'name', 'name'),
                        Phone::make(trans('moonshine::ui.blog.users.phone'), 'phone', 'phone')-> mask('7 999 999-99-99'),
                        Email::make(trans('moonshine::ui.blog.users.email'), 'email', 'email'),
                    ]),

                    Block::make(trans('moonshine::ui.resource.change_password'), [
                        Password::make(trans('moonshine::ui.resource.password'), 'password')
                            ->customAttributes(['autocomplete' => 'new-password'])
                            ->hideOnIndex(),

                        PasswordRepeat::make(trans('moonshine::ui.resource.repeat_password'),'password_repeat')
                            ->translatable()
                            ->customAttributes(['autocomplete' => 'confirm-password'])
                            ->hideOnIndex(),
                    ]),
                ]),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'name' => 'required',
            'email' => 'sometimes|bail|required|email|unique:users,email' . ($item->exists ? ",$item->id" : ''),
            'password' => ! $item->exists
                ? 'required|min:6|required_with:password_repeat|same:password_repeat'
                : 'sometimes|nullable|min:6|required_with:password_repeat|same:password_repeat',
        ];
    }

    public function search(): array
    {
        return ['id', 'name', 'phone', 'email'];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [];
    }

    public function resolveRoutes(): void
    {
        parent::resolveRoutes();

        Route::get('fetch-users', UserFetchController::class)
            ->name('fetch-users');
    }
}
