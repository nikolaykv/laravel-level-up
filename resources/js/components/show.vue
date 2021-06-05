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
                <td class="align-middle">{{ data.subject.id }}</td>
                <td class="align-middle">{{ data.subject.name }}</td>

                <!-- Полное имя студента START -->
                <td class="align-middle" v-if="data.subject.student.length > 0">
                    <p class="mb-0" v-for="(student, key) in data.subject.student"
                       v-bind:key="key">
                        {{ student.user.full_name }}
                    </p>
                </td>

                <td class="align-middle" v-else>
                    {{ variables.index.studentEmpty }}
                </td>
                <!-- Полное имя студента END -->

                <!-- Академическая оценка студента START -->
                <td class="align-middle" v-if="data.subject.student.length > 0">
                    <p class="mb-0" v-for="(student, key) in data.subject.student"
                       v-bind:key="key">
                        {{ student.academic_grade }}
                    </p>
                </td>

                <td class="align-middle" v-else>
                    {{ variables.index.academicGradeEmpty }}
                </td>
                <!-- Академическая оценка студента END -->

                <td class="align-middle">{{ data.subject.created_at }}</td>
                <td class="align-middle">
                     <span class="d-xl-flex justify-content-xl-around">
                        <delete-item v-bind:deleteData="{id:data.subject.id, url:'/api/subjects/'}"></delete-item>
                     </span>
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

                <!-- Название предмета START -->
                <td v-if="data.student.subject"
                    class="align-middle">
                    {{ data.student.subject.name }}
                </td>
                <td v-else class="align-middle">
                    {{ variables.index.studentSubjectEmpty }}
                </td>
                <!-- Название предмета END -->

                <!-- Оценка студента по предмету START -->
                <td v-if="data.student.academic_grade"
                    class="text-center">
                    {{ data.student.academic_grade }}
                </td>
                <td v-else class="align-middle text-center">
                    {{ variables.index.academicGradeEmpty }}
                </td>
                <!-- Оценка студента по предмету END -->

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
