@extends('layouts.app')

@section('content')

<div class="flex">
    <div class="flex-grow-0"></div>
    <div class="flex-grow">
        <div class="m-10">
            <div class="">
                <div class="container mx-auto">
                    <img src="/images/{{ $recipee->imagepath }}" alt="" class="inset-0 w-full object-cover bg-gray-100 sm:rounded-lg"/>
                </div>
            </div>
        </div>  
        <div class="font-bold text-center">
            <p class="">
                {{ $recipee->name }}
            </p>
        </div>
        <div class="shadow-md rounded-lg p-5">
            <span class="font-bold">
                Ingredients: 
            </span>
            <br>
            <div class="mx-4">
                <ul class="list-disc">
                    @foreach ($recipee->ingredients as $ingredient)
                        <li>
                            <span>{{ $ingredient->amount }}</span> <span class="font-extralight">x</span> <span>{{ $ingredient->name }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <br>
        <hr>
        <br>
        <div class="">
            <span class="font-bold">
                Description: 
            </span>
            <br>
            <span class="">
                {{ $recipee->description }}
            </span>
        </div>
        <div class="my-5">
            <a class="h-10 my-5 p-3 text-red-100 transition-colors duration-150 bg-red-700 rounded-md focus:shadow-outline hover:bg-red-800" href="/recipees/edit/{{ $recipee->id }}">Edit</a>
            <form action="/recipees/delete/{{ $recipee->id }}" method="POST">
                @csrf
                <input type="submit" class="h-10 my-5 p-3 text-red-100 transition-colors duration-150 bg-red-700 rounded-md focus:shadow-outline hover:bg-red-800" value="Delete"/>
            </form>
        </div>
    </div>
    <div class="flex-grow-0"></div>
</div>

@endsection