<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

use Leeto\MoonShineTree\Resources\TreeResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Filters\TextFilter;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class CategoryResource extends TreeResource
{
	public static string $model = Category::class;

	public static string $title = 'Categories';

    public string $titleField = 'title';

    public static array $activeActions = ['create', 'edit', 'delete'];

    public static bool $withPolicy = true;

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    public static array $with = ['category'];

    public static string $orderField = 'sorting';

    public function treeKey(): ?string
    {
//        return null;
        return 'parent_id';
    }

    public function sortKey(): string
    {
        return 'sorting';
    }

    public function title(): string
    {
        return trans('moonshine::ui.blog.categories');
    }

	public function fields(): array
	{
		return [
            Block::make('', [
                ID::make()->sortable(),
                BelongsTo::make(trans('moonshine::ui.blog.category_parent'), 'category')
                    ->nullable(),
                Text::make(trans('moonshine::ui.blog.category'), 'title')
                    ->required(),
            ]),
        ];
	}

	public function rules(Model $item): array
	{
	    return [
            'title' => ['required', 'string', 'min:3']
        ];
    }

    public function search(): array
    {
        return ['id', 'title'];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Title')
        ];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
