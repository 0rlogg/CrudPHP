
<h1>{{$modo}} jugador</h1>

<!--Si hay errores a la hora de validar el formulario se mostraran como mensajes para que el usuario lo cambie-->

@if(count($errors)>0)

    <div class="alert alert-danger" role="alert">
        <ul>
        @foreach($errors->all() as $error)
                <li>{{$error}}</li>
        @endforeach
        </ul>
    </div>

@endif

<div class="form-group">
<label for="">Nombre</label>
<input type="text" name="nombre" id="nombre" class="form-control"
       value="{{isset($jugador->nombre)?$jugador->nombre:old('nombre')}}">
<br>
</div>

<div class="form-group">
<label for="">Apellido</label>
<input type="text" name="apellido" id="apellido" class="form-control"
       value="{{isset($jugador->apellido)?$jugador->apellido:old('apellido')}}">
<br>
</div>

<div class="form-group">
<label for="">email</label>
<input type="text" name="email" id="email" class="form-control"
       value="{{isset($jugador->email)?$jugador->email:old('email')}}">
<br>
</div>

<div class="form-group">
<label for="">alias</label>
<input type="text" name="alias" id="alias" class="form-control"
       value="{{isset($jugador->alias)?$jugador->alias:old('alias')}}">
<br>
</div>

<div class="form-group">
<label for="">foto de perfil</label>
<br>

@if(isset($jugador -> foto))
<img src="{{asset('storage'.'/'.$jugador -> foto)}}"
     class="img-thumbnail img-fluid" alt="foto de perfil de {{$jugador -> nombre}}" width="100px" height="100px">
@endif

<input type="file" class="form-control" name="foto" id="foto">
<br>
</div>


<input type="submit"  value="{{$modo}} datos" class="btn btn-success">
<a href="{{url('Jugador/')}}" class="btn btn-primary">Volver</a>
<br>
