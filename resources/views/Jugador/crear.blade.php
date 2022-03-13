@extends('layouts.app')

@section('content')
    <div class="container">
<form action="{{url('/Jugador')}}" method="post" enctype="multipart/form-data">
@csrf
    @include('Jugador.formulario',['modo'=>'Crear'])

</form>
    </div>
@endsection
