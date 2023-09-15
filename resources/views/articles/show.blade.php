@extends('layouts.app')

@section('title', $article->seo_title ?? $article->title)
@section('description', $article->seo_description)

@section('content')
    <div class="max-w-4xl mx-auto py-8">
        <div class="py-8">
            <img class="object-cover w-full h-[400px] rounded-xl bg-blue-50"
                 src="{{ $article->thumbnail ? '/storage/' . $article->thumbnail : '/storage/no-image.webp' }}"
                 alt="{{ $article->title }}">
        </div>

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

        <div class="py-6">
            {!! $article->body !!}
        </div>
    </div>
@endsection
