@extends('layout', ['title' => $feature->title])

@section('content')

<header class="bg-white shadow">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
    <h2 class="py-6 text-3xl font-bold leading-tight text-gray-900">
      {{ $feature->title }}
    </h2>
    <div class="flex items-center">
      @if ($feature->status === 'Requested')
        <span class="bg-orange-400 rounded-full flex items-center justify-between px-6 py-2">
          <div class="flex items-center">
            <svg class="text-white fill-current w-4 h-4" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
            <div class="ml-2 text-white text-sm font-medium">Requested</div>
          </div>
        </span>
      @elseif ($feature->status === 'Planned')
        <span class="bg-blue-500 rounded-full flex items-center justify-between px-6 py-2">
          <div class="flex items-center">
            <svg class="text-white fill-current w-4 h-4" viewBox="0 0 20 20"><path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/></svg>
            <div class="ml-2 text-white text-sm font-medium">Planned</div>
          </div>
        </span>
      @elseif ($feature->status === 'Completed')
        <span class="bg-green-400 rounded-full flex items-center justify-between px-6 py-2">
          <div class="flex items-center">
            <svg class="text-white fill-current w-4 h-4" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
            <div class="ml-2 text-white text-sm font-medium">Completed</div>
          </div>
        </span>
      @endif
    </div>
  </div>
</header>

<main class="max-w-6xl mx-auto py-12 sm:px-6 lg:px-8">
  @foreach ($feature->comments as $comment)
    <div class="px-10 py-8 bg-white shadow overflow-hidden sm:rounded-lg flex {{ $loop->first ? 'mb-8' : 'mb-4 max-w-4xl mx-auto' }}" id="comment-{{ $comment->id }}">
      <div class="whitespace-no-wrap pr-8 border-r">
        @if ($comment->user->photo)
          <div class="w-12 h-12 rounded-full overflow-hidden bg-red-400">
            <img class="object-cover w-full h-full" src="/img/users/{{ $comment->user->photo }}" />
          </div>
        @endif
        <div class="mt-2 text-sm leading-5 text-gray-900">
          {{ $comment->user->name }}
        </div>
        <div class="text-xs leading-5 text-gray-500">
          {{ $comment->created_at->format('M j, Y \a\t g:i a') }}
        </div>
        @if ($comment->isAuthor())
          <div class="flex items-center text-yellow-400">
            <svg class="fill-current w-3 h-3" viewBox="0 0 20 20">
              <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
            </svg>
            <div class="ml-1 text-xs font-medium">Author</div>
          </div>
        @endif
      </div>
      <div class="px-8 flex-1 flex items-center">
        {{ $comment->comment }}
      </div>
    </div>
  @endforeach
</main>

@endsection
