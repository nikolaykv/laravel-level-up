{{-- resources/views/admin/index.blade.php --}}
<td class="d-xl-flex justify-content-xl-around">
        <a class="w-25 bg-primary text-white text-center rounded p-1"
           href="{{ route('groups.edit', $group->id) }}">
            <i class="far fa-edit"></i>
        </a>
        <a href="{{ route('groups.show', $group->id) }}"
           class="w-25 bg-success text-white text-center rounded p-1">
            <i class="far fa-eye"></i>
        </a>
        <a class="w-25 bg-danger text-white text-center rounded p-1"
           href=#>
            <i class="far fa-trash-alt"></i>
        </a>
</td>
