<!-- borderTest -->
@extends(' layouts.app')

@section('contenu')

<form method="POST" action="{{route('test3')}}">
    <input type="text" name="test2">
    <input type="submit">
</form>

@endsection
