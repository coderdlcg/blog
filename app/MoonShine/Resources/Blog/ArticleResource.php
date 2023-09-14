<?php

namespace App\MoonShine\Resources\Blog;

use App\Models\Blog\Article;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Actions\FiltersAction;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Button;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\BelongsToMany;
use MoonShine\Fields\Date;
use MoonShine\Fields\ID;
use MoonShine\Fields\Image;
use MoonShine\Fields\Select;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;
use MoonShine\Filters\BelongsToFilter;
use MoonShine\Filters\BelongsToManyFilter;
use MoonShine\Filters\TextFilter;
use MoonShine\Resources\Resource;

class ArticleResource extends Resource
{
	public static string $model = Article::class;

	public static string $title = 'Articles';

	public string $titleField = 'title';

    public static string $orderField = 'created_at';

    public static string $orderType = 'DESC';

    public static array $activeActions = ['create', 'edit', 'delete'];

    public static array $with = [
        'author',
        'comments'
    ];

    public function title(): string
    {
        return trans('moonshine::ui.blog.articles');
    }

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
                       Text::make(trans('moonshine::ui.blog.category'), 'category', function (Article $article) {
                           return $article->categories->first()->title ?? '-';
                       })
                           ->hideOnForm(),
                       Slug::make(trans('moonshine::ui.blog.article.slug'), 'slug')
                           ->from('title')
                           ->unique()
                           ->hideOnIndex(),
                   ]),

                   Block::make([
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
                        BelongsTo::make(trans('moonshine::ui.blog.author'), 'author', resource: 'name')
                            ->sortable()
                            ->asyncSearch()
                            ->canSee(fn() => auth()->user()->moonshine_user_role_id === 1)
                            ->required(),
                    ]),

                    Block::make([
                        Date::make(trans('moonshine::ui.blog.article.published_at'), 'published_at')
                            ->sortable()
                            ->withTime(),

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

                        BelongsToMany::make('Categories', 'categories')
//                            ->asyncSearch()
                            ->tree('parent_id')
                            ->hideOnIndex()
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

    public function metrics(): array
    {
        return [
//            ValueMetric::make('Articles')
//                ->value(Article::query()->count())
//                ->columnSpan(2),
//
//            ValueMetric::make('Comments')
//                ->value(Comment::query()->count())
//                ->columnSpan(2),
        ];
    }

    public function filters(): array
    {
        return [
            TextFilter::make(trans('moonshine::ui.blog.article.title'), 'title'),

            BelongsToManyFilter::make(trans('moonshine::ui.blog.categories'), 'categories')
                ->select(),

            BelongsToFilter::make(trans('moonshine::ui.blog.author'), 'author', resource: 'name')
                ->nullable()
                ->canSee(fn() => auth()->user()->moonshine_user_role_id === 1),
        ];
    }
    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
