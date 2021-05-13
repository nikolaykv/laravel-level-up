<template>
    <div>
        <!-- Группы START -->
        <table class="table table-bordered list" v-if="'group' in data">
            <thead>
            <tr>
                <th>{{ variables.id }}</th>
                <th>{{ variables.group }}</th>
                <th>{{ variables.titles.students }}</th>
                <th>{{ variables.dataCreated }}</th>
                <th>{{ variables.dataUpdated }}</th>
                <th>{{ variables.availableActions }}</th>
            </tr>
            </thead>
            <tbody>

            <tr class="show-item-group" v-for="group in data.group">
                <td class="align-middle">{{ group.id }}</td>
                <td class="align-middle">{{ group.name }}</td>

                <td class="align-middle" v-if="group.students.length > 0">
                    <p v-for="(student, key) in group.students"
                       v-bind:key="key"
                       class="mb-0">
                        {{ student.user.full_name }}
                    </p>
                </td>
                <td v-else>
                    <p class="mb-0">{{ variables.index.studentEmpty }}</p>
                </td>

                <td class="align-middle">{{ group.created_at }}</td>
                <td class="align-middle">{{ group.updated_at }}</td>
                <td class="align-middle">
                    <span class="d-xl-flex justify-content-xl-around">
                        <delete-item v-bind:deleteData="{id:group.id, url:'/api/groups/'}"></delete-item>
                    </span>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- Группы END -->

        <!-- Предметы START -->
        <table class="table table-bordered list" v-else-if="'subject' in data">
            <thead>
            <tr>
                <th>{{ variables.id }}</th>
                <th>{{ variables.subject }}</th>
                <th>{{ variables.student }}</th>
                <th>{{ variables.academicGrades }}</th>
                <th>{{ variables.dataCreated }}</th>
                <th>{{ variables.availableActions }}</th>
            </tr>
            </thead>
            <tbody>
            <tr class="show-item-subject">
                <td>{{ data.subject.id }}</td>
                <td>{{ data.subject.name }}</td>
                <td>{{ data.subject.student.user.full_name }}</td>
                <td class="text-center">{{ data.subject.value }}</td>
                <td>{{ data.subject.created_at }}</td>
                <td class="d-xl-flex justify-content-xl-around">
                    <delete-item v-bind:deleteData="{id:data.subject.id, url:'/api/subjects/'}"></delete-item>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- Предметы END -->

        <!-- Студенты START -->
        <table class="table table-bordered list" v-else>
            <thead>
            <tr>
                <th>{{ variables.id }}</th>
                <th>{{ variables.student }}</th>
                <th>{{ variables.group }}</th>
                <th>{{ variables.subject }}</th>
                <th>{{ variables.academicGrades }}</th>
                <th>{{ variables.availableActions }}</th>
            </tr>
            </thead>
            <tbody>
            <tr class="show-item-student">
                <td>{{ data.student.id }}</td>
                <td>{{ data.student.user.full_name }}</td>
                <td>{{ data.student.group.name }}</td>
                <td>{{ data.student.subject.name }}</td>
                <td class="text-center">{{ data.student.subject.value }}</td>
                <td class="d-xl-flex justify-content-xl-around">
                    <delete-item v-bind:deleteData="{id:data.student.id, url:'/api/students/'}"></delete-item>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- Студенты END -->
    </div>
</template>

<script>


import langVariables from '../../lang/ru/crud.json'
import deleteItem from "./delete";

export default {
    name: 'show',
    components: {deleteItem},
    props: ['data'],
    data: () => ({
        variables: langVariables,
    }),
    methods: {
        redrawHtml() {
            $('.show-item-group').html('<td class="alert alert-success text-center" colspan="6">' + langVariables.deleted + '</td>')
            $('.show-item-subject').html('<td class="alert alert-success text-center" colspan="7">' + langVariables.deleted + '</td>')
            $('.show-item-student').html('<td class="alert alert-success text-center" colspan="6">' + langVariables.deleted + '</td>')
        }
    },
}
</script>
