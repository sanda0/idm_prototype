<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Create Student') }}
      </h2>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <form method="POST" action="{{ route('students.store') }}">
        @csrf
        <div class="mb-4">
          <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
          {{ __('Name') }}
          </label>
          <input
          class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
          id="name" type="text" name="name" required>
        </div>
        <div class="mb-4">
          <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
            {{ __('Email') }}
          </label>
          <input
            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
            id="email" type="email" name="email" required>
        </div>
        <div class="mb-4">
          <label class="block mb-2 text-sm font-bold text-gray-700" for="phone">
            {{ __('Phone') }}
          </label>
          <input
            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
            id="phone" type="text" name="phone" required>
        </div>
        <div class="mb-4">
          <label class="block mb-2 text-sm font-bold text-gray-700" for="address">
            {{ __('Address') }}
          </label>
          <input
            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
            id="address" type="text" name="address" required>
        </div>
        <div class="mb-4">
          <label class="block mb-2 text-sm font-bold text-gray-700" for="batch_id">
            {{ __('Batch') }}
          </label>
          <select
            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
            id="batch_id" name="batch_id" required>
            <!-- Assuming you have a variable $batches passed to the view containing batch data -->
            @foreach($batches as $batch)
              <option value="{{ $batch->id }}">{{$batch->course->name}} - {{ $batch->name }} </option>
            @endforeach
          </select>
        </div>
        <div class="flex items-center justify-end">
          <button type="submit"
            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
            {{ __('Create Student') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
