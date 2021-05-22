# HELP requests number of requests per ingredient
# TYPE requests counter
@php($i = 0)
@foreach ($keyingr as $k)
requests_cooking_site{ingredient="{{ $k }}"} {{ $valuesingr[$i] }}
@php($i += 1)
@endforeach
# HELP visits number of requests per endpoint
# TYPE visits counter
@php($i = 0)
@foreach ($keyreq as $k)
visits_cooking_site{endpoint="{{ $k }}"} {{ $valuesreq[$i] }}
@php($i += 1)
@endforeach