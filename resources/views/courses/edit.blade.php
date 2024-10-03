<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Edit Courses') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('courses.update', $course->id) }}">
                <div class="flex items-center justify-end">
                    <button type="submit"
                        class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                        {{ __('Save Course') }}
                    </button>
                </div>
                @method('PUT')
                @csrf
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg"></div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                        {{ __('Course Name') }}
                    </label>
                    <input
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="name" type="text" name="name" required value="{{ $course->name }}">
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="seo_url">
                        {{ __('SEO URL') }}
                    </label>
                    <input
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="seo_url" type="text" name="seo_url" required value="{{ $course->seo_url }}">
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="faculty">
                        {{ __('Faculty') }}
                    </label>
                    <select
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="faculty" name="faculty" required>
                        <option value="faculty1" {{ $course->faculty == 'faculty1' ? 'selected' : '' }}>
                            {{ __('Faculty 1') }}</option>
                        <option value="faculty2" {{ $course->faculty == 'faculty2' ? 'selected' : '' }}>
                            {{ __('Faculty 2') }}</option>
                        <option value="faculty3" {{ $course->faculty == 'faculty3' ? 'selected' : '' }}>
                            {{ __('Faculty 3') }}</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="category">
                        {{ __('Category') }}
                    </label>
                    <select
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="category" name="category" required>
                        <option value="category1" {{ $course->category == 'category1' ? 'selected' : '' }}>
                            {{ __('Category 1') }}</option>
                        <option value="category2" {{ $course->category == 'category2' ? 'selected' : '' }}>
                            {{ __('Category 2') }}</option>
                        <option value="category3" {{ $course->category == 'category3' ? 'selected' : '' }}>
                            {{ __('Category 3') }}</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="status">
                        {{ __('Status') }}
                    </label>
                    <select
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="status" name="status" required>
                        <option value="draft" {{ $course->status == 'draft' ? 'selected' : '' }}>{{ __('Draft') }}
                        </option>
                        <option value="publish" {{ $course->status == 'publish' ? 'selected' : '' }}>
                            {{ __('Publish') }}</option>
                    </select>
                </div>
            </form>

            <div class="flex justify-end space-x-4">
                <button type="button"
                    class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline"
                    onclick="toggleModal('batchModal')">
                    {{ __('Create Batch') }}
                </button>
            </div>
            <!-- Modal -->
            <div id="batchModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                    <div
                        class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Create Batch') }}</h3>
                                <button type="button" class="text-gray-400 hover:text-gray-500"
                                    onclick="toggleModal('batchModal')">
                                    <span class="sr-only">{{ __('Close') }}</span>
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="mt-2">
                                <div>
                                    @csrf

                                    <input type="hidden" name="course_id">
                                    <div class="mb-4">
                                        <label class="block mb-2 text-sm font-bold text-gray-700"
                                            for="batch_name">{{ __('Batch Name') }}</label>
                                        <input
                                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                            id="batch_name" type="text" name="batch_name" required>
                                    </div>
                                    <div class="flex items-center justify-end">
                                        <button type="button"
                                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                            onclick="formHandler()">
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mt-8"></div>
            <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Batches') }}</h3>
            <ul class="mt-4 space-y-4">
                @foreach ($course->batchs as $batch)
                    <li class="p-4 bg-white rounded shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-md font-semibold">{{ $batch->name }}</h4>
                            </div>
                            <div class="flex space-x-2">


                                <button type="button"
                                    class="px-2 py-1 text-sm font-bold text-white bg-red-500 rounded hover:bg-red-700 focus:outline-none focus:shadow-outline" onclick="">
                                    {{ __('Delete') }}
                                </button>

                                <button type="button"
                                    class="px-2 py-1 text-sm font-bold text-white bg-green-500 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline"
                                    onclick="toggleModuleModal('{{ $batch->id }}')">
                                    {{ __('Add Module') }}
                                </button>
                            </div>
                        </div>
                        <ul class="mt-2 space-y-2">
                            @foreach ($batch->modules as $module)
                                <li class="p-2 bg-gray-100 rounded">
                                    <div class="flex items-center justify-between">
                                        <span>{{ $module->name }}</span>
                                        <div class="flex space-x-2">


                                            <button type="button"
                                                class="px-2 py-1 text-xs font-bold text-white bg-red-500 rounded hover:bg-red-700 focus:outline-none focus:shadow-outline">
                                                {{ __('Delete') }}
                                            </button>

                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Module Modal -->
        <div id="moduleModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                <div
                    class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Add Module') }}</h3>
                            <button type="button" class="text-gray-400 hover:text-gray-500"
                                onclick="toggleModuleModal()">
                                <span class="sr-only">{{ __('Close') }}</span>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="mt-2">
                            <div>
                                @csrf
                                <input type="hidden" id="batch_id" name="batch_id">
                                <div class="mb-4">

                                    <label class="block mb-2 text-sm font-bold text-gray-700"
                                        for="module_id">{{ __('Module Name') }}</label>
                                    <select
                                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                        id="module_id" name="module_id" required>
                                        @foreach ($all_modules as $module)
                                            <option value="{{ $module->id }}">{{ $module->code }} -
                                                {{ $module->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex items-center justify-end">
                                    <button type="button"
                                        class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                        onclick="moduleFormHandler()">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function toggleModuleModal(batchID = null) {
                document.getElementById('moduleModal').classList.toggle('hidden');
                if (batchID) {
                    document.getElementById('batch_id').value = batchID;
                }
            }

            function moduleFormHandler() {
                const formData = {
                    module_id: document.getElementById('module_id').value,
                    batch_id: document.getElementById('batch_id').value
                };

                fetch("{{ route('batch.add_module') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        toggleModuleModal();
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Form submission failed!');
                    });
            }
        </script>


        <script>
            const storeBatchUrl = "{{ route('batch.store') }}";
            const courseID = "{{ $course->id }}";

            function toggleModal(modalID) {
                document.getElementById(modalID).classList.toggle('hidden');
            }

            function formHandler() {
                const formData = {
                    name: document.getElementById('batch_name').value,
                    course_id: courseID
                };

                fetch(storeBatchUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        toggleModal('batchModal');
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Form submission failed!');
                    });
            }
        </script>
    </div>
    </div>
</x-app-layout>
