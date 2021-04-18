<template>
    <div>
        <table class="table table-bordered list">
            <thead>
            <tr>
                <th>{{ variables.index.id }}</th>
                <th>{{ variables.index.name }}</th>
                <th>{{ variables.index.created }}</th>
                <th>{{ variables.index.updated }}</th>
                <th>{{ variables.index.available_actions }}</th>
            </tr>
            </thead>
            <tbody>

            <tr class="show-group">
                <td>{{ group.id }}</td>
                <td>{{ group.name }}</td>
                <td>{{ group.created_at }}</td>
                <td>{{ group.updated_at }}</td>
                <td class="d-xl-flex justify-content-xl-around">
                    <delete v-bind:id="group.id"></delete>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>


<script>


import LangVariables from '../../../lang/ru/crud.json'
import Delete from "./delete";

export default {
    name: 'show',
    components: {Delete},
    props: ['group'],
    data: () => ({
        variables: LangVariables,
        id: false,
    }),
    methods: {
        redrawHtml() {
            $('.show-group').html('<td class="alert alert-success text-center" colspan="5">Запись успешно удалена!</td>')
        }
    }
}
</script>
