<div class="lg:flex">
    <img class="object-cover w-full h-56 rounded-lg lg:w-64 bg-blue-50"
         src="{{ $article->thumbnail ? '/storage/' . $article->thumbnail : '/storage/no-image.webp' }}"
         alt="">

    <div class="flex flex-col justify-between py-6 lg:mx-6">
        <a href="{{ route('articles.show', $item) }}" class="text-xl font-semibold text-gray-800 hover:underline dark:text-white ">
            {{ $item->title }}
        </a>
{{--        <p class="text-gray-500">--}}
{{--            Sailboat UI helps streamline software projects, sprints, tasks, and bug tracking.--}}
{{--        </p>--}}

        <div class="text-sm text-gray-500 dark:text-gray-500">{{ \Illuminate\Support\Carbon::createFromDate($item->published_at)->format('d.m.Y в H:i') }}</div>
{{--        <div class="text-xs font-normal">{{ $item->categories->first()->title ?? null }}</div>--}}
    </div>
</div>
