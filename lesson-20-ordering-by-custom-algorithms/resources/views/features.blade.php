@extends('layout')

@section('content')

<header class="bg-white shadow">
  <div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="md:flex md:items-center md:justify-between">
      <div class="flex-1 min-w-0">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
          Features
        </h2>
      </div>
      <div class="mt-4 flex md:mt-0 md:ml-4">
        <span class="shadow-sm rounded-md">
          <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:text-gray-800 active:bg-gray-50 transition duration-150 ease-in-out">
            New feature
          </button>
        </span>
      </div>
    </div>
  </div>
</header>

<main class="max-w-6xl mx-auto sm:px-6 lg:px-8 py-12">
  <div class="flex flex-col">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
      <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full">
          <thead>
            <tr>
              <th class="w-1/2 px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                <div class="flex items-center">
                  <a class="hover:underline" href="{{ route('features', ['sort' => 'title', 'direction' => request('sort') === 'title' && request('direction') === 'asc' ? 'desc' : 'asc']) }}">Title</a>
                  @if (request('sort') === 'title')
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                      @if (request('direction', 'asc') === 'asc')
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                      @else
                        <path d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"/>
                      @endif
                    </svg>
                  @endif
                </div>
              </th>
              <th class="w-1/4 px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                <div class="flex items-center">
                  <a class="hover:underline" href="{{ route('features', ['sort' => 'status', 'direction' => request('sort') === 'status' && request('direction') === 'asc' ? 'desc' : 'asc']) }}">Status</a>
                  @if (request('sort') === 'status')
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                      @if (request('direction', 'asc') === 'asc')
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                      @else
                        <path d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"/>
                      @endif
                    </svg>
                  @endif
                </div>
              </th>
              <th class="w-1/4 px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                <div class="flex items-center">
                  <a class="hover:underline" href="{{ route('features', ['sort' => 'activity', 'direction' => request('sort') === 'activity' && request('direction') === 'asc' ? 'desc' : 'asc']) }}">Activity</a>
                  @if (request('sort') === 'activity')
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                      @if (request('direction', 'asc') === 'asc')
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                      @else
                        <path d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"/>
                      @endif
                    </svg>
                  @endif
                </div>
              </th>
              <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($features as $feature)
              <tr class="bg-white">
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                  {{ $feature->title }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                  @if ($feature->status === 'Requested')
                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-700">
                          Requested
                      </span>
                  @elseif ($feature->status === 'Approved')
                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-700">
                          Approved
                      </span>
                  @elseif ($feature->status === 'Completed')
                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                          Completed
                      </span>
                  @endif
                </td>
                <td class="px-6 py-4 border-b border-gray-200">
                  <div class="flex items-center text-sm text-green-500">
                    <div class="flex items-baseline">
                      <svg class="fill-current w-3 h-3" viewBox="0 0 20 20"><path d="M11 0h1v3l3 7v8a2 2 0 01-2 2H5c-1.1 0-2.31-.84-2.7-1.88L0 12v-2a2 2 0 012-2h7V2a2 2 0 012-2zm6 10h3v10h-3V10z"/></svg>
                      <div class="ml-1 font-medium">{{ $feature->votes_count }}</div>
                    </div>
                    <div class="ml-3 flex items-center">
                      <svg class="fill-current w-3 h-3 mt-2px" viewBox="0 0 40 40" width="40" height="40"><title>Exported from Streamline App (https://app.streamlineicons.com)</title><g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)"><path d="M21.5,2h-19C1.672,2,1,2.672,1,3.5v13C1,17.328,1.672,18,2.5,18h4.252c0.138,0,0.25,0.112,0.25,0.25v3.25 c0,0.276,0.224,0.5,0.5,0.5c0.132,0,0.259-0.052,0.353-0.146l3.781-3.781C11.683,18.026,11.747,18,11.813,18H21.5 c0.828,0,1.5-0.672,1.5-1.5v-13C23,2.672,22.328,2,21.5,2z" stroke="none" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                      <div class="ml-1 font-medium">{{ $feature->comments_count }}</div>
                    </div>
                    {{--
                    <div class="ml-2">
                      ({{ $feature->votes_count + ($feature->comments_count * 2) }})
                    </div>
                    --}}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                  <a href="#" class="text-indigo-600 hover:text-indigo-900 focus:outline-none focus:underline">Edit</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $features->withQueryString()->links() }}
      </div>
    </div>
  </div>
</main>

@endsection
