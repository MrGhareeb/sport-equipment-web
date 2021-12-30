@extends("layouts.app")
@section('title', 'Profile')
@section('content')
    @include("includes.navbar")
    <div class="container mx-auto my-5 p-5">
        {{-- to display massages --}}
        @if (Session::get('message'))
            <div class="mb-4 flex justify-center bg-green-500 border rounded-md border-green-500">
                <span class="text-base tracking-wide text-white">{{ Session::get('message') ?? '' }}</span>
            </div>
        @endif
        {{-- to display alert massages --}}
        @if (Session::get('alert'))
            <div class="mb-4 flex justify-center bg-yellow-500 border rounded-md border-yellow-500">
                <span class="text-base tracking-wide text-white">{{ Session::get('alert') ?? '' }}</span>
            </div>
        @endif
        {{-- to display error massages --}}
        @if (Session::get('error'))
            <div class="mb-4 flex justify-center bg-red-500 border rounded-md border-red-500">
                <span class="text-base tracking-wide text-white">{{ Session::get('error') }}</span>
            </div>
        @endif
        <div class="md:flex no-wrap md:-mx-2 ">
            <!-- Left Side -->
            <div class="w-full md:w-3/12 md:mx-2">
                <!-- Profile Card -->
                <div class="bg-white p-3 border-t-4">
                    <div class="image overflow-hidden">
                        <img class="h-auto w-full mx-auto"
                            src="{{ Avatar::create($user->name)->setDimension(300)->setFontSize(75)->toBase64() }}"
                            alt="">

                    </div>
                    <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{ $user->name }}</h1>
                    <ul
                        class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                        <li class="flex items-center py-3">
                            <span>Status</span>
                            <span class="ml-auto"><span
                                    class="bg-green-500 py-1 px-2 rounded text-white text-sm">Active</span></span>
                        </li>
                        <li class="flex items-center py-3">
                            <span>Member since</span>
                            <span class="ml-auto">{{ $user->created_at }}</span>
                        </li>
                    </ul>
                </div>
                <!-- End of profile card -->
                <div class="my-4"></div>
                <!-- Friends card -->
                <!-- End of friends card -->
            </div>
            <!-- Right Side -->
            <div class="w-full md:w-9/12 mx-2 h-64">
                <!-- Profile tab -->
                <!-- About Section -->
                <div class="bg-white p-3 shadow-sm rounded-sm">
                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                        <span clas="text-green-500">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span class="tracking-wide">About</span>
                    </div>
                    <div class="text-gray-700">
                        <div class="grid md:grid-cols-2 text-sm">
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Full Name</div>
                                <div class="px-4 py-2">{{ $user->name }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Contact No.</div>
                                <div class="px-4 py-2">{{ $user->mobile_number }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Privacy.</div>
                                @if ($user->private)
                                    <div class="px-4 py-2">Private</div>
                                @else
                                    <div class="px-4 py-2">Public</div>
                                @endif
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Email.</div>
                                <div class="px-4 py-2">
                                    <a class="text-blue-800" href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('EditProfile') }}"
                        class="block w-full bg-blue-200 text-sm font-semibold rounded-lg hover:bg-blue-300 focus:outline-none focus:shadow-outline focus:bg-blue-300 hover:shadow-xs p-3 my-4 text-center">Edit
                        profile</a>
                </div>
                <!-- End of about section -->

                <div class="my-4"></div>

                
                <!-- End of profile tab -->
            </div>
        </div>
    </div>
    </div>
@endsection
