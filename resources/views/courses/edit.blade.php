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

            <hr>

            <div class="flex justify-end mt-8 space-x-4">
                <button type="button"
                    class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline"
                    onclick="toggleModal('batchModal')">
                    {{ __('Create Batch') }}
                </button>
            </div>

            {{-- rules  --}}

            <div class="mt-8">
                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Rules') }}</h3>
                <div class="mb-4"></div>
                <form id="ruleForm" class="flex space-x-4">
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <div class="flex-1">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="rule_semester">
                            {{ __('Semester') }}
                        </label>
                        <input
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="rule_semester" type="number" name="rule_semester" required>
                    </div>
                    <div class="flex-1">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="elective_module_count">
                            {{ __('Elective Module Count') }}
                        </label>
                        <input
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="elective_module_count" type="number" name="elective_module_count" required>
                    </div>
                    <div class="flex items-end">
                        <button type="button"
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                            onclick="addRule()">
                            {{ __('Add Rule') }}
                        </button>
                    </div>
                </form>

                <div class="mt-8">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    {{ __('Semester') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    {{ __('Elective Module Count') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    {{ __('Actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($course->rules as $rule)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $rule->semester }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $rule->elective_module_count }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button type="button"
                                            class="px-2 py-1 text-xs font-bold text-white bg-red-500 rounded hover:bg-red-700 focus:outline-none focus:shadow-outline"
                                            onclick="deleteRule('{{ $rule->id }}')">
                                            {{ __('Delete') }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

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
                                <h4 class="font-semibold text-md">{{ $batch->name }}</h4>
                            </div>
                            <div class="flex space-x-2">
                                @if ($course->isEditable())
                                    <button type="button"
                                        class="px-2 py-1 text-sm font-bold text-white bg-red-500 rounded hover:bg-red-700 focus:outline-none focus:shadow-outline"
                                        onclick="deleteBatch('{{ $batch->id }}')">
                                        {{ __('Delete') }}
                                    </button>

                                    <button type="button"
                                        class="px-2 py-1 text-sm font-bold text-white bg-green-500 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline"
                                        onclick="toggleModuleModal('{{ $batch->id }}')">
                                        {{ __('Add Module') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                        <ul class="mt-2 space-y-2">
                            @foreach ($batch->modules as $module)
                                <li class="p-2 bg-gray-100 rounded">
                                    <div class="flex items-center justify-between">
                                        <span>Semester : #{{ $module->semester }} - [ {{ $module->code }}
                                            ]{{ $module->name }} 
                                                ({{ $module->category}})
                                             </span>
                                        <div class="flex space-x-2">

                                            @if ($course->isEditable())
                                                <button type="button"
                                                    onclick="removeModule('{{ $module->id }}', '{{ $batch->id }}')"
                                                    class="px-2 py-1 text-xs font-bold text-white bg-red-500 rounded hover:bg-red-700 focus:outline-none focus:shadow-outline">
                                                    {{ __('Remove') }}
                                                </button>
                                            @endif

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

            function deleteBatch(batchID) {
                if (confirm('Are you sure you want to delete this batch?')) {
                    fetch("{{ route('batch.destroy') }}", {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                batch_id: batchID
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            window.location.reload();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Form submission failed!');
                        });
                }
            }

            function removeModule(moduleID, batchID) {
                if (confirm('Are you sure you want to remove this module?')) {
                    fetch("{{ route('batch.remove_module') }}", {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                module_id: moduleID,
                                batch_id: batchID
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            window.location.reload();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Form submission failed!');
                        });
                }
            }

            function addRule() {
                const formData = {
                    course_id: courseID,
                    semester: document.getElementById('rule_semester').value,
                    elective_module_count: document.getElementById('elective_module_count').value
                };

                fetch("{{ route('rules.store') }}", {
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
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Form submission failed!');
                    });
            }

            function deleteRule(ruleID) {
                if (confirm('Are you sure you want to delete this rule?')) {
                    fetch("{{ route('rules.destroy') }}", {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                rule_id: ruleID
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            window.location.reload();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Form submission failed!');
                        });
                }
            }



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
