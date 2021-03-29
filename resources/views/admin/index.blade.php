@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="container">
                <div class="card">
                    <div class="card-header">{{ __('common.admin.card') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p class="font-weight-bold mt-xl-2">
                            {{ __('common.admin.you_are_logged') }}
                        </p>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>{{__('crud.groups.id')}}</th>
                                <th>{{__('crud.groups.name')}}</th>
                                <th>{{__('crud.groups.created')}}</th>
                                <th>{{__('crud.groups.updated')}}</th>
                                <th>{{__('crud.groups.available_actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groups as $group)
                                <tr>
                                    <td>{{ $group->id }}</td>
                                    <td>
                                        <a href="#">
                                            {{ $group->name }}
                                        </a>
                                    </td>
                                    <td>{{ $group->created_at }}</td>
                                    <td>{{ $group->updated_at }}</td>
                                    @include('admin.crud.groups.buttons')
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="container-xl">
                            <div class="row">
                                <a class="btn btn-primary ml-xl-auto" href="{{ route('groups.create') }}">
                                    {{__('crud.groups.add_new')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
