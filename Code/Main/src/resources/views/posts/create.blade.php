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
                            {{ __('Post Create') }}
                        </h2>
                    </header>

                    <div>
                        <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data"
                              class="mt-6 space-y-6">
                            @csrf
                            @method('POST')

                            <div>
                                <x-input-label for="title" value="{{ __('Title') }}"/>
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required
                                              autofocus autocomplete="title"/>
                            </div>
                            <div>
                                <x-input-label for="category" value="{{ __('Category') }}"/>
                                <select id="category_id" name="category_id"
                                        class='border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="text" value="{{ __('Text') }}"/>
                                <textarea id="text" name="text"
                                          class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"
                                          rows="7"></textarea>
                                <div id="the-count">
                                    <span id="current">0</span>
                                    <span id="maximum">/ 400</span>
                                </div>

                                <x-primary-button type="button"
                                                  onclick="aiTools()">{{ __('Ai Tools') }}</x-primary-button>

                                <div class="aiTools pt-4" style="display: none">
                                    <x-primary-button type="button"
                                                      onclick="fix()">{{ __('Spelling and Grammar') }}</x-primary-button>
                                    <x-primary-button type="button"
                                                      onclick="hashtag()">{{ __('Make Hashtag') }}</x-primary-button>
                                    <br>
                                    <div class="border border-blue-300 shadow rounded-md p-4 max-w-sm w-full mx-auto"
                                         id="waiterFixing" style="display: none">
                                        <div class="animate-pulse flex space-x-4">
                                            <div class="rounded-full bg-slate-700 h-10 w-10"></div>
                                            <div class="flex-1 space-y-6 py-1">
                                                <div class="h-2 bg-slate-700 rounded"></div>
                                                <div class="space-y-3">
                                                    <div class="grid grid-cols-3 gap-4">
                                                        <div class="h-2 bg-slate-700 rounded col-span-2"></div>
                                                        <div class="h-2 bg-slate-700 rounded col-span-1"></div>
                                                    </div>
                                                    <div class="h-2 bg-slate-700 rounded"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="fixing" style="display: none">
                                        <x-input-label for="fixedArea" class="pt-4" value="{{ __('Fixed Text') }}"/>

                                        <textarea id="fixedArea" name="fixedArea"
                                                  class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"
                                                  rows="7"></textarea>
                                        <x-primary-button type="button"
                                                          onclick="replaceFix()">{{ __('Replace') }}</x-primary-button>
                                    </div>
                                    <div class="border border-blue-300 shadow rounded-md p-4 max-w-sm w-full mx-auto"
                                         id="waiterHashtag" style="display: none">
                                        <div class="animate-pulse flex space-x-4">
                                            <div class="rounded-full bg-slate-700 h-10 w-10"></div>
                                            <div class="flex-1 space-y-6 py-1">
                                                <div class="h-2 bg-slate-700 rounded"></div>
                                                <div class="space-y-3">
                                                    <div class="grid grid-cols-3 gap-4">
                                                        <div class="h-2 bg-slate-700 rounded col-span-2"></div>
                                                        <div class="h-2 bg-slate-700 rounded col-span-1"></div>
                                                    </div>
                                                    <div class="h-2 bg-slate-700 rounded"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="hashtag" style="display: none">
                                        <x-input-label for="hashtagArea" class="pt-4" value="{{ __('Hashtag') }}"/>
                                        <x-text-input id="hashtagArea" name="hashtagArea" type="text"
                                                      class="mt-1 block w-full"/>
                                        <x-primary-button type="button"
                                                          onclick="importHashtag()">{{ __('Import') }}</x-primary-button>
                                    </div>


                                </div>

                            </div>
                            <div>
                                <x-input-label for="hero_image" value="{{ __('Hero Image') }}"/>
                                <x-text-input id="hero_image" name="hero_image" type="file" class="mt-1 block w-full"
                                              required
                                              autofocus/>
                            </div>

                            <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script>
            const aiTools = () => {
                $('.aiTools').toggle("slow");
            }
            const fix = async () => {
                const text = document.getElementById("text").value;
                $('#waiterFixing').toggle();
                const url = 'http://localhost:8081/fix';

                const formData = new FormData();
                formData.append('text', text);
                formData.append('language', 'turkish');

                fetch(url, {
                    method: 'POST',
                    body: formData
                }).then(r => r.json())
                    .then(data => {
                        document.getElementById("fixedArea").value = data.text;
                        $('#waiterFixing').toggle();
                        $('#fixing').toggle();
                        console.log(data.text)
                    });
            }
            const hashtag = async () => {
                const text = document.getElementById("text").value;
                const url = 'http://localhost:8081/hashtag';
                $('#waiterHashtag').toggle();
                const formData = new FormData();
                formData.append('text', text);

                fetch(url, {
                    method: 'POST',
                    body: formData
                }).then(r => r.json())
                    .then(data => {
                        document.getElementById("hashtagArea").value = data.text;
                        $('#waiterHashtag').toggle();
                        $('#hashtag').toggle();
                        console.log(data.text)
                    });
            }

            const replaceFix = () => {
                document.getElementById("text").value = document.getElementById("fixedArea").value;
            }

            const importHashtag = () => {
                document.getElementById("text").value += '\n \n' + document.getElementById("hashtagArea").value;
            }


            $('textarea').keyup(function () {

                var characterCount = $(this).val().length,
                    current = $('#current'),
                    maximum = $('#maximum'),
                    theCount = $('#the-count');

                current.text(characterCount);


                /*This isn't entirely necessary, just playin around*/
                if (characterCount < 70) {
                    current.css('color', '#666');
                }
                if (characterCount > 70 && characterCount < 90) {
                    current.css('color', '#6d5555');
                }
                if (characterCount > 90 && characterCount < 100) {
                    current.css('color', '#793535');
                }
                if (characterCount > 100 && characterCount < 120) {
                    current.css('color', '#841c1c');
                }
                if (characterCount > 120 && characterCount < 139) {
                    current.css('color', '#8f0001');
                }

                if (characterCount >= 400) {
                    maximum.css('color', '#8f0001');
                    current.css('color', '#8f0001');
                    theCount.css('font-weight', 'bold');
                } else {
                    maximum.css('color', '#666');
                    theCount.css('font-weight', 'normal');
                }


            });
        </script>
    @endpush
</x-app-layout>

