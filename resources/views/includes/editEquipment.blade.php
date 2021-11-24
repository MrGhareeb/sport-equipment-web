@php($selectedEquipment = null)
@foreach ($data as $eq)
    @if ($eq->equipment_id == app('request')->input('id'))
        @php($selectedEquipment = $eq)
    @endif
@endforeach
<!-- Modal -->
<div class="
    hidden
    overflow-x-hidden overflow-y-auto
    fixed
    inset-0
    z-50
    outline-none
    focus:outline-none
    justify-center
    items-center
  "
    id="edit-equipment">
    <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div
            class="
        border-0
        rounded-lg
        shadow-lg
        relative
        flex flex-col
        w-full
        bg-white
        outline-none
        focus:outline-none
      ">
            <!--header-->
            <div
                class="
          flex
          items-start
          justify-between
          p-5
          border-b border-solid border-gray-200
          rounded-t
        ">
                <h3 class="text-3xl font-semibold text-center w-full">Add new Item</h3>
            </div>
            <!--body-->
            <div class="relative p-6 h-1/3 flex-auto flex-col w-96">
                <form id="addItem" method="post" action="{{ route('edit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col p-4 justify-center items-center">
                        {{-- itemName --}}
                        <label for="itemName">Item name</label>
                        <input type="text"
                            class="w-3/4 px-4 py-2 my-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white"
                            name="itemName" value="{{ $selectedEquipment->equipment_name ?? '' }}" id="">
                        {{-- ItemDescription --}}
                        <label for="ItemDescription">Item desciption</label>
                        <input type="text"
                            class="w-3/4 px-4 py-2 my-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white"
                            name="ItemDescription" value="{{ $selectedEquipment->equipment_description ?? '' }}"
                            id="">
                        {{-- status --}}
                        <label for="status">Item status</label>
                        <select name="status" id=""
                            class="w-3/4 px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white">
                            @foreach ($equipmentStatus as $status)
                                @isset($selectedEquipment)
                                    @if ($selectedEquipment->equipment_status_id == $status->equipment_status_id)
                                        <option selected value="{{ $status->equipment_status_id ?? '' }}">
                                            {{ $status->equipment_status_value ?? '' }}</option>
                                    @else
                                        <option value="{{ $status->equipment_status_id ?? '' }}">
                                            {{ $status->equipment_status_value ?? '' }}</option>
                                    @endif
                                @endisset
                            @endforeach
                        </select>
                        {{--  --}}
                        <label for="equipmentType" class="mt-2"> Equipment type </label>
                        <select name="equipmentType"
                            class="w-3/4 px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white"
                            id="">
                            @foreach ($equipmentType as $type)
                                @isset($selectedEquipment)
                                    @if ($selectedEquipment->equipment_type_id == $type->equipment_type_id)
                                        <option selected value="{{ $type->equipment_type_id ?? '' }}">
                                            {{ $type->equipment_type_value ?? '' }}</option>
                                    @else
                                        <option value="{{ $type->equipment_type_id ?? '' }}">
                                            {{ $type->equipment_type_value ?? '' }}</option>
                                    @endif
                                @endisset
                            @endforeach
                        </select>

                        {{-- <input type="text"
                            class="w-3/4 px-4 py-2 my-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white"
                            name="ItemStatus" id=""> --}}
                        {{-- upload image --}}
                        <div class="flex items-center justify-center bg-grey-lighter">
                            <label
                                class="w-64 flex flex-col items-center mt-5 px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-blue-500">
                                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                </svg>
                                <span class="mt-2 text-base leading-normal">Select a file</span>
                                <input type='file' name="images[]" multiple class="hidden" />
                            </label>
                        </div>
                        {{--  --}}
                    </div>
                </form>
            </div>
            <!--footer-->
            <div
                class="
          flex
          items-center
          justify-end
          p-6
          border-t border-solid border-gray-200
          rounded-b
        ">
                <button
                    class="
            text-blue-500
            hover:text-red-700
            background-transparent
            font-bold
            uppercase
            px-6
            py-2
            text-sm
            outline-none
            focus:outline-none
            mr-1
            mb-1
            ease-linear
            transition-all
            duration-150
          "
                    type="button" onclick="toggleModal('edit-equipment',null)">
                    Close
                </button>
                <input
                    class="
            bg-blue-500
            hover:bg-blue-700
            text-white
            active:bg-blue-600
            font-bold
            text-xs
            px-4
            py-2
            rounded
            shadow
            hover:shadow-md
            outline-none
            focus:outline-none
            mr-1
            mb-1
            cursor-pointer
            ease-linear
            transition-all
            duration-150
          "
                    type="submit" form="addItem" value=" Save item">

                </input>
                {{-- onclick="toggleModal('add-equipment')" --}}
            </div>
        </div>
    </div>
</div>
<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="edit-equipment-backdrop"></div>
<script type="text/javascript">
    function toggleModal(modalID, clickedButton) {
        $id = document.getElementById("edit-equipment-button");
        if (clickedButton != null) {
            $id = clickedButton;
        }
        document.getElementById(modalID).classList.toggle("hidden");
        document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
        document.getElementById(modalID).classList.toggle("flex");
        document.getElementById(modalID + "-backdrop").classList.toggle("flex");
    }
</script>
