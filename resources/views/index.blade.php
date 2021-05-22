@extends('layouts.app')

@section('content')

    <div class="divide-y divide-gray-100">
        <x-list>
            @foreach ($recipees as $recipee)
                <x-list-item :recipee="$recipee"/>
            @endforeach
        </x-list>
    </div>

@endsection