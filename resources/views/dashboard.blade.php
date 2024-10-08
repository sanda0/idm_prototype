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

                    @php
                        $user = Auth::user();
                    @endphp

                    @if ($user->hasRole('Student'))



                        <h1 class="text-2xl font-semibold">Welcome, {{ $user->name }}</h1>
                        <hr>
                        <h2 class="text-xl font-semibold">{{ $user->student->batch->course->name }} -
                            {{ $user->student->batch->name }}</h2>
                        <ul class="pl-5 list-disc">
                            @foreach ($user->student->batch->modules->where('category','core') as $module)
                                <li>Semester : #{{ $module->semester }} - [ {{ $module->code }} ] {{ $module->name }} ({{$module->category}})
                                </li>
                                
                            @endforeach
                            @foreach ($user->student->electiveModules() as $e)
                                <li>Semester : #{{ $e->module->semester }} - [ {{ $e->module->code }} ] {{ $e->module->name }} ({{$e->module->category}})
                                </li>
                                
                            @endforeach
                        </ul>



                    @endif

                    @if ($user->hasRole('Teacher'))
                        <h1 class="text-2xl font-semibold">Welcome, {{ $user->name }}</h1>
                        <hr>
                        <h2 class="text-xl font-semibold">{{ $user->teacher->course->name }}</h2>
                        <ul class="pl-5 list-disc">
                            @foreach ($user->teacher->course->batchs as $batch)
                                <li>{{ $batch->name }}</li>
                                <ul class="pl-5 list-disc">
                                    @foreach ($batch->modules as $module)
                                        <li>Semester : #{{ $module->semester }} - [ {{ $module->code }} ]
                                            {{ $module->name }}</li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </ul>

                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
