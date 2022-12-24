@extends('layouts.app')

@section('template_title')
{{ $equipment->name ?? 'Show Equipment' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Ver Equipo</span>
                    </div>
                    <div class="float-right">
                        <form action="{{ route('equipment.destroy',$equipment->uuid) }}" method="POST">
                            <a class="btn  btn-secondary " href="{{ route('equipment.index') }}"><i class="fa fa-fw fa-eye"></i> Regresar</a>
                            @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                            <a class="btn  btn-success" href="{{ route('equipment.edit',$equipment->uuid) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <strong>Uuid:</strong>
                        {{ $equipment->uuid }}
                    </div>
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $equipment->name }}
                    </div>
                    <div class="form-group">
                        <strong>Categoría:</strong>
                        {{ $equipment->categoryEquipment->name??'' }}
                    </div>
                    <div class="form-group">
                        <strong>Cantidad:</strong>
                        {{ $equipment->quantity }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection