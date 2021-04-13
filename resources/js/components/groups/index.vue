<template>
    <div>
        <table class="table table-bordered list">
            <thead>
            <tr>
                <th>{{ variables.groups.id }}</th>
                <th>{{ variables.groups.name }}</th>
                <th>{{ variables.groups.created }}</th>
                <th>{{ variables.groups.updated }}</th>
                <th>{{ variables.groups.available_actions }}</th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="group in groups" v-bind:key="group.id">
                <td>{{ group.id }}</td>
                <td>{{ group.name }}</td>
                <td>{{ group.created_at }}</td>
                <td>{{ group.updated_at }}</td>
                <td class="d-xl-flex justify-content-xl-around">
                    <i class="far fa-edit bg-primary text-white btn d-flex align-items-center"
                       v-on:click="editGroup({'id':group.id, name: group.name})"></i>
                    <i class="far fa-eye bg-success text-white btn d-flex align-items-center"
                       v-on:click="showGroup(group.id)"></i>
                    <i class="far fa-trash-alt bg-danger text-white btn d-flex align-items-center"></i>
                </td>
            </tr>

            </tbody>
        </table>
        <div class="container-xl">
            <div class="row d-flex flex-row-reverse justify-content-between">
                <a class="btn btn-primary" href="#">
                    {{ variables.groups.add_new }}
                </a>
            </div>
        </div>
    </div>
</template>

<script>

import LangVariables from '../../../lang/ru/crud.json'

export default {
    name: 'index',
    props: ['groups'],
    data: () => ({
        variables: LangVariables,
    }),
    methods: {
        showGroup(id) {
            if (id) {
                $.ajax({
                    url: '/api/groups/' + id,
                    method: 'get',
                    dataType: 'json',
                    cache: false,
                    success: (data) => {
                        this.$emit('showDetail', data.group)
                    }
                });
            }
        },
        editGroup(obj) {
            if (obj) {
                this.$emit('editGroup', obj);
            }
        }
    },
}
</script>
