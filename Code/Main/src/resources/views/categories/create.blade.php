<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Category Create') }}
                        </h2>
                    </header>

                    <div>
                        <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            @method('POST')

                            <div>
                                <x-input-label for="title" value="{{ __('Name') }}"/>
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required
                                              autofocus autocomplete="name"/>
                            </div>
                            <div>
                                <x-input-label for="category" value="{{ __('Parent') }}"/>
                                <select id="parent_id" name="parent_id"
                                    class='border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'>
                                    <option value="">
                                        --
                                    </option>
                                    @foreach ($parents as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
