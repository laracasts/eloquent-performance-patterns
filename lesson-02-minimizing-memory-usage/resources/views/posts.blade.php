@extends('layout')

@section('content')

<main class="px-4 sm:px-6 lg:pb-28 lg:px-8">
  <div class="max-w-5xl mx-auto">
    @foreach ($years as $year => $posts)
      <div class="mt-12">
        <h2 class="text-2xl leading-9 tracking-tight font-extrabold text-gray-900 border-b">
          {{ $year }}
        </h2>
        <div class="mt-2 flex flex-wrap">
          @foreach ($posts as $post)
            <div class="mt-4 w-full sm:w-1/2">
              <a href="/{{ $post->slug }}" class="text-gray-900 font-medium hover:underline">
                {{ $post->title }}
              </a>
              <div class="text-sm text-gray-500">
                Posted {{ $post->published_at->toFormattedDateString() }} by {{ $post->author->name }}
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endforeach
  </div>
</main>

@endsection
