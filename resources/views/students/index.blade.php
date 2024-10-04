<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Students') }}
      </h2>
      <a href="{{ route('students.create') }}"
        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
        {{ __('Create Student') }}
      </a>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

      <form action="{{ route('students.index') }}" method="GET" class="flex justify-end">
        <div class="flex items-center ">
          <input type="text" name="search" placeholder="Search students..."
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
              Batch ID
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach ($students as $student)
            <tr>
              <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                {{ $student->name }}
              </td>
              <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                {{ $student->email }}
              </td>
              <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                {{ $student->phone }}
              </td>
              <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                {{ $student->address }}
              </td>
              <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                {{ $student->batch->course->name }} - {{ $student->batch->name }}
              </td>
            </tr>
          @endforeach
        </tbody>

      </table>

      <div class="flex justify-between mt-4">
        <span class="text-sm text-gray-700">
          Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }}
          results
        </span>

        <div class="pagination">
          {{ $students->links('pagination::tailwind') }}
        </div>
      </div>

    </div>
  </div>
</x-app-layout>
