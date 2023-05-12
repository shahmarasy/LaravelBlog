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
                            {{ __('Posts List') }}
                        </h2>
                    </header>
                    <x-success-button class="mb-3 float-right" onclick="return window.location.href = '{{ route('posts.create') }}'" >
                        <i class="material-symbols-rounded">
                            add
                        </i>
                    </x-success-button>

                    <table class="border-collapse table-auto w-full text-sm">
                        <thead class="bg-gray-900">
                        <tr>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                Title
                            </th>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pb-3 text-slate-400 dark:text-slate-200 text-left w-72">
                                Category
                            </th>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pb-3 text-slate-400 dark:text-slate-200 text-left w-48" >
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody class="dark:bg-slate-800">
                        @foreach ($posts as $post)
                        <tr>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                {{$post->title}}
                            </td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                                {{$post->category->name}}
                            </td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400 ">

                                <x-warning-button onclick="return window.location.href = '{{ route('posts.edit', $post) }}'">
                                    <i class="material-symbols-rounded">
                                        edit
                                    </i>
                                </x-warning-button>
                                <form action="{{ route('posts.destroy', $post) }}" method="post" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button type="submit"  onclick="return confirm('Are you sure?')">
                                        <i class="material-symbols-rounded">
                                            delete
                                        </i>
                                    </x-danger-button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
