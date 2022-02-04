@extends('layouts.admin')

@section('title', 'Candidate')

@section('css')
<link rel="stylesheet" href="{{ asset('stisla/modules/select2/dist/css/select2.min.css') }}">
@endsection

@section('js')
<script src="{{ asset('stisla/modules/select2/dist/js/select2.min.js') }}"></script>

<script>
    $(function() {
        $(".select2").select2();
    })
</script>
@endsection

@section('content')

<x-content>
    <x-slot name="modul">
        <h1>Candidate</h1>
    </x-slot>

    <x-section>
        <x-slot name="title">
        </x-slot>
        
        <x-slot name="header">
            <h4>Data Candidates</h4>
            <div class="card-header-form row">
                <div>
                    <form>
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control" placeholder="{{ __('page.search') }}"
                                value="{{ Request::input('search') ?? ''}}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="ml-2 pr-3">
                    @role('senior-hrd')
                        <a href="{{ route('admin.candidate.create') }}"
                        role="button"
                        class="btn btn-sm btn-primary">
                            {{ __('page.add-btn') }} <i class="fas fa-plus"></i>
                        </a>
                    @endrole
                </div>
            </div>
        </x-slot>

        <x-slot name="body">
            <div class="table-responsive">
                <table class="table table-bordered  table-md">
                    <thead>
                        <tr>
                            <th style="width: 50px">#</th>
                            <th>Name</th>
                            <th>Birth Date</th>
                            <th>Applied Position</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th style="width:150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($candidates as $candidate)
                        <tr>
                            <td>{{ $loop->index + $candidates->firstItem() }}</td>
                            <td>{{ $candidate->name }}</td>
                            <td>{{ $candidate->birth_date_format }}</td>
                            <td>{{ $candidate->applied_position }}</td>
                            <td>{{ $candidate->email }}</td>
                            <td>{{ $candidate->phone }}</td>
                            <td>
                                <x-action-btn
                                :actions="[
                                    'edit' => [ 
                                        'isShow' => auth()->user()->hasRole('senior-hrd'),
                                        'route' => route('admin.candidate.edit', $candidate)
                                    ],
                                    'detail' => [
                                        'prevent' => true,
                                        'model' => $candidate
                                    ],
                                    'delete' => [
                                        'route' => route('admin.candidate.destroy', $candidate),
                                    ]
                                ]"
                                ></x-action-btn>
                            </td>
                        </tr>
                        @empty
                            <x-tr-no-record colspan="7"></x-tr-no-record>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-slot>

        <x-slot name="footer">
            {{ $candidates->onEachSide(2)->appends($_GET)->links('admin.partials.pagination') }}
        </x-slot>
    </x-section>
</x-content>

<detail-candidate-component></detail-candidate-component>
@include('admin.partials.modal')

@endsection