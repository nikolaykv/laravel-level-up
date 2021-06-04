<template>
    <div>
        <div v-if="subjects.length > 0">
            <table class="table table-bordered list">
                <thead>
                <tr>
                    <th>{{ variables.id }}</th>
                    <th>{{ variables.subject }}</th>
                    <th>{{ variables.titles.students }}</th>
                    <th>{{ variables.academicGrades }}</th>
                    <th>{{ variables.dataCreated }}</th>
                    <th>{{ variables.availableActions }}</th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="subject in subjects" v-bind:key="subject.id">
                    <td class="align-middle">{{ subject.id }}</td>
                    <td class="align-middle">{{ subject.name }}</td>

                    <!-- Полное имя студента START -->
                    <td class="align-middle" v-if="subject.student.length > 0">
                        <p v-for="(student, key) in subject.student"
                           v-bind:key="key"
                           class="mb-0">
                            {{student.user.full_name}}
                        </p>
                    </td>

                    <td class="align-middle" v-else>
                        {{ variables.index.studentEmpty }}
                    </td>
                    <!-- Полное имя студента END -->

                    <!-- Академическая оценка студента START -->
                    <td class="align-middle" v-if="subject.student.length > 0">
                        <p v-for="(student, key) in subject.student"
                           v-bind:key="key"
                           class="mb-0">
                            {{student.academic_grade}}
                        </p>
                    </td>

                    <td class="align-middle" v-else>
                        {{ variables.index.academicGradeEmpty }}
                    </td>
                    <!-- Академическая оценка студента END -->

                    <td class="align-middle">{{ subject.created_at }}</td>
                    <td class="align-middle">
                        <span class="d-xl-flex justify-content-xl-around">
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
            {{ variables.index.subjectEmpty }}
        </div>

        <div class="container-xl">
            <div class="row d-flex flex-row-reverse justify-content-between">
                <a class="btn btn-primary" v-on:click.prevent="addNew(addData)">
                    {{ variables.index.subjectAddNew }}
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
    components: {pagination, deleteItem},
    props: ['subjects', 'pagination'],
    data: () => ({
        variables: langVariables,
        url: '/api/subjects?page=',
        addData: {
            subject: {
                name: langVariables.index.subjectAddNew,
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
        },
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
