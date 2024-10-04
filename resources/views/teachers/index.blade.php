<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Teachers') }}
      </h2>
      <a href="{{ route('teachers.create') }}"
        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
        {{ __('Create Teacher') }}
      </a>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

      <form action="{{ route('teachers.index') }}" method="GET" class="flex justify-end">
        <div class="flex items-center ">
          <input type="text" name="search" placeholder="Search teachers..."
            class="px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
          <button type="submit"
            class="px-4 py-2 ml-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
            Search
          </button>
        </div>
      </form>

      <table class="w-full min-w-full mt-10 divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th
              class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
              Name
            </th>
            <th
              class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
              Email
            </th>
            <th
              class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
              Phone
            </th>
            <th
              class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
              Address
            </th>
            <th
              class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
              Course
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach ($teachers as $teacher)
            <tr>
              <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                {{ $teacher->name }}
              </td>
              <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                {{ $teacher->email }}
              </td>
              <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                {{ $teacher->phone }}
              </td>
              <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                {{ $teacher->address }}
              </td>
              <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                {{ $teacher->course->name }}
              </td>
            </tr>
          @endforeach
        </tbody>

      </table>

      <div class="flex justify-between mt-4">
        <span class="text-sm text-gray-700">
          Showing {{ $teachers->firstItem() }} to {{ $teachers->lastItem() }} of {{ $teachers->total() }}
          results
        </span>

        <div class="pagination">
          {{ $teachers->links('pagination::tailwind') }}
        </div>
      </div>

    </div>
  </div>
</x-app-layout>
