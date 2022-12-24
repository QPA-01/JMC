@extends('layouts.app')

@section('template_title')
{{ $user->name ?? 'Show User' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Ver Usuario</span>
                    </div>
                    <br>
                    <div class="float-right">

                        <form action="{{ route('user.destroy',$user->uuid) }}" method="POST">
                            @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                            <a class="btn btn-primary" href="{{ route('user.index') }}"> Regresar</a>
                            @else
                            <a class="btn btn-primary" href="{{ route('home') }}"> Regresar</a>
                            @endif @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])

                            @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'] && Auth::user()->uuid != $user->uuid)
                            <a class="btn  btn-success" href="{{ route('user.edit',$user->uuid) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                            @endif
                            @endif
                        </form>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $user->name }}
                    </div>
                    <div class="form-group">
                        <strong>Correo:</strong>
                        {{ $user->email }}
                    </div>
                    <div class="form-group">
                        <strong>Rol:</strong>
                        {{ $user->role->name??'' }}
                    </div>
                    <div class="form-group">
                        <strong>Tipo de documento:</strong>
                        {{ $user->documentType->abbreviation??'' }}
                    </div>
                    <div class="form-group">
                        <strong>Número de documento:</strong>
                        {{ $user->document_number }}
                    </div>
                    <div class="form-group">
                        <strong>Telefono:</strong>
                        {{ $user->phone }}
                    </div>
                    <div class="form-group">
                        <strong>Edad:</strong>
                        {{ $user->age }}
                    </div>
                    <div class="form-group">
                        <strong>Fecha de nacimiento:</strong>
                        {{ $user->date_birth }}
                    </div>
                    <div class="form-group">
                        <strong>Dirección:</strong>
                        {{ $user->address }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection