<template>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item" v-for="(item, index) in tabs" v-bind:key="index">
                <a class="nav-link" v-on:click.prevent="setActive(item)" v-bind:class="{active: isActive(item)}">
                    <span v-if="item === 'groups'">{{ variables.titles.groups }}</span>
                    <span v-else-if="item === 'subjects'">{{ variables.titles.subjects }}</span>
                    <span v-else>{{ variables.titles.students }}</span>
                </a>
            </li>
            <li class="nav-item" v-if="serviceTab">
                <a class="nav-link" v-on:click.prevent="setActive('service')"
                   v-bind:class="{ active: isActive('service') }">
                    <span v-if="serviceTab.hasOwnProperty('group')">{{ serviceTab.group.name }}</span>
                    <span v-else-if="serviceTab.hasOwnProperty('subject')">{{ serviceTab.subject.name }}</span>
                    <span v-else>{{serviceTab.student.user.full_name}}</span>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade" v-bind:class="{'active show': isActive('groups')}">
                <index-groups
                    v-bind:groups="groups"
                    v-bind:pagination="pagination.groups"
                    v-on:showDetail="showDetail"
                    v-on:edit="editDetail"
                    v-on:addNewItem="addNew">
                </index-groups>

            </div>
            <div class="tab-pane fade" v-bind:class="{'active show': isActive('subjects')}">
                <index-subjects
                    v-bind:subjects="subjects"
                    v-bind:pagination="pagination.subjects"
                    v-on:showDetail="showDetail"
                    v-on:edit="editDetail"
                    v-on:addNewItem="addNew">
                </index-subjects>
            </div>
            <div class="tab-pane fade" v-bind:class="{'active show': isActive('students')}">
                <index-students
                    v-bind:students="students"
                    v-bind:pagination="pagination.students"
                    v-on:showDetail="showDetail"
                    v-on:addNewItem="addNew">
                </index-students>
            </div>
            <div class="tab-pane fade" v-if="serviceTab" v-bind:class="{'active show': isActive('service')}">
                <show v-if="components === 'show'" v-bind:data="serviceTab"></show>
                <edit v-else-if="components === 'edit'" v-bind:obj="serviceTab"></edit>
                <add v-else-if="components === 'new'" v-bind:obj="serviceTab"></add>
            </div>
        </div>
    </div>
</template>


<script>
import add from "./add";
import show from "./show";
import edit from "./edit";

import indexGroups from "./groups/index";
import indexSubjects from './subjects/index'
import indexStudents from './students/index'

import langVariables from '../../lang/ru/crud.json'

export default {
    name: 'tabs',
    components: {
        add,
        edit,
        show,
        indexGroups,
        indexSubjects,
        indexStudents
    },
    data: () => ({
        variables: langVariables,
        activeItem: 'groups',
        subjects: [],
        groups: [],
        students: [],
        serviceTab: false,
        components: false,
        tabs: ['groups', 'subjects', 'students'],
        pagination: {"groups": [], "subjects": [], "students": []},
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
        getStudents() {
            $.ajax({
                url: '/api/students',
                method: 'get',
                success: (data) => {
                    this.students = data.students.data;
                    this.pagination.students = data.pagination;
                },
            });
        },

        // Обработка данных из дочернего компонента
        showDetail(data) {
            this.serviceTab = data
            this.components = 'show';
            this.activeItem = 'service' // Переключаем вкладку
        },
        editDetail(obj) {
            this.serviceTab = obj;
            this.components = 'edit';
            this.activeItem = 'service';
        },
        addNew(obj) {
            this.serviceTab = obj;
            this.components = obj.components
            this.activeItem = obj.tabs
        }
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
        this.getStudents()
    },
}
</script>
