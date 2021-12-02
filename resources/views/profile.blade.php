{{-- inharet the app layout --}}
@extends('layouts.app')
{{-- set the title of the page --}}
@section('title', 'profile')
{{-- section for the contect of this page --}}
@section('content')
    {{-- include the navbar section --}}
    @include('includes.navbar')

    <div class="w-full h-full flex align-content-center">
        {{-- left side div --}}
        <div class="ml-14 my-12 w-full">
            {{-- page indecator div --}}
            <div class="flex items-baseline justify-between ml-6">
                <h1 class="text-2xl">Profile</h1>
            </div>
            {{-- to display massages --}}
            @if (Session::get('message'))
                <div class="mt-4 flex justify-center bg-green-500 border rounded-md border-green-500">
                    <span class="text-base tracking-wide text-white">{{ Session::get('message') ?? '' }}</span>
                </div>
            @endif
            {{-- to display alert massages --}}
            @if (Session::get('alert'))
                <div class="mt-4 flex justify-center bg-yellow-500 border rounded-md border-yellow-500">
                    <span class="text-base tracking-wide text-white">{{ Session::get('alert') ?? '' }}</span>
                </div>
            @endif
            {{-- to display error massages --}}
            @if (Session::get('error'))
                <div class="mt-4 flex justify-center bg-red-500 border rounded-md border-red-500">
                    <span class="text-base tracking-wide text-white">{{ Session::get('error') }}</span>
                </div>
            @endif
            <div class="flex flex-row w-full h-full">
                {{-- left section --}}
                <div class="flex flex-col w-1/6 h-full">
                    {{-- top section --}}
                    <div class="bg-white p-4 flex flex-row h-1/3 w-full rounded-md shadow-md mt-20 ml-6 ">

                    </div>
                    {{-- bottom section --}}
                    {{-- <div class="bg-white p-4 flex flex-row h-1/3 w-full rounded-md shadow-md mt-10 ml-6 ">

                    </div> --}}
                </div>
                {{-- right section --}}
                <div class="w-full p-2 mx-20 mt-20 h-3/4 bg-white flex flex-col rounded-md shadow-md">
                    {{-- image div --}}
                    <div class="flex flex-wrap justify-center sm:mt-6 sm:ml-4">
                        <div class="w-8/12 sm:w-40 px-4">
                            <img src="https://mdbootstrap.com/img/new/avatars/15.jpg" alt="..."
                                class="rounded-full max-w-full h-auto align-middle border-none" />
                        </div>
                    </div>
                    {{-- content div --}}
                    <div class="flex flex-col justify-center items-center mt-16">
                        <form action="">
                            {{-- username --}}
                            <label for="username"
                                class="block text-xs font-semibold text-gray-600 uppercase">Username:</label>
                            <input type="text" value="{{ $user->name }}" name="username"
                                class="px-4 py-2 my-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white"
                                disabled>
                            {{-- email --}}
                            <label for="email" class="block text-xs font-semibold text-gray-600 uppercase">Email:</label>
                            <input type="text" value="{{ $user->email }}" name="email"
                                class="px-4 py-2 my-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white"
                                disabled>
                            {{-- phone number --}}
                            <label for="number"
                                class="block text-xs font-semibold text-gray-600 uppercase">Phone number:</label>
                            <input type="text" value="{{ $user->mobile_number }}" name="number"
                                class="px-4 py-2 my-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white"
                                disabled>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- </div> --}}


@endsection
