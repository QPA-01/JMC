@extends('layouts.app')

@section('template_title')
{{ $documentType->name ?? 'Show Document Type' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Ver Tipo de documento</span>
                    </div>
                    <br>
                    <div class="float-right">
                        <form action="{{ route('document_type.destroy',$documentType->uuid) }}" method="POST">
                            <a class="btn  btn-secondary " href="{{ route('document_type.index') }}"><i class="fa fa-fw fa-eye"></i> Regresar</a>
                            @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                            <a class="btn  btn-success" href="{{ route('document_type.edit',$documentType->uuid) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                        {{ $documentType->uuid }}
                    </div>
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $documentType->name }}
                    </div>
                    <div class="form-group">
                        <strong>Abreviatura:</strong>
                        {{ $documentType->abbreviation }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection