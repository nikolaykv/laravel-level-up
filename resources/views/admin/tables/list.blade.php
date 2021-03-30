{{-- views/admin/index.blade.php --}}
<table class="table table-bordered list">
    <thead>
    <tr>
        <th>{{__('crud.groups.id')}}</th>
        <th>{{__('crud.groups.name')}}</th>
        <th>{{__('crud.groups.created')}}</th>
        <th>{{__('crud.groups.updated')}}</th>
        <th>{{__('crud.groups.available_actions')}}</th>
    </tr>
    </thead>
    <tbody>&nbsp;</tbody>
</table>
<div class="container-xl">
    <div class="row d-flex flex-row-reverse justify-content-between">
        <a class="btn btn-primary" href="{{ route('groups.create') }}">
            {{__('crud.groups.add_new')}}
        </a>
    </div>
</div>
