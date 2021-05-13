<template>
    <!-- Учебная группа START -->
    <div v-if="'group' in obj">
        <div class="form-group row col-md-8 ml-auto mr-auto mt-4">
            <label for="group-name"
                   class="col-md-3 col-form-label text-md-right">
                {{ variables.group }}:
            </label>

            <div class="col-md-9">
                <input id="group-name"
                       type="text"
                       class="form-control"
                       required
                       autofocus
                       v-bind:placeholder="obj.group.name"
                       v-model="formData.group.name">

                <span class="success-message added-now" v-bind:class="isActive">
                     {{ variables.success }}
                </span>

                <span class="invalid-error" v-if="error">
                    <strong>
                        {{ messages }}
                    </strong>
                </span>

            </div>
        </div>

        <div class="form-group row col-md-8 ml-auto mr-auto mt-4">
            <label for="student"
                   class="col-md-3 col-form-label text-md-right">
                {{ variables.titles.students }}:
            </label>

            <div class="col-md-9">
                <select class="form-control"
                        id="student"
                        multiple="multiple"
                        size="5">
                    <option value="false">
                        {{ variables.add.dontBindStudents }}
                    </option>
                    <option v-for="(intersection, key) in intersectionStudents"
                            v-bind:key="key"
                            v-bind:selected="intersection.user.intersection">
                        {{ intersection.user.full_name }}
                    </option>
                </select>

                <span class="success-message" v-bind:class="isActive">
                    {{ variables.add.studentsAssigned }}
                </span>

                <span class="invalid-error front-end-validation">
                    &nbsp;
                </span>

            </div>

            <div class="offset-md-2 col-md-10 text-right mt-3">
                <button class="btn btn-primary" v-on:click.prevent="update(obj)">
                    {{ variables.editBtn }}
                </button>
            </div>
        </div>
    </div>
    <!-- Учебная группа END -->

    <!-- Учебный предмет START -->
    <div v-else-if="'subject' in obj">
        <!-- Название учебного предмета START -->
        <div class="form-group row col-md-10 ml-auto mr-auto mt-4">
            <label for="subject-name" class="col-md-4 col-form-label text-md-right">
                {{ variables.subject }}:
            </label>

            <div class="col-md-8">
                <input id="subject-name"
                       type="text"
                       class="form-control"
                       required
                       autofocus
                       v-bind:placeholder="obj.subject.name"
                       v-model="formData.subject">

                <span class="invalid-error" v-if="error">
                    <strong v-if="messages.hasOwnProperty('name')">
                        {{ messages.name[0] }}
                    </strong>
                </span>
            </div>
        </div>
        <!-- Название учебного предмета END -->

        <!-- Студент START -->
        <div class="form-group row col-md-10 ml-auto mr-auto mt-4">
            <label for="subject-name" class="col-md-4 col-form-label text-md-right">
                {{ variables.titles.students }}:
            </label>

            <div class="col-md-8">
                <input id="subject-student"
                       type="text"
                       class="form-control"
                       required
                       autofocus
                       v-bind:placeholder="obj.subject.student"
                       v-model="formData.student">

                <span class="invalid-error" v-if="error">
                    <strong v-if="messages.hasOwnProperty('student')">
                        {{ messages.student[0] }}
                    </strong>
                </span>
            </div>
        </div>
        <!-- Студент END -->

        <!-- Оценка студента START -->
        <div class="form-group row col-md-10 ml-auto mr-auto mt-4">
            <label for="subject-name" class="col-md-4 col-form-label text-md-right">
                {{ variables.academicGrades }}:
            </label>

            <div class="col-md-8">
                <input id="subject-grades"
                       type="text"
                       class="form-control"
                       required
                       autofocus
                       v-bind:placeholder="obj.subject.academic_grades"
                       v-model="formData.academic_grades">

                <span class="invalid-error" v-if="error">
                    <strong v-if="messages.hasOwnProperty('value')">
                        {{ messages.value[0] }}
                    </strong>
                </span>

                <div class="alert alert-success mt-3" v-bind:class="isActive">
                    {{ variables.success }}
                </div>
            </div>
            <div class="offset-md-2 col-md-10 text-right mt-3">
                <button class="btn btn-primary" v-on:click.prevent="update(obj)">
                    {{ variables.editBtn }}
                </button>
            </div>
        </div>
        <!-- Оценка студента END -->
    </div>
    <!-- Учебный предмет END -->

    <!-- Студенты START -->
    <div v-else>
        <!-- Имя -->
        <div class="form-group row col-md-10 ml-auto mr-auto mt-4">
            <label for="student-firstname" class="col-md-4 col-form-label text-md-right">
                {{ variables.firstname }}
            </label>

            <div class="col-md-8">
                <input id="student-firstname"
                       type="text"
                       class="form-control"
                       v-bind:placeholder="fullNameUserSplit.name"
                       required
                       autofocus>
            </div>
        </div>

        <!-- Фамилия -->
        <div class="form-group row col-md-10 ml-auto mr-auto mt-4">
            <label for="student-lastname" class="col-md-4 col-form-label text-md-right">
                {{ variables.lastname }}:
            </label>

            <div class="col-md-8">
                <input id="student-lastname"
                       type="text"
                       class="form-control"
                       v-bind:placeholder="fullNameUserSplit.surname"
                       required
                       autofocus>
            </div>
        </div>

        <!-- Группа -->
        <div class="form-group row col-md-10 ml-auto mr-auto mt-4">
            <label for="student-group" class="col-md-4 col-form-label text-md-right">
                {{ variables.group }}:
            </label>
            <div class="col-md-8">
                <select class="form-control"
                        id="student-group"
                        size="5">
                    <option v-for="(intersection, key) in intersectionGroups"
                            v-bind:key="key"
                            v-bind:selected="intersection.intersection">
                        {{ intersection.name }}
                    </option>
                </select>
            </div>
        </div>

        <!-- Предмет -->
        <div class="form-group row col-md-10 ml-auto mr-auto mt-4">

            <label for="student-subject" class="col-md-4 col-form-label text-md-right">
                {{ variables.subject }}:
            </label>

            <div class="col-md-8">
                <select class="form-control"
                        id="student-subject"
                        size="5">
                    <option v-for="(intersection, key) in intersectionSubjects"
                            v-bind:key="key"
                            v-bind:selected="intersection.intersection">
                        {{ intersection.name }}
                    </option>
                </select>
            </div>
        </div>


        <div class="offset-md-2 col-md-10 text-right mt-3">
            <button class="btn btn-primary" v-on:click.prevent="update(obj)">
                {{ variables.editBtn }}
            </button>
        </div>
    </div>
    <!-- Студенты END -->
</template>

<script>
import langVariables from '../../lang/ru/crud.json'

export default {
    name: "edit",
    props: ['obj'],
    data: () => ({
        formData: {
            group: {
                name: '',
                students: []
            },
            subject: '',
            student: '',
            academic_grades: '',
        },
        error: false,
        messages: '',
        isActive: 'd-none',
        variables: langVariables,
        students: {
            all: [],
            current: []
        },
        counter: 0,
        allGroups: [],
        allSubjects: []
    }),
    methods: {
        update(obj) {
            let groupFormData = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: this.formData.group.name,
                students: $('#student').val()
            }

            let subjectFormData = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: this.formData.subject,
                student: this.formData.student,
                value: this.formData.academic_grades,
            }
            switch (true) {
                case obj.hasOwnProperty('group'):
                    if (groupFormData.students.length > 0) {
                        $('.front-end-validation').text('').addClass('d-none');
                        $.ajax({
                            url: obj.group.url + obj.group.id,
                            data: groupFormData,
                            method: 'patch',
                            dataType: 'json',
                            success: (data) => {
                                this.counter += 1;
                                this.isActive = 'd-block';
                                $('.nav-link.active').text(data.name);
                                this.messages = '';

                                if (this.counter > 1) {
                                    $('.success-message.added-now').text(langVariables.updated);
                                }

                            },
                            error: (error) => {
                                this.isActive = 'd-none';
                                this.error = true;
                                this.messages = error.responseJSON.errors.name[0];
                            }
                        });
                    } else {
                        $('.front-end-validation').html('<strong>' + langVariables.add.notSelectedStudents + '</strong>');
                    }
                    break;
                case obj.hasOwnProperty('subject'):
                    $.ajax({
                        url: obj.subject.url + obj.subject.id,
                        data: subjectFormData,
                        method: 'patch',
                        dataType: 'json',
                        success: (data) => {
                            this.isActive = 'd-block';
                            $('.nav-link.active').text(data.name);
                            this.messages = '';
                        },
                        error: (error) => {
                            this.isActive = 'd-none';
                            this.error = true;
                            this.messages = error.responseJSON.errors;
                        }
                    });
                    break;
                case obj.hasOwnProperty('student'):
                    $.ajax({
                        url: obj.student.url + obj.student.id,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            запрос: 'Пример запроса на обновление ресурса'
                        },
                        method: 'patch',
                        dataType: 'json',
                        success: (data) => {
                            console.log(data)
                        },
                        error: (error) => {
                            console.log(error)
                        }
                    });
                    break;
            }
        },
    },
    beforeCreate() {
        $.ajax({
            url: '/api/students?get=all',
            method: 'get',
            success: (data) => {
                this.students.all = data.students;
            },
        });

        if ('group' in this.$options.propsData.obj) {
            $.ajax({
                url: this.$options.propsData.obj.group.url + this.$options.propsData.obj.group.id + '?action=edit',
                method: 'get',
                success: (data) => {
                    this.students.current = data.group;
                },
            });
        }

        $.ajax({
            url: '/api/groups?get=all',
            method: 'get',
            success: (data) => {
                this.allGroups = data
            },
        });

        $.ajax({
            url: '/api/subjects?get=all',
            method: 'get',
            success: (data) => {
                this.allSubjects = data;
            },
        });
    },
    computed: {
        // Определить пересечение значений в объектах
        intersectionStudents: function () {
            let studentsAll = this.students.all;
            let students = this.students.current;
            studentsAll.forEach(function (student) {
                students.forEach(function (intersection) {
                    if (student.user.full_name === intersection.user[0].full_name) {
                        student.user['intersection'] = 'true';
                    }
                });
            });

            return studentsAll;
        },

        intersectionGroups: function () {
            let allGroups = this.allGroups;
            let groupCurrent = this.obj.student.group;

            allGroups.forEach(function (group) {
                if (group.name && group.name === groupCurrent) {
                    group['intersection'] = 'true';
                }
            });
            return allGroups;
        },

        intersectionSubjects: function () {
            let allSubjects = this.allSubjects;
            let subjectCurrent = this.obj.student.subject;

            allSubjects.forEach(function (subject) {
                if (subject.name === subjectCurrent) {
                    subject['intersection'] = 'true';
                }
            });
            return allSubjects;
        },

        fullNameUserSplit: function () {
            let split = this.obj.student.user.full_name.split(" ")
            return {
                name: split[0],
                surname: split[1]
            }
        },
    }
}
</script>
