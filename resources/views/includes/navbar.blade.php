    <!-- container -->
    <div class="flex flex-col items-center bg-gray-50 text-gray-700 shadow h-full">
        <!-- Side Nav Bar-->
        <div class="h-16 flex items-center w-full">
            <!-- Logo Section -->
            <a class="h-10 w-12 mx-auto" href="{{ route('home') }}">
                <img src="{{ asset("img/Untitled_Artwork.png") }}" class="w-full h-full" alt="">
            </a>
        </div>

        <ul>
            <!-- Items Section -->
            <li class="hover:bg-blue-100">
                <a href="." class="h-16 px-6 flex justify-center items-center w-full">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                        <path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0
       2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0
       0-1.79 1.11z"></path>
                    </svg>

                </a>
            </li>

            <li class="hover:bg-blue-100">
                <a href="{{route('profile')}}" class="h-16 px-6 flex  justify-center items-center w-full">
                    {{-- <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg> --}}

                    <svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" viewBox="0 0 512 512"><title>Person Circle</title><path d="M258.9 48C141.92 46.42 46.42 141.92 48 258.9c1.56 112.19 92.91 203.54 205.1 205.1 117 1.6 212.48-93.9 210.88-210.88C462.44 140.91 371.09 49.56 258.9 48zm126.42 327.25a4 4 0 01-6.14-.32 124.27 124.27 0 00-32.35-29.59C321.37 329 289.11 320 256 320s-65.37 9-90.83 25.34a124.24 124.24 0 00-32.35 29.58 4 4 0 01-6.14.32A175.32 175.32 0 0180 259c-1.63-97.31 78.22-178.76 175.57-179S432 158.81 432 256a175.32 175.32 0 01-46.68 119.25z"/><path d="M256 144c-19.72 0-37.55 7.39-50.22 20.82s-19 32-17.57 51.93C191.11 256 221.52 288 256 288s64.83-32 67.79-71.24c1.48-19.74-4.8-38.14-17.68-51.82C293.39 151.44 275.59 144 256 144z"/></svg>


                </a>
            </li>

            <li class="hover:bg-blue-100">
                <a href="." class="h-16 px-6 flex  justify-center items-center w-full">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1
       0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0
       0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2
       2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0
       0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1
       0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0
       0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65
       0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0
       1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0
       1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2
       0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0
       1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0
       2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0
       0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65
       1.65 0 0 0-1.51 1z"></path>
                    </svg>
                </a>
            </li>
        </ul>

        <div class="mt-auto h-16 flex items-center w-full">
            <!-- Action Section -->
            <a href="{{ route('logout') }}"
                class="h-16 mx-auto flex justify-center items-center w-full focus:text-orange-500 hover:bg-red-200 focus:outline-none">
                <svg class="h-5 w-5 text-red-700" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
            </a>

        </div>
    </div>
