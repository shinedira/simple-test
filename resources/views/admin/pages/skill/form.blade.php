{!! Form::model($model, [
    'route' => !$model->exists ?
    ['admin.skill.store'] :
    ['admin.skill.update', $model],
    'method' => !$model->exists ? 'POST' : 'PATCH',
    'id' => 'form-modal'
]) !!}

<div class="form-group">
    {!! Form::label('name', 'Name'); !!} <small class="text-danger">*</small>
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description'); !!}
    {!! Form::textarea('description', null, [
        'class' => 'form-control',
        'id' => 'description',
        'style' => 'height: 233px !important',
    ]) !!}
</div>
{!! Form::close() !!}