@extends('layouts.app')
@section('title', 'Home page')

@section('content')
    @include('includes.navbar')

    <div class="flex flex-row w-screen my-6 mx-4">
        <div class="w-3/4 h-full flex align-content-center">
            {{-- left side div --}}
            <div class="ml-14 my-12 w-full">
                {{-- page indecator div --}}
                <div class="flex items-baseline justify-between mr-4">
                    <h1 class="text-2xl">Items dashboard</h1>
                    <a href="{{ route('add') }}" class="bg-blue-500 text-white hover:bg-blue-700 rounded-md w-48 py-2 text-center">Add new
                        Item</a>
                </div>
                {{-- start of component --}}
                @include('includes.table', ['data' => $data])
                {{-- end of component div --}}
            </div>
        </div>
        {{-- right side div --}}
        <div class="flex justify-center my-12 w-1/4">
            {{-- filter div --}}
            <div class="w-4/5 h-1/3">
                <div class="flex flex-col">
                    <div class="w-full flex flex-col justify-center mt-6 py-4 border bg-white shadow-lg rounded-lg">
                        <div class="my-4">
                            <h2 class="text-center">Filter</h2>
                        </div>
                        <div class="flex flex-row w-full px-10">
                            <form action="" class="w-full flex justify-center">
                                <input type="text"
                                    class="w-3/4 px-4 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white"
                                    placeholder="Search">
                                <input type="submit" class="w-1/3 py-1 bg-blue-500 ml-3 border rounded-md text-white"
                                    value="search">
                            </form>
                        </div>
                        <form method="GET" class="w-full">
                            <div class="px-10 mt-6">
                                <label for="status" class="ml-1">Order by</label>
                                <select name="status" id=""
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                                    <option value="asd">Ascending</option>
                                    <option value="dec">Descending</option>
                                </select>
                            </div>
                            <div class="px-10 mt-6">
                                <label for="status" class="ml-1">Item Status</label>
                                <select name="status" id=""
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                                    @foreach ($equipmentStatus as $status)
                                        
                                    @endforeach
                                    <option value="{{ $status->equipment_status_id ?? '' }}">{{ $status->equipment_status_value ?? '' }}</option>
                                </select>
                            </div>
                            <div class="mt-6 flex justify-center">
                                <input type="submit" class="w-1/3 py-2 bg-blue-500 ml-3 border rounded-md text-white"
                                    value="search">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end of filter div --}}
    </div>
    {{-- end of right side div --}}
@endsection
