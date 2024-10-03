<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Edit Module') }}
      </h2>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <form method="POST" action="{{ route('modules.update', $module->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
          <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
          {{ __('Module Name') }}
          </label>
          <input
          class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
          id="name" type="text" name="name" value="{{ old('name', $module->name) }}" required>
        </div>
        <div class="mb-4">
          <label class="block mb-2 text-sm font-bold text-gray-700" for="code">
            {{ __('Module Code') }}
          </label>
          <input
            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
            id="code" type="text" name="code" value="{{ old('code', $module->code) }}" required>
        </div>
        <div class="mb-4">
          <label class="block mb-2 text-sm font-bold text-gray-700" for="semester">
            {{ __('Semester') }}
          </label>
          <input
            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
            id="semester" type="number" name="semester" value="{{ old('semester', $module->semester) }}" required>
        </div>

        <div class="mb-4">
          <label class="block mb-2 text-sm font-bold text-gray-700" for="credit">
            {{ __('Credit') }}
          </label>
          <input
            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
            id="credit" type="number" step="0.1" name="credit" value="{{ old('credit', $module->credit) }}" required>
        </div>
        <div class="mb-4">
          <label class="block mb-2 text-sm font-bold text-gray-700" for="status">
            {{ __('Status') }}
          </label>
          <select
            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
            id="status" name="status" required>
            <option value="draft" {{ old('status', $module->status) == 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
            <option value="publish" {{ old('status', $module->status) == 'publish' ? 'selected' : '' }}>{{ __('Publish') }}</option>
          </select>
        </div>
        <div class="mb-4">
          <label class="block mb-2 text-sm font-bold text-gray-700" for="description">
            {{ __('Description') }}
          </label>
          <textarea
            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
            id="description" name="description" rows="10">{{ old('description', $module->description) }}</textarea>
        </div>
        <div class="flex items-center justify-end">
          <button type="submit"
            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
            {{ __('Update Module') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
