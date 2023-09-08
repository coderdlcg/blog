<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

use MoonShine\Decorations\Block;
use MoonShine\Decorations\Button;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Flex;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Image;
use MoonShine\Fields\NoInput;
use MoonShine\Fields\Select;
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

    public static array $activeActions = ['create', 'edit', 'delete'];

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

                       Flex::make([
                           Slug::make(trans('moonshine::ui.blog.article.slug'), 'slug')
                               ->from('title')
                               ->unique()
                               ->hideOnIndex(),
                       ]),

                       TinyMce::make(trans('moonshine::ui.blog.article.body'), 'body')
                           ->addPlugins('code codesample')
                           ->addToolbar(' | code codesample')
                           ->required()
                           ->hideOnIndex(),
                   ]),
               ])->columnSpan(9),

                Column::make([
                    Block::make([
                        Button::make(
                            'Link to article',
                            $this->getItem() ? route('articles.show', $this->getItem()) : '/',
                            true
                        )->icon('clip'),
                    ]),

                    Block::make([
                        Text::make(trans('moonshine::ui.blog.article.status'), 'status', function (Article $article) {
                            return $article->getStatusDesc();
                        })
                            ->hideOnForm()
                            ->sortable(),

                        Select::make(trans('moonshine::ui.blog.article.status'), 'status')
                            ->options(Article::getAllStatusesDesc())
                            ->hideOnIndex(),

                        Image::make(trans('moonshine::ui.blog.article.thumbnail'), 'thumbnail')
                            ->removable()
                            ->disk('public')
                            ->dir('articles'),
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
        return ['id', 'title'];
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
