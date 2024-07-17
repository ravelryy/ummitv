@extends('layout.app-layout')

<form action="{{ route('videos.store') }}" method="post" class="max-w-lg mx-auto mt-10" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <input type="hidden" name="uploaded_by" value="{{ $user->id }}">
    <div class="mb-5">
        <div class="flex items-center justify-center w-full">
            <label for="dropzone-file"
                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                            upload</span> or drag and drop</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                </div>
                <input id="dropzone-file" type="file" name="thumbnail" class="hidden" />
            </label>
        </div>
    </div>
    <div class="mb-5">
        <label for="path" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Path</label>
        <input type="link" id="path" name="path"
            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
            placeholder="youtube.com/something" />
    </div>
    <div class="mb-5">
        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
        <input type="text" id="title" name="title"
            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
    </div>
    {{-- <div class="flex flex-col items-center text-sm sm:flex-row sm:space-y-0 sm:space-x-4">
        <div class="w-full">
            <label for="input1">
                <span class="ml-2 text-sm text-gray-800 sm:text-base dark:text-gray-200">What are your interest?</span>
                <input id="input1" minlength="5" name="tags"
                    class="mt-1 py-3 px-5 w-full border-2 border-purple-300 rounded-2xl outline-none placeholder:text-gray-400 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer dark:bg-gray-500 dark:text-gray-200 dark:placeholder:text-gray-300 dark:invalid:text-pink-300 dark:border-gray-400"
                    type="text" placeholder="Type something" />
                <p class="ml-2 text-xs text-pink-700 invisible peer-invalid:visible dark:text-gray-200">less than 5
                    characters</p>
            </label>
        </div>
        <div
            class="w-full text-center py-3 px-8 text-sm font-medium bg-purple-500 text-gray-100 rounded-2xl cursor-pointer sm:w-min hover:bg-purple-700 hover:text-gray-50 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-50 mb-4 sm:mb-0">
            <span>Add</span>
        </div>
    </div>
    </div>
    <div class='px-2 pt-2 pb-11 mb-3 flex flex-wrap rounded-lg bg-purple-200 dark:bg-gray-400'>
        @foreach ($tags as $tag)
            <span
            class="flex flex-wrap pl-4 pr-2 py-2 m-1 justify-between items-center text-sm font-medium rounded-xl cursor-pointer bg-purple-500 text-gray-200 hover:bg-purple-600 hover:text-gray-100 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-800 dark:hover:text-gray-100">
                {{ $tag->name }}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-3 hover:text-gray-300" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        @endforeach
    </div> --}}
    <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload</button>
</form>
