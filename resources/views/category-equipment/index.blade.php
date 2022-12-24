@extends('layouts.app')

@section('template_title')
Category Equipment
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header  text-white" style="background-color: #FF8000;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Categoría de equipo') }}
                        </span>

                        <div class="float-right">
                            @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                            <a href="{{ route('category_equipment.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Crear') }}
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
                                    <th>Descripción</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categoryEquipments as $categoryEquipment)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $categoryEquipment->uuid }}</td>
                                    <td>{{ $categoryEquipment->name }}</td>
                                    <td>{{ $categoryEquipment->description }}</td>

                                    <td>
                                        <form action="{{ route('category_equipment.destroy',$categoryEquipment->uuid) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('category_equipment.show',$categoryEquipment->uuid) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                            @csrf
                                            @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                                            <a class="btn btn-sm btn-success" href="{{ route('category_equipment.edit',$categoryEquipment->uuid) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
            {!! $categoryEquipments->links() !!}
        </div>
    </div>
</div>
@endsection