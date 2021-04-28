<template>
    <div>
        <div v-if="subjects.length > 0">
            <table class="table table-bordered list">
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

                <tr v-for="subject in subjects" v-bind:key="subject.id">
                    <td>{{ subject.id }}</td>
                    <td>{{ subject.name }}</td>
                    <td>{{ subject.student.full_name }}</td>
                    <td class="text-center">{{ subject.value }}</td>
                    <td>{{ subject.created_at }}</td>
                    <td>{{ subject.updated_at }}</td>
                    <td class="d-xl-flex justify-content-xl-around">
                        <i class="far fa-edit bg-primary text-white btn d-flex align-items-center"
                           v-on:click="editSubject({
                           subject: {
                               'id':subject.id,
                                name: subject.name,
                                student: subject.student.full_name,
                                academic_grades: subject.value,
                                url:'/api/subjects/'
                           }})">
                        </i>
                        <i class="far fa-eye bg-success text-white btn d-flex align-items-center"
                           v-on:click="showSubject(subject.id)"></i>
                        <delete-item v-bind:deleteData="{id:subject.id, url:'/api/subjects/'}"></delete-item>
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
            {{ variables.subjects.empty }}
        </div>

        <div class="container-xl">
            <div class="row d-flex flex-row-reverse justify-content-between">
                <a class="btn btn-primary" v-on:click.prevent="addNew(addData)">
                    {{ variables.subjects.add_new }}
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import langVariables from '../../../lang/ru/crud.json'

import deleteItem from "../delete";
import pagination from "../pagination";

export default {
    name: 'index',
    components: {pagination, deleteItem},
    props: ['subjects', 'pagination'],
    data: () => ({
        variables: langVariables,
        url: '/api/subjects?page=',
        addData: {
            subject: {
                name: 'Добавить новый учебный предмет',
                url: '/api/subjects'
            },
            tabs: 'service',
            components: 'new'
        },
    }),
    methods: {
        showSubject(id) {
            $.ajax({
                url: '/api/subjects/' + id,
                method: 'get',
                cache: false,
                success: (data) => {
                    this.$emit('showDetail', data)
                }
            });
        },
        editSubject(obj) {
            if (obj) {
                this.$emit('edit', obj);
            }
        },
        addNew(obj) {
            this.$emit('addNewItem', obj);
        }
    },
    updated() {
        setTimeout(function () {
            if ($('.empty-result').hasClass('d-none')) {
                $('.empty-result').removeClass('d-none')
            }
        }, 500)
    },
}
</script>
