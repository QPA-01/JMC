<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('name', $documentType->name??'', ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Abreviatura') }}
            {{ Form::text('abbreviation', $documentType->abbreviation??'', ['class' => 'form-control' . ($errors->has('abbreviation') ? ' is-invalid' : ''), 'placeholder' => 'Abreviatura']) }}
            {!! $errors->first('abbreviation', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
    </div>
    <div class="box-footer mt20">
        <a class="btn btn-secondary" href="{{ route('document_type.index') }}"> Regresar</a>
        @if ( Route::currentRouteName() =='role.document_type' || !empty($documentType->name))
        <button type="submit" class="btn btn-primary">Enviar</button>
        @else
        <button type="submit" class="btn btn-primary" disabled>Enviar</button>
        @endif
    </div>
</div>