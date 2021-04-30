<template>
    <div>
        <div v-if="groups.length > 0">
            <table class="table table-bordered list">
                <thead>
                <tr>
                    <th>{{ variables.index.id }}</th>
                    <th>{{ variables.index.group }}</th>
                    <th>{{ variables.index.dataCreated }}</th>
                    <th>{{ variables.index.dataUpdated }}</th>
                    <th>{{ variables.index.availableActions }}</th>
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
                           v-on:click="editGroup({
                           group: {
                               'id':group.id,
                                name: group.name,
                                url:'/api/groups/'
                           }})">
                        </i>
                        <i class="far fa-eye bg-success text-white btn d-flex align-items-center"
                           v-on:click="showGroup(group.id)"></i>
                        <delete-item v-bind:deleteData="{id:group.id, url:'/api/groups/'}"></delete-item>
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
            {{ variables.index.groupEmpty }}
        </div>

        <div class="container-xl">
            <div class="row d-flex flex-row-reverse justify-content-between">
                <a class="btn btn-primary" v-on:click.prevent="addNew(addData)">
                    {{ variables.index.groupAddNew }}
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
    props: ['groups', 'pagination'],
    data: () => ({
        variables: langVariables,
        url: '/api/groups?page=',
        addData: {
            group: {
                name: 'Добавить новую группу',
                url: '/api/groups'
            },
            tabs: 'service',
            components: 'new'
        },
    }),
    methods: {
        showGroup(id) {
            if (id) {
                $.ajax({
                    url: '/api/groups/' + id,
                    method: 'get',
                    cache: false,
                    success: (data) => {
                        this.$emit('showDetail', data)
                    }
                });
            }
        },
        editGroup(obj) {
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
