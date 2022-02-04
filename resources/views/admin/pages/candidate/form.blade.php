@extends('layouts.admin')
@section('title')
    <x-create-edit :model="$model"></x-create-edit>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('stisla/modules/select2/dist/css/select2.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('stisla/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('stisla/modules/cleave-js/dist/cleave.min.js') }}"></script>


<script>
    $(function() {
        $(".select2").select2();

        new Cleave('.datemask', {
            date: true,
            datePattern: ['Y', 'm', 'd']
        });
    })
</script>
@endpush

@section('content')
<section class="section" id="app">
    <div class="section-header">
        <h1>Curriculum</h1>
    </div>

    <x-form>
        <x-slot name="header">
            <h4>
                <x-create-edit :model="$model" :name="ucwords($model->name)"></x-create-edit>
            </h4>
        </x-slot>

        {!! Form::model($model, [
            'route' => !$model->exists ?
            ['admin.candidate.store'] :
            ['admin.candidate.update', $model],
            'method' => !$model->exists ? 'POST' : 'PATCH',
            'files' => true,
            'id' => 'form-modal'
        ]) !!}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('name', 'Name'); !!} <small class="text-danger">*</small>
                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email'); !!} <small class="text-danger">*</small>
                    {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('phone', 'Phone Number'); !!} <small class="text-danger">*</small>
                    {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('birth_date', 'Birth Date'); !!} <small class="text-danger">*</small>
                    {!! Form::text('birth_date', null, ['class' => 'form-control datemask', 'id' => 'birth_date', 'placeholder' => 'YYYY/MM/DD']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('education', 'Education'); !!}
                    {!! Form::text('education', null, ['class' => 'form-control', 'id' => 'education']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('last_position', 'Last Position'); !!}
                    {!! Form::text('last_position', null, ['class' => 'form-control', 'id' => 'last_position']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('experience', 'Experience'); !!}
                    {!! Form::text('experience', null, ['class' => 'form-control', 'id' => 'experience']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('applied_position', 'Applied Position'); !!} <small class="text-danger">*</small>
                    {!! Form::text('applied_position', null, ['class' => 'form-control', 'id' => 'applied_position']) !!}
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Skills</label>
            {!! Form::select('skills[]', $skills->toArray(), null, ['class' => 'form-control select2', 'id' => 'skill', 'multiple' => true]) !!}
            <small class="text-info">*You can add this from skill menu</small>
        </div>
        <div class="form-group">
            <label>Upload File</label>
            @if ($model->exists)
                <small class="text-info">*You can ignore this if file already uploaded.</small>
            @endif
            <file-upload></file-upload>
        </div>

        <div class="card-footer text-right">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </x-form>
</section>
@endsection

