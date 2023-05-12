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
                            {{ __('Post Update') }}
                        </h2>
                    </header>

                    <div>
                        <form method="post" action="{{ route('posts.update',$post) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            @method('PATCH')

                            <div>
                                <x-input-label for="title" value="{{ __('Title') }}"/>
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required
                                              autofocus autocomplete="title" :value="old('title', $post->title)"/>
                            </div>
                            <div>
                                <x-input-label for="category" value="{{ __('Category') }}"/>
                                <select id="category_id" name="category_id"
                                        class='border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id === $post->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="text" value="{{ __('Text') }}"/>
                                <textarea id="text" name="text"
                                          class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"
                                          rows="7">{{$post->text}}</textarea>

                            </div>
                            <div>
                                <img src="{{ asset('images/' . $post->hero_image) }}" alt="{{ $post->title }}" class="img-fluid">

                                <x-input-label for="hero_image" value="{{ __('Hero Image') }}"/>
                                <x-text-input id="hero_image" name="hero_image" type="file" :value="old('hero_image', $post->hero_image)" class="mt-1 block w-full" required
                                              autofocus />
                            </div>

                            <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
