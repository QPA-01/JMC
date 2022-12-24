<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('Equipo') }}
            {!! Form::hidden('equipment_uuid', $equipment_uuid) !!}
            {{ Form::text('equipment_name', $equipment_name, ['class' => 'form-control' . ($errors->has('equipment_name') ? ' is-invalid' : ''), 'placeholder' => 'Equipament Id','disabled']) }}
        </div>
        <div class="form-group">
            {{ Form::label('Descripción') }}
            {{ Form::text('description', $loanDetail->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Cantidad') }}
            {{ Form::number('quantity', $loanDetail->quantity, ['class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad', 'min'=>0, 'max' =>$quantity]) }}
            {!! $errors->first('quantity', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <br>
    <div class="box-footer mt20">
        <a class="btn  btn-secondary " href="{{ route('loan_detail.index') }}"><i class="fa fa-fw fa-eye"></i> Regresar</a>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>