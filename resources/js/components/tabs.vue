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

                    <span v-if="serviceTab.hasOwnProperty('group')">
                        {{ serviceTab.group.name }}
                    </span>

                    <span v-else-if="serviceTab.hasOwnProperty('subject')">
                        {{ serviceTab.subject.name }}
                    </span>

                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade" v-bind:class="{ 'active show': isActive('groups') }">
                <index-groups
                    v-bind:groups="groups"
                    v-bind:pagination="pagination.groups"
                    v-on:showDetail="showDetail"
                    v-on:editGroup="editDetailGroup">
                </index-groups>

            </div>
            <div class="tab-pane fade" v-bind:class="{ 'active show': isActive('subjects') }">
                <index-subjects
                    v-bind:subjects="subjects"
                    v-bind:pagination="pagination.subjects"
                    v-on:showDetail="showDetail">
                </index-subjects>
            </div>
            <div class="tab-pane fade"
                 v-bind:class="{ 'active show': isActive('students') }">
                {{ variables.titles.students }}
            </div>
            <div class="tab-pane fade" v-if="serviceTab" v-bind:class="{ 'active show': isActive('service') }">

                <show v-if="components === 'show'" v-bind:data="serviceTab"></show>
                <edit-group v-else-if="components === 'edit'" v-bind:obj="serviceTab"></edit-group>
                <add-group v-else-if="components === 'new'"></add-group>
            </div>
        </div>
    </div>
</template>


<script>

import langVariables from '../../lang/ru/crud.json'

import indexGroups from "./groups/index";
import show from "./show";
import editGroup from "./groups/edit";
import addGroup from "./groups/add";

import indexSubjects from './subjects/index'

export default {
    name: 'tabs',
    components: {
        addGroup,
        editGroup,
        indexGroups,
        show,
        indexSubjects
    },
    data: () => ({
        activeItem: 'groups',
        components: false,
        groups: [],
        pagination: {
            "groups": [],
            "subjects": []
        },
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
                    this.pagination.groups = data.pagination
                },
            });
        },

        getSubjects() {
            $.ajax({
                url: '/api/subjects',
                method: 'get',
                success: (data) => {
                    this.subjects = data.subjects.data
                    this.pagination.subjects = data.pagination
                },
            });
        },

        // Обработка данных из дочернего компонента
        showDetail(data) {
            this.serviceTab = data
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
    updated() {
        this.getGroups();
        this.getSubjects();
    }
}
</script>
