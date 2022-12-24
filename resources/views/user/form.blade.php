<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Correo') }}
            {{ Form::email('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Correo']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Rol') }}
            {{ Form::select('rol_id',$rols ,$user->rol_id, ['class' => 'form-control' . ($errors->has('rol_id') ? ' is-invalid' : ''), 'placeholder' => 'Elija rol']) }}
            {!! $errors->first('rol_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Tipo de documento') }}
            {{ Form::select('document_type_id',$documents_types, $user->document_type_id, ['class' => 'form-control' . ($errors->has('document_type_id') ? ' is-invalid' : ''), 'placeholder' => 'Tipo de documento']) }}
            {!! $errors->first('document_type_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Número de documento') }}
            {{ Form::number('document_number', $user->document_number, ['class' => 'form-control' . ($errors->has('document_number') ? ' is-invalid' : ''), 'placeholder' => 'Número de documento']) }}
            {!! $errors->first('document_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Teléfono') }}
            {{ Form::number('phone', $user->phone, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : ''), 'placeholder' => 'Teléfono']) }}
            {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Fecha de nacimiento') }}
            {{ Form::date('date_birth', $user->date_birth, ['class' => 'form-control' . ($errors->has('date_birth') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de nacimiento', 'max'=>date('Y-m-d')]) }}
            {!! $errors->first('date_birth', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Dirección') }}
            {{ Form::text('address', $user->address, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''), 'placeholder' => 'Dirección']) }}
            {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <br>

    <div class="box-footer mt20">
        <a class="btn btn-secondary" href="{{ route('user.index') }}"> Regresar</a>
        @if ( Route::currentRouteName() =='user.create' || !empty($user->name))
        <button type="submit" class="btn btn-primary">Enviar</button>
        @else
        <button type="submit" class="btn btn-primary" disabled>Enviar</button>
        @endif
    </div>

</div>