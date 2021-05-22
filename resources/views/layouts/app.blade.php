<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Cooking site</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>

    <body>
        <div class="bg-gray-800 shadow-xl h-16 z-50 mb-10" id="make-space">
            <nav class="flex flex-wrap items-center justify-between p-5 bg-gray-800">    
                <a href="/"><img src="/images/logo.svg" alt="ACME" width="60" /></a>
                <div class="flex md:hidden">
                    <button id="hamburger">
                        <img class="toggle block" src="https://img.icons8.com/fluent-systems-regular/2x/menu-squared-2.png" width="40" height="40" />
                        <img class="toggle hidden" src="https://img.icons8.com/fluent-systems-regular/2x/close-window.png" width="40" height="40" />
                    </button>
                </div>
                <div class="toggle hidden md:flex w-full md:w-auto text-right text-bold mt-5 md:mt-0 border-t-2 border-blue-900 md:border-none">     
                </div>
                <a href="/recipees/add" class="toggle hidden md:flex w-full md:w-auto px-4 py-2 text-right bg-blue-900 hover:bg-blue-500 text-white md:rounded">Add your own recipee</a>
                <script>
                    document.getElementById("hamburger").onclick = function toggleMenu() {
                        const navToggle = document.getElementsByClassName("toggle");
                        const makeSpace = document.getElementById("make-space");
                        for (let i = 0; i < navToggle.length; i++) {
                            navToggle.item(i).classList.toggle("hidden");
                        }
                        makeSpace.classList.toggle("mb-32");
                    };
                </script>
                {{-- <div class="max-w-7xl mx-auto">
                    <div class="relative flex items-center justify-between h-16 flex-wrap flex-row md:mx-4">
                        <div class="absolute md:relative top-16 left-0 md:top-0 z-20 flex flex-col md:flex-row shadow-xl md:space-x-6 font-semibold w-screen bg-gray-800 px-5">
                            <div class="">
                                <div class="flex-shrink-0 flex items-center px-5">
                                    <img class="block h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">
                                    <span class="mx-5 text-white">Cooking Site</span>
                                </div>
                                <div class="flex space-x-4">
                                    
                                    <form action="/" method="GET" role="search">
                                        <div class="pt-2 relative mx-auto text-gray-600">
                                            <input class="border-2 min-w-full border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                                            type="search" name="term" placeholder="Search">
                                            <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
                                                <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                                    viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                                                    width="512px" height="512px">
                                                    <path
                                                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </form>

                                <a href="/recipees/add" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Add Recipee</a>
                            </div>
                    </div>
                </div> --}}
            </nav>
        </div>
        <div class="flex">
            <div class="flex-auto"></div>
            <div class="flex-auto z-0"> @yield('content') </div>
            <div class="flex-auto"></div> 
        </div>
    </body>
</html>