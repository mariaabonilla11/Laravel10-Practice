<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

@include("fragment.subview")

    {{ $name }}
    {{-- $age --}}
    { !! $html !! }

    @if(true)
        es true
    @endif

    @foreach($array as $a)
        {{ $a }}
    @endforeach
    @forelse($array as $a)
        {{ $a }}
    @empty
        No hay data    
    @endforelse


    
</body>
</html>