<?php

namespace App\MoonShine\Resources\Blog;

use App\Models\Blog\Comment;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Decorations\Block;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;

class CommentResource extends Resource
{
	public static string $model = Comment::class;

	public static string $title = 'Comments';

    public static array $with = ['user', 'article'];

    public function title(): string
    {
        return trans('moonshine::ui.blog.comments');
    }

	public function fields(): array
	{
		return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make(trans('moonshine::ui.blog.article.self'),'article'),
                BelongsTo::make(trans('moonshine::ui.user'),'user'),
                Text::make(trans('moonshine::ui.blog.comment.text'), 'text')->required(),
            ])
        ];
	}

	public function rules(Model $item): array
	{
	    return [
            'text' => ['required', 'string', 'min:1'],
        ];
    }

    public function search(): array
    {
        return ['id', 'text'];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [];
    }
}
