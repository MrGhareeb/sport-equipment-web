<!-- Button trigger modal -->
<button
    class="
    bg-blue-500
    text-white
    active:bg-blue-600
    font-bold
    text-sm
    px-6
    py-3
    rounded
    shadow
    hover:shadow-lg
    hover:bg-blue-700
    outline-none
    focus:outline-none
    mr-1
    mb-1
    ease-linear
    transition-all
    duration-150
  "
    type="button" onclick="toggleModal('add-equipment')">
    Add new item
</button>
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
    id="add-equipment">
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
                <h3 class="text-3xl font-semibold">Add new Item</h3>
                <button
                    class="
            p-1
            ml-auto
            bg-transparent
            border-0
            text-gray-300
            float-right
            text-3xl
            leading-none
            font-semibold
            outline-none
            focus:outline-none
          "
                    onclick="toggleModal('add-equipment')">
                    <span
                        class="
              bg-transparent
              h-6
              w-6
              text-2xl
              block
              outline-none
              focus:outline-none
            ">
                        <i class="fas fa-times"></i>
                    </span>
                </button>
            </div>
            <!--body-->
            <div class="relative p-6 h-1/3 flex-auto flex-col w-96">
                <form id="addItem" method="post" action="/">
                    <div class="flex flex-col p-4 justify-center items-center">
                        <label for="itemName">Item name</label>
                        <input type="text" class="w-3/4 px-4 py-2 my-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white" name="itemName" id="">
                        <label for="ItemDesciption">Item desciption</label>
                        <input type="text" class="w-3/4 px-4 py-2 my-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white" name="ItemDesciption" id="">
                        <label for="ItemStatus">Item status</label>
                        <input type="text" class="w-3/4 px-4 py-2 my-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 bg-white" name="ItemStatus" id="">
                       {{-- upload image --}}
                        <div class="flex items-center justify-center bg-grey-lighter">
                            <label class="w-64 flex flex-col items-center mt-5 px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-green-500">
                                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                </svg>
                                <span class="mt-2 text-base leading-normal">Select a file</span>
                                <input type='file' class="hidden" />
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
                    type="button" onclick="toggleModal('add-equipment')">
                    Close
                </button>
                <input
                    class="
            bg-blue-500
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
<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="add-equipment-backdrop"></div>
<script type="text/javascript">
    function toggleModal(modalID) {
        document.getElementById(modalID).classList.toggle("hidden");
        document
            .getElementById(modalID + "-backdrop")
            .classList.toggle("hidden");
        document.getElementById(modalID).classList.toggle("flex");
        document.getElementById(modalID + "-backdrop").classList.toggle("flex");
    }
</script>
