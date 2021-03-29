@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="container">
                <div class="card">
                    <div class="card-header font-weight-bold">{{ $group->name }} Редактировать</div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>{{__('crud.groups.id')}}</th>
                                <th>{{__('crud.groups.name')}}</th>
                                <th>{{__('crud.groups.created')}}</th>
                                <th>{{__('crud.groups.updated')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $group->id }}</td>
                                <td>{{ $group->name }}</td>
                                <td>{{ $group->created_at }}</td>
                                <td>{{ $group->updated_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
