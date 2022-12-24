<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('Equipo') }}
            {!! Form::select('equipment_uuid', $equipaments, null,['class'=>'form-control', 'placeholder'=>'Seleccione opción ', 'required']); !!}
        </div>
    </div>
    <br>
    <div class="box-footer mt20">
        <a class="btn  btn-secondary " href="{{ route('loan_detail.index') }}"><i class="fa fa-fw fa-eye"></i> Regresar</a>

        <button type="submit" class="btn btn-primary">Siguiente</button>
    </div>
</div>