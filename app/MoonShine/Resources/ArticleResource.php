<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class ArticleResource extends Resource
{
	public static string $model = Article::class;

	public static string $title = 'Articles';

	public string $titleField = 'title';

	public function fields(): array
	{
		return [
		    ID::make()
                ->sortable(),

            Grid::make([
               Column::make([
                   Block::make([
                       Text::make(trans('moonshine::ui.blog.article.title'), 'title')
                           ->sortable()
                           ->required(),

                       Slug::make(trans('moonshine::ui.blog.article.slug'), 'slug')
                           ->from('title')
                           ->unique()
                           ->hideOnIndex(),

                       TinyMce::make(trans('moonshine::ui.blog.article.body'), 'body')
                           ->addPlugins('code codesample')
                           ->addToolbar(' | code codesample')
                           ->required()
                           ->hideOnIndex(),
                   ]),
               ])->columnSpan(9),

                Column::make([
                    Block::make([
                        Text::make('status')
                            ->sortable(),
                    ]),
                ])->columnSpan(3),
            ]),




        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id'];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
