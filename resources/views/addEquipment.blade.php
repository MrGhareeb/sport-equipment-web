@extends('layouts.app')
@section('content')

    @include('includes.navbar')

    <div class="w-full h-full flex justify-center items-center ">
        <div class="flex flex-col items-center bg-gray-400 w-2/3 h-4/6 border rounded-lg shadow-md">
            <div class="my-4 flex justify-center items-center flex-col">
                {{-- image preview --}}
                <img id="preview_img" src="{{ asset('img/placeholder.png') }}"
                    class="object-cover w-36 h-36 mr-2 rounded-lg"
                    style="overflow: auto; max-width: 9rem; max-height: 9rem" />
                {{-- input filed to upload the images --}}
                {{-- <input type="file" name="profile_image" id="profile_image" onchange="loadPreview(this);"> --}}
                <label
                    class="
                  w-40
                  mt-4
                  mr-2
                  flex flex-col
                  items-center
                  bg-white
                  p-3
                  rounded-md
                  shadow-md
                  tracking-wide
                  border border-blue
                  cursor-pointer
                  hover:bg-purple-600 hover:text-white
                  text-purple-600
                  ease-linear
                  transition-all
                  duration-150
                ">
                    {{-- <i class="fas fa-cloud-upload-alt fa-3x"></i> --}}
                    <span class="text-center">Select a images</span>
                    <input type="file" name="images[]" class="hidden" multiple onchange="loadPreview(this);"/>
                </label>
                {{--  --}}
            </div>
        </div>
    </div>
    <script>
        function loadPreview(input, id) {
            id = id || '#preview_img';
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(id)
                        .attr('src', e.target.result)
                        .width(200)
                        .height(150);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
