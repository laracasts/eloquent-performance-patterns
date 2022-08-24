@extends('layout')

@section('content')

<header class="bg-white shadow">
  <div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="md:flex md:items-center md:justify-between">
      <div class="flex-1 min-w-0">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
          Users
        </h2>
      </div>
      <div class="mt-4 flex md:mt-0 md:ml-4">
        <span class="shadow-sm rounded-md">
          <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:text-gray-800 active:bg-gray-50 transition duration-150 ease-in-out">
            New user
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
              <th class="w-1/3 px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Name
              </th>
              <th class="w-1/3 px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Email
              </th>
              <th class="w-1/3 px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                <div class="flex items-center">
                  <a class="hover:underline" href="{{ route('users', ['sort' => 'town', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Town</a>
                  @if (request('sort') === 'town')
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
            @foreach ($users as $user)
              <tr class="bg-white">
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                  {{ $user->name }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                  {{ $user->email }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                  @if ($user->town)
                    {{ $user->town }}
                  @else
                    -
                  @endif
                </td>
                <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                  <a href="#" class="text-indigo-600 hover:text-indigo-900 focus:outline-none focus:underline">Edit</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $users->withQueryString()->links() }}
      </div>
    </div>
  </div>
</main>

@endsection
