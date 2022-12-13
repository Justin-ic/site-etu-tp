<!-- borderTest -->
@extends(' layouts.app')

@section('contenu')

<form method="POST" action="{{route('test2')}}">
    <input type="text" name="test1">
    <input type="submit">
</form>

@endsection
