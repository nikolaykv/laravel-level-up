<template>
    <div>
        <table class="table table-bordered list">
            <thead>
            <tr>
                <th>{{ variables.groups.id }}</th>
                <th>{{ variables.groups.name }}</th>
                <th>{{ variables.groups.created }}</th>
                <th>{{ variables.groups.updated }}</th>
                <th>{{ variables.groups.available_actions }}</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td>{{ group.id }}</td>
                <td>{{ group.name }}</td>
                <td>{{ group.created_at }}</td>
                <td>{{ group.updated_at }}</td>
                <td class="d-xl-flex justify-content-xl-around">
                    <i class="far fa-trash-alt bg-danger text-white btn d-flex align-items-center"></i>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>


<script>

import LangVariables from '../../../lang/ru/crud.json'

export default {
    name: 'show',
    props: ['group'],
    data: () => ({
        variables: LangVariables,
    }),
}
</script>
