@extends('layouts.admin')

@section('title', 'Skill')

@section('css')
@endsection

@section('js')
@endsection

@section('content')

<x-content>
    <x-slot name="modul">
        <h1>Skill</h1>
    </x-slot>

    <x-section>
        <x-slot name="title">
        </x-slot>
        
        <x-slot name="header">
            <h4>Data Skills</h4>
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
                <div class="ml-2 pr-3">
                    @role('senior-hrd')
                        <a href="javascript:;" data-url="{{ route('admin.skill.create') }}"
                        data-title="Add Skill"
                        role="button"
                        class="btn btn-sm btn-primary btn-action-modal">
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
                            <th style="width: 45%">Description</th>
                            <th style="width:150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($skills as $skill)
                        <tr>
                            <td>{{ $loop->index + $skills->firstItem() }}</td>
                            <td>{{ $skill->name }}</td>
                            <td>{{ $skill->description ? Str::limit($skill->description, 150, '...') : '-' }}</td>
                            <td>
                                <x-action-btn
                                :actions="[
                                    'edit' => [
                                        'isShow' => auth()->user()->hasRole('senior-hrd'),
                                        'prevent' => true,
                                        'route'   => route('admin.skill.edit', $skill),
                                        'title'   => 'Edit Skill ' . $skill->name
                                    ],
                                    'delete' => [
                                        'route' => route('admin.skill.destroy', $skill),
                                    ]
                                ]"
                                ></x-action-btn>
                            </td>
                        </tr>
                        @empty
                            <x-tr-no-record colspan="4"></x-tr-no-record>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-slot>

        <x-slot name="footer">
            {{ $skills->onEachSide(2)->appends($_GET)->links('admin.partials.pagination') }}
        </x-slot>
    </x-section>
</x-content>

@include('admin.partials.modal')

@endsection