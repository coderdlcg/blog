@extends('layouts.app')

@section('title', $article->seo_title ?? $article->title)
@section('description', $article->seo_description)

@section('content')
    <div>
{{--        <img class="w-full rounded-xl my-8"--}}
{{--             src="{{ $article->getThumbnail('thumbnail', 'fit', '1000x300', 'articles') }}"--}}
{{--             alt="{{ $article->title }}" />--}}

        <x-moonshine::thumbnails value="{{ '/storage/' . $article->thumbnail }}"/>

        <x-title>{{ $article->title }}</x-title>

{{--        @include('articles.shared.categories', ['categories' => $article->categories])--}}

{{--        @if($article->author_id && $article->author_id !== 1)--}}
{{--            <div class="my-4">--}}
{{--                @include('articles.shared.author', [--}}
{{--                    'author' => $article->author,--}}
{{--                    'date' => $article->created_at--}}
{{--                ])--}}
{{--            </div>--}}
{{--        @endif--}}

        <div class="mt-4">
            {!! $article->body !!}
        </div>
    </div>
@endsection
