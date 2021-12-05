@extends("layouts.app")
@section('title', 'test')
@section('content')
    @include("includes.navbar")
    <div class="container mx-auto my-5 p-5">
        <div class="md:flex no-wrap md:-mx-2 ">
            <!-- Left Side -->
            <div class="w-full md:w-3/12 md:mx-2">
                <!-- Profile Card -->
                <div class="bg-white p-3 border-t-4">
                    <div class="image overflow-hidden">
                        <img class="h-auto w-full mx-auto" src="{{ Avatar::create($user->name)->toBase64() }}" alt="">
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
                    <form action="">
                        <div class="text-gray-700">
                            <div class="grid md:grid-cols-2 text-sm">
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Full Name</div>
                                    <div class="px-4 py-2">
                                        <input type="text"
                                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white"
                                            value="{{ $user->name }}" style="margin-top:-1em">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Contact No.</div>
                                    <div class="px-4 py-2">
                                        <div class=""">
                                                                <input type=" text"
                                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white"
                                            value="{{ $user->mobile_number }}" style="margin-top:-1em">
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Privacy.</div>
                                    <div class="px-4 py-2">
                                        <select
                                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white"
                                            style="margin-top:-1em" name="privacy" id="">
                                            @if ($user->private)
                                                <option selected value="0">
                                                    private
                                                </option>
                                                <option value="1">
                                                    Public
                                                </option>
                                            @else
                                                <option selected value="1">
                                                    Public
                                                </option>
                                                <option value="0">
                                                    private
                                                </option>

                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Email.</div>
                                    <div class="px-4 py-2">
                                        <input type="email"
                                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white"
                                            value="{{ $user->email }}" style="margin-top:-1em">
                                    </div>
                                </div>
                                {{--  --}}
                                <div class="col-span-2 py-2 mb-3">
                                    <h3 class="w-full text-center text-red-500">Fell when password change is intended</h3>
                                </div>

                                {{-- password section --}}
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Old password.</div>
                                    <div class="px-4 py-2">
                                        <input type="password"
                                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white"
                                            style="margin-top:-1em">
                                    </div>
                                </div>
                                {{-- new password --}}
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">New password.</div>
                                    <div class="px-4 py-2">
                                        <input type="password"
                                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white"
                                            style="margin-top:-1em">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit"
                            class="block w-full bg-blue-200 text-sm font-semibold rounded-lg hover:bg-blue-500 focus:outline-none focus:shadow-outline focus:bg-blue-500 hover:shadow-xs p-3 my-4 text-center"
                            value="Save"></input>
                        {{-- delete button --}}
                        <a href=""
                            class="block w-full text-black bg-red-200 text-sm font-semibold rounded-lg hover:bg-red-400 focus:outline-none focus:shadow-outline focus:bg-red-400 hover:shadow-xs p-3 my-4 text-center"
                            >Delete account</a>
                </div>
                </form>
                <!-- End of about section -->

                <div class="my-4"></div>

                <!-- Experience and education -->
                <div class="bg-white p-3 shadow-sm rounded-sm">

                    <div class="grid grid-cols-2">
                        <div>
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                <span clas="text-green-500">
                                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </span>
                                <span class="tracking-wide">Experience</span>
                            </div>
                            <ul class="list-inside space-y-2">
                                <li>
                                    <div class="text-teal-600">test</div>
                                    <div class="text-gray-500 text-xs">test</div>
                                </li>

                            </ul>
                        </div>
                        <div>
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                <span clas="text-green-500">
                                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                        <path fill="#fff"
                                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222">
                                        </path>
                                    </svg>
                                </span>
                                <span class="tracking-wide">Education</span>
                            </div>
                            <ul class="list-inside space-y-2">

                            </ul>
                        </div>
                    </div>
                    <!-- End of Experience and education grid -->
                </div>
                <!-- End of Experience and education grid -->
            </div>
            <!-- End of profile tab -->
        </div>
    </div>
@endsection
