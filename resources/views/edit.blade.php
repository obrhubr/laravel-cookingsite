@extends('layouts.app')

@section('content')

    <div class="flex flex-col mb-4">

        <div class="my-1"></div>

        <div class="font-bold text-xl">
            Edit Recipee
        </div>

        <div class="my-1"></div>

        @include('common.errors')
        <form method="POST" href="/recipees/edit{{ $recipee->id }}" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-col mb-4">
                <input value="{{ $recipee->name }}" placeholder="Name..." class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-full" id="name" name="name">
                <div class="my-1"></div>
                <input value="{{ $recipee->description }}" placeholder="Description..." class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-full" id="description" name="description">
            </div>

            <div class="text-center justify-center">
                <div class="overflow-hidden relative w-64 mt-4 mb-4 bg-blue-700 rounded-md focus:shadow-outline hover:bg-blue-800">
                    <input class="cursor-pointer absolute block opacity-0 pin-r pin-t" type="file" name="image" id="image">
                    <button type="button" class="bg-indigo hover:bg-indigo-dark text-white font-bold py-2 px-4 w-full inline-flex items-center">
                        <svg fill="#FFF" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0h24v24H0z" fill="none"/>
                            <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z"/>
                        </svg>
                        <span class="ml-2">Upload Image</span>
                    </button>
                </div>
            </div>
            
            @php($i = 0)
            @foreach ($recipee->ingredients as $ingredient)

                <div id="ingredient-container" class="flex flex-col mb-4">
                    <h3>Ingredient {{ $i+1 }}:</h3>
                    <div class="my-1"></div>
                    <p>
                        <select class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-full" id="ingredients[0][name]" name="ingredients[0][name]">
                            <option value="{{ $ingredient->name }}">{{ $ingredient->name }}</option>
                            <option value="Beef Patty">Beef Patty</option>
                            <option value="Chicken Patty">Chicken Patty</option>
                            <option value="Pork Patty">Pork Patty</option>
                            <option value="Vegan Patty">Vegan Patty</option>
                            <option value="Onion">Onion</option>
                            <option value="Onionrings">Onionrings</option>
                            <option value="Tomatoes">Tomatoes</option>
                            <option value="Cucumber">Cucumber</option>
                            <option value="Pickled Cucumber">Pickled Cucumber</option>
                            <option value="Jalapenos">Jalapenos</option>
                            <option value="Salad Leaf">Salad Leaf</option>
                            <option value="Garlic sauce">Garlic sauce</option>
                            <option value="Ketchup">Ketchup</option>
                            <option value="Mayo">Mayo</option>
                            <option value="Cloubsauce">Cloubsauce</option>
                            <option value="BBQ sauce">BBQ sauce</option>
                            <option value="Ranch dressing">Ranch dressing</option>
                        </select>
                    </p>
                    <div class="my-1"></div>
                    <p>
                        <input value="{{ $ingredient->amount }}" placeholder="Ingredient Amount (number)..." class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-full" onkeypress='validate(event)' id="ingredients[0][amount]" name="ingredients[0][amount]">
                    </p>
                </div>

            @php($i += 1)
            @endforeach

            
        </form>
        <script>
            let i = 1;
            document.getElementById('add-new-ingredient').onclick = function () {
                let template = `
                    <h3>Ingredient ${i+1}:</h3>
                    <div class="my-1"></div>
                    <p>
                        <select class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-full" id="ingredients[${i}][name]" name="ingredients[${i}][name]">
                            <option value="Beef Patty">Beef Patty</option>
                            <option value="Chicken Patty">Chicken Patty</option>
                            <option value="Pork Patty">Pork Patty</option>
                            <option value="Vegan Patty">Vegan Patty</option>
                            <option value="Vegan Bun">Vegan Bun</option>
                            <option value="Bun">Bun</option>
                            <option value="Onion">Onion</option>
                            <option value="Onionrings">Onionrings</option>
                            <option value="Tomatoes">Tomatoes</option>
                            <option value="Cucumber">Cucumber</option>
                            <option value="Pickled Cucumber">Pickled Cucumber</option>
                            <option value="Jalapenos">Jalapenos</option>
                            <option value="Salad Leaf">Salad Leaf</option>
                            <option value="Garlic sauce">Garlic sauce</option>
                            <option value="Ketchup">Ketchup</option>
                            <option value="Mayo">Mayo</option>
                            <option value="Cloubsauce">Cloubsauce</option>
                            <option value="BBQ sauce">BBQ sauce</option>
                            <option value="Ranch dressing">Ranch dressing</option>
                        </select>
                    </p>
                    <div class="my-1"></div>
                    <p>
                        <label>Ingredient Amount</label><br>
                        <input placeholder="Ingredient Amount (number)..." class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-full" onkeypress='validate(event)' id="ingredients[${i}][amount]" name="ingredients[${i}][amount]">
                    </p>`;

                let container = document.getElementById('ingredient-container');
                let div = document.createElement('div');
                div.innerHTML = template;
                container.appendChild(div);

                i++;
            }
        </script>
        <script>
            function validate(evt) {
                var theEvent = evt || window.event;

                // Handle paste
                if (theEvent.type === 'paste') {
                    key = event.clipboardData.getData('text/plain');
                } else {
                // Handle key press
                    var key = theEvent.keyCode || theEvent.which;
                    key = String.fromCharCode(key);
                }
                var regex = /[0-9]|\./;
                if( !regex.test(key) ) {
                    theEvent.returnValue = false;
                    if(theEvent.preventDefault) theEvent.preventDefault();
                }
            }
        </script>
    </div>

@endsection