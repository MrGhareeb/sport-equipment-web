@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="flex items-center justify-center m-0 w-full">
        <div class="px-8 py-6 mt-4 text-left bg-white shadow-xl border border-white rounded-2xl">
            <div class="flex justify-center">
                {{-- logo here --}}
            </div>
            <h3 class="text-2xl font-bold text-center">Login to your account</h3>
            <form method="POST" action="">
                @csrf
                @if (Session::get('error'))
                    <div class="mt-4 flex justify-center bg-red-500 border rounded-md border-red-500">
                        <span class="text-base tracking-wide text-white">{{ Session::get('error') }}</span>
                    </div>
                @endif

                @if (Session::get('message'))
                    <div class="mt-4 flex justify-center bg-green-500 border rounded-md border-green-500">
                        <span class="text-base tracking-wide text-white">{{ Session::get('message') }}</span>
                    </div>
                @endif

                <div class="mt-4">
                    <label class="block" for="email">Email<label>
                            <input type="text" name="email" placeholder="Email"
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                            <span
                                class="text-xs tracking-wide text-red-600">@error('email'){{ $message }}@enderror</span>
                    </div>
                    <div class="mt-4">
                        <label class="block">Password<label>
                                <input type="password" name="password" placeholder="Password"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                <span
                                    class="text-xs tracking-wide text-red-600">@error('password'){{ $message }}@enderror</span>
                        </div>

                        <div class="mt-4 flex justify-center">
                            <a href="{{ route('register') }}"
                                class="text-sm text-blue-600 hover:underline w-full text-center">Dont have an account?
                                Register</a>
                        </div>

                        <div class="flex items-baseline justify-between">
                            <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
                            <input type="submit" class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900"></input>
                        </div>
                </div>
                </form>
            </div>
            </div>

        @endsection
