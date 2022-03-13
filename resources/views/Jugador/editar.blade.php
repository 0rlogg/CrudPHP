@extends('layouts.app')

@section('content')
    <div class="container">

<form action="{{url('/Jugador/'.$jugador->id)}}" method="post" enctype="multipart/form-data">
    @csrf
   {{method_field('PATCH')}}
    @include('Jugador.formulario',['modo'=>'Editar'])

</form>
    </div>
@endsection
