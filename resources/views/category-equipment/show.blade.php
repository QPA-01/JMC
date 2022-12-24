@extends('layouts.app')

@section('template_title')
{{ $categoryEquipment->name ?? 'Show Category Equipment' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Ver categoría de Equipo</span>
                    </div>
                    <br>
                    <div class="float-right">
                        <form action="{{ route('category_equipment.destroy',$categoryEquipment->uuid) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('category_equipment.index') }}"> Regresar</a>
                            @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                            <a class="btn  btn-success" href="{{ route('category_equipment.edit',$categoryEquipment->uuid) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                        {{ $categoryEquipment->uuid }}
                    </div>
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $categoryEquipment->name }}
                    </div>
                    <div class="form-group">
                        <strong>Descripción:</strong>
                        {{ $categoryEquipment->description }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection