<template>
    <div>
        <div>
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
                       <i class="far fa-edit bg-primary text-white btn d-flex align-items-center"></i>
                        <i class="far fa-eye bg-success text-white btn d-flex align-items-center"></i>
                        <i class="far fa-trash-alt bg-danger text-white btn d-flex align-items-center"></i>

                    </td>
                </tr>
                </tbody>
            </table>


            <div class="container-xl">
                <div class="row d-flex flex-row-reverse justify-content-between">
                    <a class="btn btn-primary">
                        {{ variables.subjects.add_new }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LangVariables from '../../../lang/ru/crud.json'
export default {
    name: 'index',
    props: ['subjects'],
    data: () => ({
        variables: LangVariables,
    }),
}
</script>
