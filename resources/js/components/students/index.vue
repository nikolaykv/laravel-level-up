<template>
    <div>
        <div v-if="students.length > 0">
            <table class="table table-bordered list">
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
                <tr v-for="student in students" v-bind:key="student.id">
                    <td>{{student.id}}</td>
                    <td>{{student.user.full_name}}</td>
                    <td>{{student.group.name}}</td>
                    <td>{{student.subject.name}}</td>
                    <td class="text-center">{{student.subject.value}}</td>
                    <td class="d-xl-flex justify-content-xl-around">
                        <i class="far fa-edit bg-primary text-white btn d-flex align-items-center"></i>
                        <i class="far fa-eye bg-success text-white btn d-flex align-items-center"></i>
                        <i class="far fa-trash-alt bg-danger text-white btn d-flex align-items-center"></i>
                    </td>
                </tr>
                </tbody>
            </table>

            <pagination
                v-if="pagination.last_page > 1"
                v-bind:url="url"
                v-bind:pagination="pagination">
            </pagination>
        </div>
    </div>
</template>

<script>

import langVariables from '../../../lang/ru/crud.json'
import pagination from "../pagination";

export default {
    name: 'index',
    props: ['students', 'pagination'],
    components: {pagination},
    data: () => ({
        variables: langVariables,
        url: '/api/students?page=',
    })
}
</script>
