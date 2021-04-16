<template>
    <div>
        <table class="table table-bordered list">
            <thead>
            <tr>
                <th>{{ variables.index.id }}</th>
                <th>{{ variables.index.name }}</th>
                <th>{{ variables.index.created }}</th>
                <th>{{ variables.index.updated }}</th>
                <th>{{ variables.index.available_actions }}</th>
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
                    <delete v-bind:id="group.id">
                    </delete>
                </td>
            </tr>

            </tbody>
        </table>
        <div class="container-xl">
            <div class="row d-flex flex-row-reverse justify-content-between">
                <a class="btn btn-primary" v-on:click.prevent="addNew('new')">
                    {{ variables.index.add_new }}
                </a>
            </div>
        </div>
    </div>
</template>

<script>

import LangVariables from '../../../lang/ru/crud.json'
import Delete from "./delete";

export default {
    name: 'index',
    components: {Delete},
    props: ['groups', 'page'],
    data: () => ({
        variables: LangVariables,
    }),
    methods: {
        showGroup(id) {
            if (id) {
                $.ajax({
                    url: '/api/groups/' + id,
                    method: 'get',
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
        },
        addNew(str) {
            this.$parent.$data.activeItem = 'service';
            this.$parent.$data.components = str;
            this.$parent.$data.serviceTab = {name: 'Добавить новую группу'};
        }
    },
}
</script>
