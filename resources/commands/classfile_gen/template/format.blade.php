@extends('layouts.format')

{{-- strict --}}
@section('strictSyntax')
@if($isStrict === true)
declare(strict_types=1);

@endif
@endsection

{{-- use --}}
@section('useSyntax')

@foreach($useClasses as $useClass)
@if($useClass !== '')
use {{ $useClass }};
@if ($loop->last)

@endif
@endif
@endforeach
@endsection

{{-- trait --}}
@section('traitSyntax')
@if($traitClasses !== '')    use {{$traitClasses}};
@endif
@endsection