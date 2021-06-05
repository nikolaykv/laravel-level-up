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
                    <td class="align-middle">{{ student.id }}</td>
                    <td class="align-middle">{{ student.user.full_name }}</td>
                    <td class="align-middle"
                        v-if="student.group">
                        {{ student.group.name }}
                    </td>
                    <td class="align-middle" v-else>
                        {{ variables.index.studentGroupEmpty }}
                    </td>

                    <!-- Название предмета START -->
                    <td v-if="student.subject"
                        class="align-middle">
                        {{ student.subject.name }}
                    </td>
                    <td v-else class="align-middle">
                        {{ variables.index.studentSubjectEmpty }}
                    </td>
                    <!-- Название предмета END -->

                    <!-- Оценка студента по предмету START -->
                    <td v-if="student.academic_grade" class="text-center">
                        {{ student.academic_grade }}
                    </td>
                    <td v-else class="align-middle text-center">
                        {{ variables.index.academicGradeEmpty }}
                    </td>
                    <!-- Оценка студента по предмету END -->

                    <td class="align-middle">
                        <span class="d-xl-flex justify-content-xl-around">
                            <i class="far fa-edit bg-primary text-white btn d-flex align-items-center"
                               v-on:click="editStudent({
                               student: {
                                   'id':student.id,
                                   'group': student.group,
                                   'subject': student.subject,
                                   'value':   student.subject.value,
                                   user: {full_name: student.user.full_name},
                                    url:'/api/students/'
                               }})">
                            </i>
                            <i class="far fa-eye bg-success text-white btn d-flex align-items-center"
                               v-on:click="showStudent(student.id)"></i>
                            <delete-item v-bind:deleteData="{id:student.id, url:'/api/students/'}"></delete-item>
                        </span>
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

        <div class="alert alert-danger text-center d-none empty-result mt-3" v-else>
            {{ variables.index.studentEmpty }}
        </div>

        <div class="container-xl">
            <div class="row d-flex flex-row-reverse justify-content-between">
                <a class="btn btn-primary" v-on:click.prevent="addNew(addData)">
                    {{ variables.index.studentAddNew }}
                </a>
            </div>
        </div>
    </div>
</template>

<script>

import langVariables from '../../../lang/ru/crud.json'
import pagination from "../pagination";
import deleteItem from "../delete";


export default {
    name: 'index',
    props: ['students', 'pagination'],
    components: {pagination, deleteItem},
    data: () => ({
        variables: langVariables,
        url: '/api/students?page=',
        addData: {
            student: {
                user: {
                    full_name: langVariables.index.studentAddNew,
                },
                url: '/api/students'
            },
            tabs: 'service',
            components: 'new'
        },
    }),
    methods: {
        showStudent(id) {
            $.ajax({
                url: '/api/students/' + id,
                method: 'get',
                cache: false,
                success: (data) => {
                    this.$emit('showDetail', data)
                }
            });
        },
        editStudent(obj) {
            if (obj) {
                this.$emit('edit', obj);
            }
        },
        addNew(obj) {
            this.$emit('addNewItem', obj);
        }
    }
}
</script>
