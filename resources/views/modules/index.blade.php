<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Modules') }}
            </h2>
            <a href="{{ route('modules.create') }}"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                {{ __('Create Module') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <form action="{{ route('modules.index') }}" method="GET" class="flex justify-end">
                <div class="flex items-center ">
                    <input type="text" name="search" placeholder="Search modules..."
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
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Code
                        </th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Name
                        </th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Semester
                        </th>

                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Credit
                        </th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Status
                        </th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($modules as $item)
                        <tr>
                            <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                                {{ $item->code }}
                            </td>
                            <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                                {{ $item->name }}
                            </td>
                            <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                                {{ $item->semester }}
                            </td>

                            <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                                {{ $item->credit }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->status == 'publish' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                <a href="{{ route('modules.edit', $item->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('modules.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-2 text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <div class="flex justify-between mt-4">
                <span class="text-sm text-gray-700">
                    Showing {{ $modules->firstItem() }} to {{ $modules->lastItem() }} of {{ $modules->total() }}
                    results
                </span>

                <div class="pagination">
                    {{ $modules->links('pagination::tailwind') }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
