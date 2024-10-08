<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-semibold">Welcome, {{ Auth::user()->name }}</h1>
                    <hr>
                    <h2 class="text-xl font-semibold">{{ Auth::user()->student->batch->course->name }} -
                        {{ Auth::user()->student->batch->name }}</h2>
                    <hr>
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="p-4 text-red-700 bg-red-100 border border-red-400 rounded">
                                <strong>{{ __('Whoops! Something went wrong.') }}</strong>
                                <ul class="mt-3 text-sm text-red-600 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    <br>
                    <h2 class="text-xl font-semibold">Core Modules</h2>
                    <ul class="pl-5 list-disc">

                        @foreach (Auth::user()->student->batch->modules as $module)
                            @if ($module->category == 'core')
                                <li>Semester : #{{ $module->semester }} - [ {{ $module->code }} ] {{ $module->name }}
                                    ({{ $module->category }})
                                </li>
                            @endif
                        @endforeach
                    </ul>

                    <h2 class="text-xl font-semibold">Select Elective Modules</h2>

                    <form method="post" action="{{route('elective-module-selection.store')}}">
                        <input type="hidden" name="course_id" value="{{ Auth::user()->student->batch->course->id }}">
                        <input type="hidden" name="student_id" value="{{ Auth::user()->student->id }}">
                        <input type="hidden" name="batch_id" value="{{ Auth::user()->student->batch->id }}">
                        @csrf

                        <ul class="pl-5 list-disc">
                            @foreach ($semesters as $semester)
                                <li>Semester # {{ $semester->semester }} | <span class="text-red-500">please
                                        select {{ $semester->elective_module_count }} modules</span> </li>
                                <ul class="pl-5 list-disc">
                                    @foreach (Auth::user()->student->batch->getElectiveModulesBySemester($semester->semester) as $module)
                                        <li>
                                            <input type="checkbox" name="semester_{{$semester->semester}}_modules[]" value="{{ $module->id }}">
                                            [ {{ $module->code }} ] {{ $module->name }} ({{ $module->category }})
                                        </li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </ul>

                        <div class="mt-4">
                            <x-primary-button>
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
