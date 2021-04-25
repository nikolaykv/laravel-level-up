<template>
    <div>
        <!-- Группы START -->
        <table class="table table-bordered list" v-if="'group' in data">
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

            <tr class="show-item">
                <td>{{ data.group.id }}</td>
                <td>{{ data.group.name }}</td>
                <td>{{ data.group.created_at }}</td>
                <td>{{ data.group.updated_at }}</td>
                <td class="d-xl-flex justify-content-xl-around">
                    <delete-item v-bind:id="data.group.id"></delete-item>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- Группы END -->

        <!-- Предметы START -->
        <table class="table table-bordered list" v-else-if="'subject' in data">
            <thead>
            <tr>
                <th>{{ variables.subjects.id }}</th>
                <th>{{ variables.subjects.name }}</th>
                <th>{{ variables.subjects.students }}</th>
                <th>{{ variables.subjects.academic_grades }}</th>
                <th>{{ variables.subjects.created }}</th>
                <th>{{ variables.subjects.updated }}</th>
                <th>{{ variables.subjects.available_actions }}</th>
            </tr>
            </thead>
            <tbody>
            <tr class="show-item">
                <td>{{ data.subject.id }}</td>
                <td>{{ data.subject.name }}</td>
                <td>{{ data.subject.student_id }}</td>
                <td>{{ data.subject.value }}</td>
                <td>{{ data.subject.created_at }}</td>
                <td>{{ data.subject.updated_at }}</td>
                <td class="d-xl-flex justify-content-xl-around">
<!--                    <delete-item v-bind:id="data.subject.id"></delete-item>-->
                </td>
            </tr>
            </tbody>
        </table>
        <!-- Предметы END -->
    </div>
</template>

<script>


import LangVariables from '../../lang/ru/crud.json'
import deleteItem from "./delete";

export default {
    name: 'show',
    components: {deleteItem},
    props: ['data'],
    data: () => ({
        variables: LangVariables,
        id: false,
    }),
    methods: {
        redrawHtml() {
            $('.show-item').html('<td class="alert alert-success text-center" colspan="5">Запись успешно удалена!</td>')
        }
    },
}
</script>
