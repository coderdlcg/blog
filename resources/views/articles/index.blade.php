@extends('layouts.app')

@section('title', 'Статьи')

@section('content')
    <section class="py-8">
        <x-title>Статьи</x-title>

        @if($articles->isNotEmpty())
            <div class="grid grid-cols-1 gap-8 gap-x-10 gap-y-14 xl:gap-y-20 py-16 mt-8 md:mt-16 md:grid-cols-2">
                @foreach($articles as $article)
                    @include('articles.shared.item-v2', ['item' => $article])
                @endforeach
            </div>

        @else
            <div class="text-[26px] sm:text-xl xl:text-[48px] 2xl:text-2xl font-black my-8">
                Пока таких записей нет :( <span class="text-pink">Но скоро добавим</span>
            </div>
        @endif

        {{ $articles->links() }}
    </section>
@endsection
