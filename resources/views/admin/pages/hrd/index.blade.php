@extends('layouts.admin')

@section('title', 'Hrd')

@section('css')
@endsection

@section('js')
@endsection

@section('content')

<x-content>
    <x-slot name="modul">
        <h1>HRD</h1>
    </x-slot>

    <x-section>
        <x-slot name="title">
        </x-slot>
        
        <x-slot name="header">
            <h4>Data HRD</h4>
            <div class="card-header-form row">
                <div>
                    <form>
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control" placeholder="{{ __('page.search')  }}"
                                value="{{ Request::input('search') ?? ''}}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- <div class="ml-2">
                    <a href="{{ route('admin.curriculum.create') }}" class="btn btn-sm btn-primary">
                        {{ __('page.add-btn') }} <i class="fas fa-plus"></i>
                    </a>
                </div> --}}
            </div>
        </x-slot>

        <x-slot name="body">
            <div class="table-responsive">
                <table class="table table-bordered  table-md">
                    <thead>
                        <tr>
                            <th style="width: 50px">#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            {{-- <th style="width:150px">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($hrds as $hrd)
                        <tr>
                            <td>{{ $loop->index + $hrds->firstItem() }}</td>
                            <td>{{ $hrd->name }}</td>
                            <td>{{ $hrd->username }}</td>
                            <td>{{ $hrd->role }}</td>
                        </tr>
                        @empty
                        <x-tr-no-record colspan="4"></x-tr-no-record>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-slot>

        <x-slot name="footer">
            {{ $hrds->onEachSide(2)->appends($_GET)->links('admin.partials.pagination') }}
        </x-slot>
    </x-section>

</x-content>

@endsection