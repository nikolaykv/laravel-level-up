<template>
    <!-- Группа START-->
    <div v-if="obj.hasOwnProperty('group')">
        <div class="form-group row col-md-8 ml-auto mr-auto mt-4">
            <label for="group-name"
                   class="col-md-3 col-form-label text-md-right">
                {{ variables.add.name }}
            </label>

            <div class="col-md-9">
                <input id="group-name"
                       type="text"
                       class="form-control"
                       required
                       autofocus
                       v-model="formData.group.name">

                <span class="success-message" v-bind:class="isActive">
                    {{ variables.add.success }}
                </span>

                <span class="invalid-error" v-if="error">
                    {{ messages }}
                </span>
            </div>

            <div class="offset-md-2 col-md-10 text-right mt-3">
                <button class="btn btn-primary" v-on:click="addNew(obj)">
                    {{ variables.add.save }}
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
                {{ variables.add.subjectName }}
            </label>

            <div class="col-md-8">
                <input id="subject-name"
                       type="text"
                       class="form-control"
                       required
                       autofocus
                       v-model="formData.subject.name">

                <span class="invalid-error" v-if="error">
                    Ошибка
                </span>
            </div>
        </div>
        <!-- Имя END -->

        <!-- Студент START-->
        <div class="form-group row col-md-10 ml-auto mr-auto mt-4">
            <label for="student-name"
                   class="col-md-4 col-form-label text-md-right">
                {{ variables.add.subjectStudentFullName }}
            </label>

            <div class="col-md-8">
                <input id="student-name"
                       type="text"
                       class="form-control"
                       required
                       autofocus
                       v-model="formData.subject.student">

                <span class="invalid-error" v-if="error">
                    Ошибка
                </span>
            </div>
        </div>
        <!-- Студент END -->

        <!-- Оценка по предмету START-->
        <div class="form-group row col-md-10 ml-auto mr-auto mt-4">
            <label for="value"
                   class="col-md-4 col-form-label text-md-right">
                {{ variables.add.subjectStudentGrade }}
            </label>

            <div class="col-md-8">
                <input id="value"
                       type="text"
                       class="form-control"
                       required
                       autofocus
                       v-model="formData.subject.value">

                <span class="invalid-error" v-if="error">
                    Ошибка
                </span>
            </div>
        </div>
        <!-- Оценка по предмету END -->

        <div class="offset-md-2 col-md-10 text-right mt-3">
            <button class="btn btn-primary" v-on:click="addNew(obj)">
                {{ variables.add.save }}
            </button>
        </div>
    </div>
    <!-- Учебный предмет END -->
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
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            subject: {
                name: '',
                student: '',
                value: '',
                _token: $('meta[name="csrf-token"]').attr('content'),
            }
        },
        counter: 0,
        variables: langVariables,
        error: false,
        messages: '',
        isActive: 'd-none'
    }),
    methods: {
        addNew(obj) {
            switch (true) {
                case obj.hasOwnProperty('group'):
                    $.ajax({
                        url: obj.group.url,
                        method: 'post',
                        data: this.formData.group,
                        success: () => {
                            this.counter += 1;
                            this.isActive = 'd-block';
                            this.messages = '';

                            if (this.counter > 1) {
                                $('.success-message').text('Вы успешно добавили ещё одну запись!')
                            }

                        },
                        error: (error) => {
                            this.isActive = 'd-none';
                            this.error = true;
                            this.messages = error.responseJSON.errors.name[0];
                        },
                    });
                    break;
                case obj.hasOwnProperty('subject'):
                    $.ajax({
                        url: obj.subject.url,
                        method: 'post',
                        data: this.formData.subject,
                        success: (data) => {
                            console.log(data);
                        },
                        error: (error) => {
                            console.log(error);
                        },
                    });
                    break;
            }

            /*   $.ajax({
                   url: '/api/groups',
                   method: 'post',
                   data: {
                       _token: $('meta[name="csrf-token"]').attr('content'),
                       name: this.group.name,
                   },
                   success: () => {
                       this.counter += 1;
                       this.isActive = 'd-block';
                       this.messages = '';

                       if (this.counter > 1) {
                           $('.success-message').text('Вы успешно добавили ещё одну запись!')
                       }
                   },
                   error: (error) => {
                       this.isActive = 'd-none';
                       this.error = true;
                       this.messages = error.responseJSON.errors.name[0];
                   },
               });*/
        },
    }
}
</script>

<style scoped="scoped">
.success-message {
    color: #1d643b;
}
</style>
