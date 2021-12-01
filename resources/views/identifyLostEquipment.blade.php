@extends('layouts.app')
@section('title', 'Lost equipment User')
@section('content')
    <style>
        @media (min-width:1024px) {
            .middle-box {
                margin-left: -3em;
            }

        }

    </style>
    <div class="flex flex-col w-full h-full">
        <div class="w-full h-16 flex justify-center items-center shadow-xl">
            <h1>Lost Equipment user details</h1>

        </div>
        <div class="flex flex-col w-full h-full justify-center items-center ">
            <div class="flex lg:flex-row xs:flex-col lg:w-2/3 lg:h-1/6 rounded-md xs:justify-center xs:items-center">
                {{-- left section --}}
                <div class=" lg:w-2/6 flex justify-center items-center">
                    @if(!empty($equipment->equipment_images[0]))
                    <img src="{{asset("storage/" .substr($equipment->equipment_images[0]->equipment_image_path, 7))}}" alt="..."
                    class="shadow-2xl rounded-full w-1/2 h-full mb-8 sm:mb-0 align-middle border-none" />
                    @else
                    <img src="{{asset('img/placeholder.png')  }}" alt="..."
                        class="shadow-2xl rounded-full w-1/2 h-full mb-8 sm:mb-0 align-middle border-none" />
                    @endif
                    
                </div>
                {{-- middle section --}}
                <div
                    class="flex flex-col middle-box h-40 w-3/4 mb-2 sm:w-auto justify-center items-center sm:items-start sm:justify-between bg-white text-left rounded-xl shadow-2xl lg:w-3/4 text-black">
                    <div class="mt-0 ml-0 mr-1 sm:mr-0 sm:mt-5 sm:ml-5 ">
                        <h1> Equipment name: {{ $equipment->equipment_name ?? 'not found' }}</h1>
                    </div>
                    <h1 class="sm:ml-5 bg-yellow-500 rounded-md p-1 text-white" > status: {{ $equipment->equipment_status->equipment_status_value ?? 'not found' }}</h1>
                    {{-- buttons here --}}
                    <div class="mt-4 ml-0 sm:mt-3 sm:ml-5">
                        <a
                            class="bg-blue-500 text-white active:bg-blue-600 sm:mb-10 font-bold text-sm px-6 py-3 rounded shadow hover:shadow-lg hover:bg-blue-700 outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            href="tel:{{ $user->mobile_number }}">
                            Contact
                        </a>
                    </div>
                    <div>

                    </div>
                </div>
                {{-- right section --}}
                <div
                    class="flex flex-col bg-white rounded-xl h-40 shadow-2xl xs:w-3/4 mt-4 sm:mt-0 lg:ml-4 lg:mb-2 justify-center items-center lg:w-1/4 ">
                    <a href="">Username: {{ $user->name }}</a>
                    <a href="">Email: {{ $user->email }}</a>
                    <a href="">phone Number: {{ $user->mobile_number }}</a>
                </div>
            </div>
        </div>
    </div>

@endsection
