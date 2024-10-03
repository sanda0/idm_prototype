<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Create Courses') }}
      </h2>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <form method="POST" action="{{ route('courses.store') }}">
        @csrf
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg"></div>
        <div class="mb-4">
        <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
          {{ __('Course Name') }}
        </label>
        <input
          class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
          id="name" type="text" name="name" required>
        </div>
        <div class="mb-4">
        <label class="block mb-2 text-sm font-bold text-gray-700" for="seo_url">
          {{ __('SEO URL') }}
        </label>
        <input
          class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
          id="seo_url" type="text" name="seo_url" required>
        </div>
        <div class="mb-4">
        <label class="block mb-2 text-sm font-bold text-gray-700" for="faculty">
          {{ __('Faculty') }}
        </label>
        <select
          class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
          id="faculty" name="faculty" required>
          <option value="faculty1">{{ __('Faculty 1') }}</option>
          <option value="faculty2">{{ __('Faculty 2') }}</option>
          <option value="faculty3">{{ __('Faculty 3') }}</option>
        </select>
        </div>
        <div class="mb-4">
        <label class="block mb-2 text-sm font-bold text-gray-700" for="category">
          {{ __('Category') }}
        </label>
        <select
          class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
          id="category" name="category" required>
          <option value="category1">{{ __('Category 1') }}</option>
          <option value="category2">{{ __('Category 2') }}</option>
          <option value="category3">{{ __('Category 3') }}</option>
        </select>
        </div>
        {{-- <div class="mb-4">
        <label class="block mb-2 text-sm font-bold text-gray-700" for="status">
          {{ __('Status') }}
        </label>
        <select
          class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
          id="status" name="status" required>
          <option value="draft">{{ __('Draft') }}</option>
          <option value="publish">{{ __('Publish') }}</option>
        </select>
        </div> --}}
        <div class="flex items-center justify-end">
        <button type="submit"
          class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
          {{ __('Create Course') }}
        </button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
