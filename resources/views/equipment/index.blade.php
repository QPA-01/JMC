@extends('layouts.app')

@section('template_title')
Equipment
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header  text-white" style="background-color: #FF8000;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Equipos') }}
                        </span>

                        <div class="float-right">
                            @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                            <a href="{{ route('equipment.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Crear equipo') }}
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
                                    <th>Categoría</th>
                                    <th>Cantidad</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipments as $equipment)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $equipment->uuid }}</td>
                                    <td>{{ $equipment->name }}</td>
                                    <td>{{ $equipment->categoryEquipment->name ?? '' }}</td>
                                    <td>{{ $equipment->quantity }}</td>

                                    <td>
                                        <form action="{{ route('equipment.destroy',$equipment->uuid) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('equipment.show',$equipment->uuid) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                            @csrf
                                            @method('DELETE')
                                            @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                                            <a class="btn btn-sm btn-success" href="{{ route('equipment.edit',$equipment->uuid) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
            {!! $equipments->links() !!}
        </div>
    </div>
</div>
@endsection