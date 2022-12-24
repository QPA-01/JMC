@extends('layouts.app')

@section('template_title')
Role
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header text-white" style="background-color: #FF8000;">
                    <div style="display: flex; justify-content: space-between; align-items: center;" style="background-color: #FF8000;">

                        <span id="card_title">
                            {{ __('Rol') }}
                        </span>

                        <div class="float-right">
                            @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                            <a href="{{ route('rol.create') }}" sryl class="btn btn-dark float-right text-white" style="background-color:  #800080 ;" data-placement="left">
                                {{ __('Crear rol') }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Uuid</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $role->uuid }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->description }}</td>
                                    <td>
                                        <form action="{{ route('rol.destroy',$role->uuid) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('rol.show',$role->uuid) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                            @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                                            <a class="btn btn-sm btn-success" href="{{ route('rol.edit',$role->uuid) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $roles->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
@endsection