@if(!empty(app('request')->input('id')))
    <script>
        toggleModal('edit-equipment',null);
    </script>
@endif

<div class="min-full mt-6">
    <table class="w-full">
        <thead>
            <tr>
                <th class=" text-xs font-semibold text-gray-600">
                    Image
                </th>
                <th class="p-2 text-xs font-semibold text-gray-600">
                    Name
                </th>
                <th class="p-2 text-xs font-semibold text-gray-600">
                    Description
                </th>
                <th class="p-2 text-xs font-semibold text-gray-600">
                    Status
                </th>
                <th class="p-2 text-xs font-semibold text-gray-600">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr class="bg-white shadow-md">
                    <td class="w-1/12 p-4">
                        <div class="flex flex-row items-center justify-center">
                            @foreach ($item->equipment_images as $image)
                            <img class="w-20 max-h-14" src="{{ asset("storage/" .substr($image->equipment_image_path, 7) ) }}" alt=""> 
                            @endforeach
                            @if (count($item->equipment_images) == 0)
                                <img class="w-20 max-h-14" src="{{ asset("img/placeholder.png") }}" alt="">
                            @endif
                        </div>
                    </td>

                    <td class="text-center p-4 w-1/6">
                        <p class="">{{ $item->equipment_name }}</p>
                    </td>
                    <td class="text-center p-4">
                        <p>{{ $item->equipment_description }}</p>
                    </td>
                    <td class="text-center p-4">
                        <p>{{ $item->equipment_status->equipment_status_value }}</p>
                    </td>
                    <td class="text-center p-4 w-1/3">
                        <div class="flex flex-row justify-center items-center">
                            {{-- edit button --}}
                            <div
                                class=" hover:bg-blue-300 hover:border-blue-300 rounded p-1">
                                <a href="{{request()->fullUrlWithQuery(["id"=> $item->equipment_id ])}}" value="{{ $item->equipment_id }}" class="h-8 flex justify-center items-center w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-1 ml-1"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="M384 224v184a40 40 0 01-40 40H104a40 40 0 01-40-40V168a40 40 0 0140-40h167.48"
                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="32" />
                                        <path
                                            d="M459.94 53.25a16.06 16.06 0 00-23.22-.56L424.35 65a8 8 0 000 11.31l11.34 11.32a8 8 0 0011.34 0l12.06-12c6.1-6.09 6.67-16.01.85-22.38zM399.34 90L218.82 270.2a9 9 0 00-2.31 3.93L208.16 299a3.91 3.91 0 004.86 4.86l24.85-8.35a9 9 0 003.93-2.31L422 112.66a9 9 0 000-12.66l-9.95-10a9 9 0 00-12.71 0z" />
                                    </svg>
                                </a>
                            </div>
                            {{-- QR-code button --}}
                            <div
                                class="hover:bg-green-300 hover:border-green-300 px-2 rounded p-1 mx-2">
                                <a href="{{route('qrcode',$item->equipment_id)}}" download="qr-code.png" class="h-8 flex justify-center items-center w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8"
                                        viewBox="0 0 512 512">
                                        <rect x="336" y="336" width="80" height="80" rx="8" ry="8" />
                                        <rect x="272" y="272" width="64" height="64" rx="8" ry="8" />
                                        <rect x="416" y="416" width="64" height="64" rx="8" ry="8" />
                                        <rect x="432" y="272" width="48" height="48" rx="8" ry="8" />
                                        <rect x="272" y="432" width="48" height="48" rx="8" ry="8" />
                                        <rect x="336" y="96" width="80" height="80" rx="8" ry="8" />
                                        <rect x="288" y="48" width="176" height="176" rx="16" ry="16" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="32" />
                                        <rect x="96" y="96" width="80" height="80" rx="8" ry="8" />
                                        <rect x="48" y="48" width="176" height="176" rx="16" ry="16" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="32" />
                                        <rect x="96" y="336" width="80" height="80" rx="8" ry="8" />
                                        <rect x="48" y="288" width="176" height="176" rx="16" ry="16" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="32" />
                                    </svg>
                                    
                                </a>
                            </div>
                            {{-- delete button --}}
                            <div
                                class="hover:bg-red-300 hover:border-red-300 hover:text-white rounded p-1 ">
                                <a href="{{ route('delete', $item->equipment_id)}}" class="h-8 flex justify-center items-center w-full">
                                    <svg  class="h-8 w-8" viewBox="0 0 20 20">
                                        <path
                                            d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306">
                                        </path>
                                    </svg>
                                    
                                </a>
                            </div>
                        </div>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
</div>
