@extends('layouts.app')
@section('content')

    @include('includes.navbar')

    <div class="w-full h-full flex justify-center items-center ">
        <div class="flex flex-col items-center bg-gray-400 w-1/3 h-3/5 border rounded-lg shadow-md">
            <div class="my-4 flex justify-center items-center flex-col">
                <img id="preview_img" src="http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png"
                class="boder rounded-full" style="overflow: auto; max-width: 44%; max-height: 64%;"/>
                <input type="file" name="profile_image" id="profile_image" onchange="loadPreview(this);">
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
