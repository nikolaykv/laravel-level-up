<template>
    <div>
        <div v-if="groups.length > 0">
            <table class="table table-bordered list">
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
                <tr v-for="(group, key) in groups" v-bind:key="key">
                    <td class="align-middle">{{ group.id }}</td>
                    <td class="align-middle">{{ group.name }}</td>
                    <td class="align-middle" v-if="group.students.length > 0">
                       <p v-for="(student, key) in group.students"
                           v-bind:key="key"
                           class="mb-0">
                            {{student.user.full_name}}
                        </p>
                    </td>

                    <td v-else>
                        <p class="mb-0">{{variables.index.studentEmpty}}</p>
                    </td>
                    <td class="align-middle">{{ group.created_at }}</td>
                    <td class="align-middle">{{ group.updated_at }}</td>
                    <td class="align-middle">
                        <span class="d-xl-flex justify-content-xl-around">
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
                name: langVariables.index.groupAddNew,
                url: '/api/groups',
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
