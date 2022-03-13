@extends('layouts.app')

@section('content')
    <div class="container">

            @if(Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
            {{Session::get('mensaje')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            @endif



<a href="{{url('Jugador/create')}}" class="btn btn-success"> Registrar nuevo jugador</a>
    <br>
    <br>
<table class="table table-ligth">
    <thead class="thead-ligth">
        <tr>
            <th>#</th>
            <th>Foto de perfil</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>email</th>
            <th>Alias</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jugadores as $jugador)

            <tr>
                <td>{{$jugador -> id}}</td>
                <td><img class="img-thumbnail img-fluid" src="{{asset('storage'.'/'.$jugador -> foto)}}" alt="foto de perfil de {{$jugador -> nombre}}"
                width="100px" height="100px"></td>
                <td>{{$jugador -> nombre}}</td>
                <td>{{$jugador -> apellido}}</td>
                <td>{{$jugador -> email}}</td>
                <td>{{$jugador -> alias}}</td>
                <td>

                    <a href="{{url('/Jugador/'.$jugador->id.'/edit')}}" class="btn btn-primary">Editar</a>

                    <form action="{{url('/Jugador/'.$jugador->id)}}" class="d-inline" method="post">
                        @csrf
                        {{method_field('DELETE')}}
                        <input type="submit" onclick="return confirm('Quieres borrar?')" value="Borrar" class="btn btn-danger">

                    </form>


                </td>
            </tr>

        @endforeach
    </tbody>
</table>
{!! $jugadores->links() !!}
</div>
@endsection
