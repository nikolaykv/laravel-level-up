<template>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link"
                   @click.prevent="setActive('groups')"
                   :class="{ active: isActive('groups') }">
                    {{ variables.titles.groups }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   @click.prevent="setActive('subjects')"
                   :class="{ active: isActive('subjects') }">
                    {{ variables.titles.subjects }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   @click.prevent="setActive('students')"
                   :class="{ active: isActive('students') }">
                    {{ variables.titles.students }}
                </a>
            </li>

            <li class="nav-item" v-if="serviceTab">
                <a class="nav-link"
                   @click.prevent="setActive('service')"
                   :class="{ active: isActive('service') }">
                    {{ serviceTab.name }}
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade" v-bind:class="{ 'active show': isActive('groups') }">
                <groupIndex
                    v-bind:groups="groups"
                    v-bind:pagination="pagination"
                    v-on:showDetail="showDetailGroup"
                    v-on:editGroup="editDetailGroup">
                </groupIndex>

            </div>
            <div class="tab-pane fade" v-bind:class="{ 'active show': isActive('subjects') }">
                <subjectIndex
                    v-bind:subjects="subjects"
                    v-bind:pagination="pagination">
                </subjectIndex>
            </div>
            <div class="tab-pane fade"
                 v-bind:class="{ 'active show': isActive('students') }">
                {{ variables.titles.students }}
            </div>
            <div class="tab-pane fade" v-if="serviceTab" v-bind:class="{ 'active show': isActive('service') }">

                <show v-if="components === 'show'" v-bind:group="serviceTab"></show>
                <edit v-else-if="components === 'edit'" v-bind:obj="serviceTab"></edit>
                <add v-else-if="components === 'new'"></add>
            </div>
        </div>
    </div>
</template>


<script>

import groupIndex from "./groups/index";
import show from "./groups/show";
import edit from "./groups/edit";
import add from "./groups/add";
import langVariables from '../../lang/ru/crud.json'

import subjectIndex from './subjects/index'

export default {
    name: 'Tabs',
    components: {
        add,
        edit,
        groupIndex,
        show,
        subjectIndex
    },
    data: () => ({
        activeItem: 'groups',
        components: false,
        groups: [],
        pagination: [],
        subjects: [],
        serviceTab: false,
        variables: langVariables,
    }),
    methods: {
        // Переключение и определение текущей вкладки
        isActive(menuItem) {
            return this.activeItem === menuItem
        },
        setActive(menuItem) {
            this.activeItem = menuItem
        },
        getGroups() {
            $.ajax({
                url: '/api/groups',
                method: 'get',
                success: (data) => {
                    this.groups = data.groups.data
                    this.pagination = data.pagination
                },
            });
        },

        getSubjects() {
            $.ajax({
                url: '/api/subjects',
                method: 'get',
                success: (data) => {
                    this.subjects = data.subjects.data
                    this.pagination = data.pagination
                },
            });
        },

        // Обработка данных из дочернего компонента
        showDetailGroup(group) {
            this.serviceTab = group // Принимаем данные
            this.components = 'show';
            this.activeItem = 'service' // Переключаем вкладку
        },
        editDetailGroup(obj) {
            this.serviceTab = obj;
            this.components = 'edit';
            this.activeItem = 'service';
        },
    },
    watch: {
        // Отслеживание состояния вкладок
        activeItem: function (value) {
            if (value !== 'service') {
                this.serviceTab = false
            }
        },
    },
    created() {
        // Делаем Ajax запрос как только создан экземпляр
        this.getGroups();
        this.getSubjects();
    },
}
</script>
