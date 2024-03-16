<table class="h-[100%] z-0 w-[100%] p-0 table-fixed" id="company-day">

    @php
        $sections = $company->sections;
        $sectionsC = $sections->count();
    @endphp
    <tr>
        @for ($i = 0; $i < $sectionsC; $i++)
            <td class="w-[100%]"></td>
        @endfor

    </tr>
    @foreach ($timings as $timing)
        <tr class="relative w-[100%]">
            {{-- <livewire:create-session :company="$company" :date="$date" :timing="$timing" :modules="$modules" :teachers="$teachers" :rooms="$rooms"> --}}
            <!-- Inside your blade file -->
            {{-- <button wire:click:create-session="toggleVisibility">Reload Component</button> --}}
            {{-- <livewire:create-session / --}}
            @if ($sessions->where('sessionable_type', 'App\\Models\\Company')->where('session_date', $date)->where('timing_id', $timing->id)->where('sessionable_id', $company->id)->isNotEmpty())
                @php
                    $cour = true;
                    $c = $sessions
                        ->where('sessionable_type', 'App\\Models\\Company')
                        ->where('session_date', $date)
                        ->where('timing_id', $timing->id)
                        ->where('sessionable_id', $company->id)
                        ->first();
                @endphp
                <td colspan="3" style="width:100%;" @if ($timing->id == 1) class="w-[100%]" @endif>
                    @if ($c->absented == 1)
                        <div class="flex flex-col justify-center pt-4 p-4 items-center rounded-xl bg-red-50 ">
                        @else
                            <div class="flex flex-col justify-center pt-4 p-4 items-center rounded-xl bg-indigo-100 ">
                    @endif


                    <p class=" text-xl  bg-slate-100 px-2 rounded-xl font-bold">{{ $c->teacher->teacher_name }} </p>
                    <p class=" font-normal">{{ $c->module->module }}</p>
                    <p class= " font-bold">{{ $c->room->room }}</p>
                    <div class="flex updateformparent relative justify-center self-end  items-center space-x-2">
                        <button class="h-10 update-button rounded-lg  p-2 font-bold w-10 hover:bg-white bg-slate-200"
                            title="Update this session">
                            <img src="/svg/pen-thin.svg" alt="">
                        </button>
                        <form action="{{ route('sessions.update', ['id' => $c->id]) }}"
                            class="update-form flex flex-col justify-center space-y-4 items-center  text-xl w-[300px] h-[300px] ease-in z-30 hidden absolute bg-white shadow-xl rounded-xl top-10 right-2">
                            @csrf

                            <a
                                class="absolute top-2 right-2 hover:cursor-pointer company-update-cancel-button bg-slate-400 h-6 w-6 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                                    <path
                                        d="M208.49,191.51a12,12,0,0,1-17,17L128,145,64.49,208.49a12,12,0,0,1-17-17L111,128,47.51,64.49a12,12,0,0,1,17-17L128,111l63.51-63.52a12,12,0,0,1,17,17L145,128Z" />
                                </svg>
                            </a>
                            <div class="flex justify-center items-center w-[100%]">
                                <label for="module" class="w-[100px]">Module</label>
                                <select name="module_id" id="module" class="w-[150px] h-10 rounded-lg">
                                    {{-- DISPLAY MODULES  --}}
                                    @foreach ($modules as $module)
                                        <option value="{{ $module->id }}">{{ $module->module }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex justify-center items-center w-[100%]">
                                <label for="room" class="w-[100px]">Teacher</label>
                                <select name="teacher_id" id="room" class="w-[150px] h-10 rounded-lg">
                                    {{-- DISPLAY TEACHERS ACCORDING TO THE MOODULE --}}
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">
                                            {{ $teacher->teacher_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex justify-center items-center w-[100%]">
                                <label for="room" class="w-[100px]">Room</label>
                                <select name="room_id" id="room" class="w-[150px] h-10 rounded-lg">
                                    {{-- DISPLAY ROOMS THAT ARE AVAILABLE --}}
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->room }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="submit" name="submit" id="" value="Update"
                                class="bg-indigo-300 rounded-lg shadow-lg h-10 w-28">
                        </form>
                        <form action="{{ route('sessions.delete', ['id' => $c->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <button type="submit" title="Delete this session"
                                class="rounded-lg w-10 p-2 bg-red-400 h-10">
                                <img src="/svg/trash.svg" alt="">
                            </button>

                        </form>
                        @if ($c->absented == 1)
                            <button type="button" title="Delete this session"
                                class="rounded-lg w-10 p-2 bg-violet-400 h-10">
                                <img src="/svg/trash.svg" alt="">
                            </button>
                        @else
                            <form action="{{ route('sessions.mark_absence', ['id' => $c->id]) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <button type="submit" title="Mark as absented"
                                    class="rounded-lg hover:bg-gray-100  w-10 p-2 bg-gray-400 h-10">
                                    <img src="/svg/absence.svg" alt="">
                                </button>

                            </form>
                        @endif


                    </div>
                    </div>

                </td>
            @else
                @php
                    $td = false;
                @endphp
                @foreach ($sections as $section)
                    <td class=" text-center w-[150px]  h-[160px]  ">
                        @if ($sessions->where('sessionable_type', 'App\\Models\\Section')->where('session_date', $date)->where('timing_id', $timing->id)->where('sessionable_id', $section->id)->isNotEmpty())
                            @php
                                $td = true;
                                $s = $sessions
                                    ->where('sessionable_type', 'App\\Models\\Section')
                                    ->where('session_date', $date)
                                    ->where('timing_id', $timing->id)
                                    ->where('sessionable_id', $section->id)
                                    ->first();
                            @endphp
                            <div
                                class="h-[160px] flex flex-col border-2 bg-indigo-300 rounded-xl justify-center items-center">
                                <p class=" text-lg font-bold">{{ $s->teacher->teacher_name }}</p>
                                <p class="text-xl font-normal">{{ $s->module->module }}</p>
                                <p class= "text-xl font-bold">{{ $s->room->room }}</p>
                                <div class="flex updateformparent relative justify-center items-center mt-4 space-x-2">
                                    <button class="h-8 update-button rounded-xl  p-1 font-bold w-8 bg-slate-200">
                                        <img src="/svg/pen-thin.svg" alt="">
                                    </button>
                                    <form action="{{ route('sessions.update', ['id' => $s->id]) }}"
                                        class="update-form flex flex-col justify-center space-y-4 items-center  text-xl w-[300px] h-[300px] ease-in z-20 hidden absolute bg-white shadow-xl rounded-xl top-10 right-2">
                                        @csrf
                                        <a
                                            class="absolute top-4 right-4 section-update-cancel-button hover:cursor-pointer  bg-slate-400 h-6 w-6 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"
                                                fill="currentColor">
                                                <path
                                                    d="M208.49,191.51a12,12,0,0,1-17,17L128,145,64.49,208.49a12,12,0,0,1-17-17L111,128,47.51,64.49a12,12,0,0,1,17-17L128,111l63.51-63.52a12,12,0,0,1,17,17L145,128Z" />
                                            </svg>
                                        </a>
                                        <div class="flex justify-center items-center w-[100%]">
                                            <label for="module" class="w-[100px]">Module</label>
                                            <select name="module_id" id="module" class="w-[150px] h-10 rounded-lg">
                                                {{-- DISPLAY MODULES  --}}
                                                @foreach ($modules as $module)
                                                    <option value="{{ $module->id }}">{{ $module->module }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex justify-center items-center w-[100%]">
                                            <label for="room" class="w-[100px]">Teacher</label>
                                            <select name="teacher_id" id="room" class="w-[150px] h-10 rounded-lg">
                                                {{-- DISPLAY TEACHERS ACCORDING TO THE MOODULE --}}
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}">
                                                        {{ $teacher->teacher_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex justify-center items-center w-[100%]">
                                            <label for="room" class="w-[100px]">Room</label>
                                            <select name="room_id" id="room" class="w-[150px] h-10 rounded-lg">
                                                {{-- DISPLAY ROOMS THAT ARE AVAILABLE --}}
                                                @foreach ($rooms as $room)
                                                    <option value="{{ $room->id }}">{{ $room->room }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="submit" name="submit" id="" value="Update"
                                            class="bg-indigo-300 rounded-lg shadow-lg h-10 w-28">
                                    </form>
                                    <form action="{{ route('sessions.delete', ['id' => $s->id]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" class="rounded-lg w-8 p-1 bg-red-400 h-8">
                                            <img src="/svg/trash.svg" alt="">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div
                                class="relative sectionparentofform h-[100%] flex justify-center items-center border-2">
                                <button
                                    class="flex section-button items-center justify-center p-2 w-10 h-10 rounded-full bg-slate-300 hover:bg-yellow-50 z-0">
                                    <img src="/svg/pen-thin.svg" alt="">
                                </button>

                                <form action="{{ route('sessions.store') }}"
                                    class="section-form  bg-slate-50 hidden absolute  rounded-[20px] shadow-lg text-xl w-[300px] h-[350px]"
                                    style="top: 50px; left: 50px;z-index: 50;" method="post">
                                    @csrf
                                    <input type="hidden" name="date" value="{{ $date }}">
                                    <input type="hidden" name="timing_id" value="{{ $timing->id }}">
                                    <input type="hidden" name="week_id" value="{{ $week_id }}">
                                    <input type="hidden" name="sessionable_type" value="App\Models\Section">
                                    <input type="hidden" name="sessionable_id" value="{{ $section->id }}">
                                    <input type="hidden" name="session_type" value="td">
                                    <div class=" h-[100%] w-[100%] flex  flex-col justify-around items-center">
                                        <a
                                            class="absolute top-4 right-4 section-cancel-button hover:cursor-pointer  bg-slate-400 h-6 w-6 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"
                                                fill="currentColor">
                                                <path
                                                    d="M208.49,191.51a12,12,0,0,1-17,17L128,145,64.49,208.49a12,12,0,0,1-17-17L111,128,47.51,64.49a12,12,0,0,1,17-17L128,111l63.51-63.52a12,12,0,0,1,17,17L145,128Z" />
                                            </svg>
                                        </a>
                                        <div>
                                            <h2 class=""> {{ $section->section }}</h2>
                                            <h2> {{ $date }}</h2>
                                            <h2> {{ $timing->session_start }} -> {{ $timing->session_finish }}</h2>
                                        </div>
                                        <div class="mb-4">
                                            <div class="flex justify-center items-center w-[100%]">
                                                <label for="module" class="w-[100px]">Module</label>
                                                <select name="module_id" id="module"
                                                    class="w-[100px] h-6 rounded-lg">
                                                    {{-- DISPLAY MODULES  --}}
                                                    @foreach ($modules as $module)
                                                        <option value="{{ $module->id }}">{{ $module->module }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="flex justify-center items-center w-[100%]">
                                                <label for="room" class="w-[100px]">Teacher</label>
                                                <select name="teacher_id" id="room"
                                                    class="w-[100px] h-6 rounded-lg">
                                                    {{-- DISPLAY TEACHERS ACCORDING TO THE MOODULE --}}
                                                    @foreach ($teachers as $teacher)
                                                        <option value="{{ $teacher->id }}">
                                                            {{ $teacher->teacher_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="flex justify-center items-center w-[100%]">
                                                <label for="room" class="w-[100px]">Room</label>
                                                <select name="room_id" id="room"
                                                    class="w-[100px] h-6 rounded-lg">
                                                    {{-- DISPLAY ROOMS THAT ARE AVAILABLE --}}
                                                    @foreach ($rooms as $room)
                                                        <option value="{{ $room->id }}">{{ $room->room }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <input type="submit" value="submit"
                                                class="h-10 w-16 rounded-lg bg-slate-300">
                                        </div>
                                    </div>

                                </form>
                            </div>
                        @endif
                    </td>
                @endforeach
                <td class="parentofform absolute w-0 h-0  right-2 top-1 z-20">
                    @if ($td == false)
                        <button
                            class="absolute company-button z-0  top-4 right-4 cancel-button hover:cursor-pointer bg-slate-500 h-6 w-6 rounded-full"></button>
                    @endif
                    <form action="{{ route('sessions.store') }}" enctype="multipart/form-data"
                        class="hidden rounded-[20px] shadow-lg text-xl w-[300px] h-[300px] bg-white company-form absolute"
                        style="top: 10px; left: 10px;z-index: 50;" method="post">
                        @csrf
                        <input type="hidden" name="date" value="{{ $date }}">
                        <input type="hidden" name="timing_id" value="{{ $timing->id }}">
                        <input type="hidden" name="week_id" value="{{ $week_id }}">
                        <input type="hidden" name="sessionable_type" value="App\Models\Company">
                        <input type="hidden" name="sessionable_id" value="{{ $company->id }}">
                        <input type="hidden" name="session_type" value="cour">

                        <div class=" h-[100%] w-[100%] flex  flex-col justify-around items-center">
                            <a
                                class="absolute top-4 right-4 company-cancel-button hover:cursor-pointer  bg-slate-400 h-6 w-6 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                                    <path
                                        d="M208.49,191.51a12,12,0,0,1-17,17L128,145,64.49,208.49a12,12,0,0,1-17-17L111,128,47.51,64.49a12,12,0,0,1,17-17L128,111l63.51-63.52a12,12,0,0,1,17,17L145,128Z" />
                                </svg>
                            </a>
                            <div>
                                <h2 class="">Company : {{ $company->company }} </h2>
                                <h2> {{ $date }}</h2>
                                <h2> {{ $timing->session_start }} -> {{ $timing->session_finish }}</h2>
                            </div>
                            <div class="mb-4">
                                <div class="flex justify-center items-center w-[100%]">
                                    <label for="room" class="w-[100px]">Module</label>
                                    <select name="module_id" id="room" class="w-[100px] h-6 rounded-lg">
                                        @foreach ($modules as $module)
                                            <option value="{{ $module->id }}">{{ $module->module }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex justify-center items-center w-[100%]">
                                    <label for="room" class="w-[100px]">Teacher</label>
                                    <select name="teacher_id" id="room" class="w-[100px] h-6 rounded-lg">
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">
                                                {{ $teacher->teacher_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex justify-center items-center w-[100%]">
                                    <label for="room" class="w-[100px]">Room</label>
                                    <select name="room_id" id="room" class="w-[100px] h-6 rounded-lg">
                                        @foreach ($rooms as $room)
                                            <option value="{{ $room->id }}">{{ $room->room }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <input type="submit" value="submit" class="h-10 w-20 rounded-lg bg-slate-300">
                            </div>
                        </div>
                    </form>
                </td>
            @endif
        </tr>
    @endforeach

</table>
