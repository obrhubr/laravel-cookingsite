@extends('layouts.app')

@section('content')

    <div class="divide-y divide-gray-100">
        @if(count($recipees) > 0)
            <x-list>
                @foreach ($recipees as $recipee)
                    <x-list-item :recipee="$recipee"/>
                @endforeach
            </x-list>
        @endif
    </div>

@endsection