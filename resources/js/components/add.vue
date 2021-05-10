<template>
    <!-- Группа START-->
    <div v-if="obj.hasOwnProperty('group')">

        <div class="form-group row col-md-8 ml-auto mr-auto mt-4">
            <label for="group-name" class="col-md-3 col-form-label text-md-right">
                {{ variables.group }}:
            </label>

            <div class="col-md-9">
                <input id="group-name"
                       type="text"
                       class="form-control"
                       required
                       autofocus
                       v-model="formData.group.name">

                <span class="success-message added-now" v-bind:class="isActive">
                    {{ variables.add.groupSuccess }}
                </span>

                <span class="invalid-error" v-if="error">
                    {{ messages }}
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
                        v-model="formData.group.students"
                        multiple="multiple"
                        size="5">
                    <option value="false">
                        {{ variables.add.dontBindStudents }}
                    </option>
                    <option v-for="(student, key) in allStudents"
                            v-bind:value="student.user.full_name"
                            v-bind:key="key">
                        {{ student.user.full_name }}
                    </option>
                </select>


                <span class="success-message" v-bind:class="isActive">
                    {{ variables.add.studentsAssignedNew }}
                </span>

                <span class="invalid-error front-end-validation">
                    &nbsp;
                </span>
            </div>

            <div class="offset-md-2 col-md-10 text-right mt-3">
                <button class="btn btn-primary" v-on:click="addNew(obj)">
                    {{ variables.save }}
                </button>
            </div>
        </div>
    </div>
    <!-- Группа END -->

    <!-- Учебный предмет START -->
    <div v-else-if="obj.hasOwnProperty('subject')">
        <!-- Имя START-->
        <div class="form-group row col-md-10 ml-auto mr-auto mt-4">
            <label for="subject-name"
                   class="col-md-4 col-form-label text-md-right">
                {{ variables.subject }}:
            </label>

            <div class="col-md-8">
                <input id="subject-name"
                       type="text"
                       class="form-control"
                       required
                       autofocus
                       v-model="formData.subject.name">

                <span class="invalid-error" v-if="error">
                    <strong v-if="messages.hasOwnProperty('name')">
                        {{ messages.name[0] }}
                    </strong>
                </span>
            </div>
        </div>
        <!-- Имя END -->

        <!-- Группа START-->
        <div class="form-group row col-md-10 ml-auto mr-auto mt-4">
            <label for="group"
                   class="col-md-4 col-form-label text-md-right">
                {{ variables.group }}:
            </label>

            <div class="col-md-8">
                <select class="form-control" v-model="formData.subject.group_id" id="group" required autofocus>
                    <option value="" selected disabled hidden>{{ variables.select }}</option>
                    <option v-for="group in groups" v-bind:key="group.id">
                        {{ group.id }}. {{ group.name }}
                    </option>
                </select>

                <span class="invalid-error" v-if="error">
                    <strong v-if="messages.hasOwnProperty('group_id')">
                        {{ messages.group_id[0] }}
                    </strong>
                </span>
            </div>
        </div>
        <!-- Группа END -->

        <!-- Студент START-->
        <div class="form-group row col-md-10 ml-auto mr-auto mt-4">
            <label for="student-name"
                   class="col-md-4 col-form-label text-md-right">
                {{ variables.student }}:
            </label>

            <div class="col-md-8">
                <input id="student-name"
                       type="text"
                       class="form-control"
                       required
                       autofocus
                       v-model="formData.subject.student">

                <span class="invalid-error" v-if="error">
                    <strong v-if="messages.hasOwnProperty('student')">
                        {{ messages.student[0] }}
                    </strong>
                </span>
            </div>
        </div>
        <!-- Студент END -->

        <!-- Оценка по предмету START-->
        <div class="form-group row col-md-10 ml-auto mr-auto mt-4">
            <label for="value"
                   class="col-md-4 col-form-label text-md-right">
                {{ variables.academicGrades }}
            </label>

            <div class="col-md-8">
                <input id="value"
                       type="text"
                       class="form-control"
                       required
                       autofocus
                       v-model="formData.subject.value">

                <span class="invalid-error" v-if="error">
                    <strong v-if="messages.hasOwnProperty('value')">
                        {{ messages.value[0] }}
                    </strong>
                </span>
            </div>
        </div>
        <!-- Оценка по предмету END -->

        <span class="success-message" v-bind:class="isActive">{{ variables.add.subjectSuccess }}</span>

        <div class="offset-md-2 col-md-10 text-right mt-3">
            <button class="btn btn-primary" v-on:click="addNew(obj)">
                {{ variables.save }}
            </button>
        </div>
    </div>
    <!-- Учебный предмет END -->

    <!-- Студенты START -->
    <div v-else>
        <p>Форма для добавления студента</p>
        <div class="offset-md-2 col-md-10 text-right mt-3">
            <button class="btn btn-primary" v-on:click="addNew(obj)">
                {{ variables.save }}
            </button>
        </div>
    </div>
    <!-- Студенты END -->
</template>

<script>
import langVariables from '../../lang/ru/crud.json'

export default {
    name: 'add',
    props: ['obj'],
    data: () => ({
        formData: {
            group: {
                name: '',
                students: [],
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            subject: {
                name: '',
                student: '',
                value: '',
                group_id: '',
                _token: $('meta[name="csrf-token"]').attr('content'),
            }
        },
        counter: 0,
        variables: langVariables,
        error: false,
        messages: '',
        isActive: 'd-none',
        groups: [],
        allStudents: []
    }),
    methods: {
        addNew(obj) {
            switch (true) {
                case obj.hasOwnProperty('group'):
                    if (this.formData.group.students.length > 0) {
                        $('.front-end-validation').text('').addClass('d-none');
                        $.ajax({
                            url: obj.group.url,
                            method: 'post',
                            data: this.formData.group,
                            success: () => {
                                this.counter += 1;
                                this.isActive = 'd-block';
                                this.messages = '';

                                if (this.counter > 1) {
                                    $('.success-message.added-now').text(langVariables.added);
                                }
                            },
                            error: (error) => {
                                this.isActive = 'd-none';
                                this.error = true;
                                this.messages = error.responseJSON.errors.name[0];
                            },
                        });
                    } else {
                        $('.front-end-validation').html('<strong>' + langVariables.add.notSelectedStudents + '</strong>');
                    }
                    break;
                case obj.hasOwnProperty('subject'):
                    this.formData.subject.group_id = this.formData.subject.group_id.split('.')[0];
                    $.ajax({
                        url: obj.subject.url,
                        method: 'post',
                        data: this.formData.subject,
                        success: () => {
                            this.counter += 1;
                            this.isActive = 'd-block';
                            this.messages = '';

                            if (this.counter > 1) {
                                $('.success-message').text(langVariables.added);
                            }
                        },
                        error: (error) => {
                            this.isActive = 'd-none';
                            this.error = true;
                            this.messages = error.responseJSON.errors;
                        },
                    });
                    break;
                case obj.hasOwnProperty('student'):
                    $.ajax({
                        url: obj.student.url,
                        method: 'post',
                        data: {
                            запрос: 'Пример запроса на создание ресурса',
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: (data) => {
                            console.log(data)
                        },
                        error: (error) => {
                            console.log(error)
                        },
                    });
                    break;
            }
        },
    },
    beforeCreate() {
        $.ajax({
            url: '/api/groups',
            method: 'get',
            success: (data) => {
                this.groups = data.groups.data
            },
        });
        $.ajax({
            url: '/api/students?get=all',
            method: 'get',
            success: (data) => {
                this.allStudents = data.students;
            },
        });
    },
}
</script>
