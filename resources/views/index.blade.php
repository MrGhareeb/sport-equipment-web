@extends('layouts.app')
@section('title', 'Home page')

@section('content')
    @include('includes.navbar')

    <div class="flex flex-row w-screen my-6  mx-4">
        <div class="w-3/4 h-full flex align-content-center">
            {{-- left side div --}}
            <div class="ml-14 my-12 w-full">
                {{-- page indecator div --}}
                <div class="flex items-baseline justify-between mr-4">
                    <h1 class="text-2xl">Items dashboard</h1>
                    <a href="" class="bg-blue-500 text-white hover:text-red-500 rounded-md w-48 py-2 text-center">Add new
                        Item</a>
                </div>
                {{-- componenet div --}}
                <div class="flex flex-col items-center w-full">
                    <div class="my-8 p-8 border border-white rounded-lg bg-gray-400">
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Incidunt quasi illum veritatis dolor
                            debitis vel commodi neque accusantium libero, deserunt eaque sed reprehenderit eius tenetur sit
                            facilis, fuga non sapiente.</p>
                    </div>
                </div>
                {{-- end of component div --}}
            </div>
        </div>
        {{-- right side div --}}
        <div class="flex justify-center my-12 w-1/4">
            {{-- filter div --}}
            <div class="w-4/5 h-2/4 border border-gray-700 bg-gray-700 rounded-lg"></div>
        </div>
        {{-- end of filter div --}}
    </div>
    {{-- end of right side div --}}
    </div>



@endsection
