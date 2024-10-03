<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        {{ __('Error Page') }}
      </h2>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      @isset($error)
        <div class="p-4 text-white bg-red-500 rounded">
          {{ $error }}
        </div>
      @endisset
    </div>
  </div>
</x-app-layout>
