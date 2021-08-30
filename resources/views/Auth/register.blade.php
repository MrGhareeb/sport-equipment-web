@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="flex items-center justify-center m-0 w-full">
        <div class="px-8 py-6 mt-4 text-left bg-white shadow-xl border border-white rounded-2xl">
            <div class="flex justify-center">
                {{-- logo here --}}
            </div>
            <h3 class="text-2xl font-bold text-center">Create new account</h3>
            <form method="POST" action="">
                @csrf
                @if (Session::get('error'))
                    <div class="mt-4 flex justify-center bg-red-500 border rounded-md border-red-500">
                        <span class="text-base tracking-wide text-white">{{ Session::get('error') }}</span>
                    </div>
                @endif

                <div class="mt-4">
                    <label class="block" for="name">Full name<label>
                            <input type="text" name="name" placeholder="Full name"
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                required>
                            <span
                                class="text-xs tracking-wide text-red-600">@error('name'){{ $message }}@enderror</span>
                    </div>
                    <div class="mt-4">
                        <label class="block" for="email">Email<label>
                                <input type="email" name="email" placeholder="Email"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                    required>
                                <span
                                    class="text-xs tracking-wide text-red-600">@error('email'){{ $message }}@enderror</span>
                        </div>

                        <div class="mt-4">
                            <label class="block" for="mobile_number">Phone number<label>
                                    <input type="text" name="mobile_number" placeholder="XXXXXXXX"
                                        class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                        required>
                                    <span
                                        class="text-xs tracking-wide text-red-600">@error('mobile_number'){{ $message }}@enderror</span>
                            </div>
                            <div class="mt-4">
                                <label class="block">Password<label>
                                        <input type="password" name="password" placeholder="Password"
                                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                            required>
                                        <span
                                            class="text-xs tracking-wide text-red-600">@error('password'){{ $message }}@enderror</span>
                                </div>

                                <div class="mt-4">
                                    <label class="block" for="password_confirmation">Confirm password<label>
                                            <input type="password" name="password_confirmation" placeholder="Password"
                                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                                required>
                                            <span
                                                class="text-xs tracking-wide text-red-600">@error('password_confirmation'){{ $message }}@enderror</span>
                                    </div>

                                    <div class="mt-4 flex justify-center">
                                        <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline w-full text-center">You
                                            have an account?
                                            Login</a>
                                    </div>

                                    <div class="flex items-baseline justify-end">
                                        <input type="submit" class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900"></input>
                                    </div>
                            </div>
                            </form>
                        </div>
                        </div>

                    @endsection
