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
                       v-model="formData.group">

                <span class="invalid-error" v-if="error">
                    <strong>
                        {{ messages }}
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
        <p>
            Какие-нибудь поля
        </p>
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
            group: '',
            subject: '',
            student: '',
            academic_grades: ''
        },
        error: false,
        messages: '',
        isActive: 'd-none',
        variables: langVariables,
    }),
    methods: {
        update(obj) {
            let groupFormData = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: this.formData.group
            }
            let subjectFormData = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: this.formData.subject,
                student: this.formData.student,
                value: this.formData.academic_grades,
            }

            switch (true) {
                case obj.hasOwnProperty('group'):
                    $.ajax({
                        url: obj.group.url + obj.group.id,
                        data: groupFormData,
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
                            this.messages = error.responseJSON.errors.name[0];
                        }
                    });
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
}
</script>
