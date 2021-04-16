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
            <div class="tab-pane fade" :class="{ 'active show': isActive('groups') }">

                <index v-bind:groups="groups"
                       v-bind:page="pagination.current_page"
                       v-on:showDetail="showDetailGroup"
                       v-on:editGroup="editDetailGroup">
                </index>

                <nav aria-label="Page navigation example" v-if="pagination.last_page > 1">
                    <ul class="pagination justify-content-center">
                        <li class="page-item"
                            v-bind:class="pagination.current_page <= 1 ? 'disabled' : ''">
                            <a class="page-link"
                               aria-label="Previous"
                               v-on:click.prevent="getGroups(pagination.current_page - 1)">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Предыдущая</span>
                            </a>
                        </li>
                        <li class="page-item" v-for="(page, index) in pages" v-bind:key="index"
                            v-bind:class="isCurrentPage(page) ? 'active' : ''">
                            <a class="page-link" v-on:click.prevent="getGroups(page)">
                                {{ page }}
                            </a>
                        </li>

                        <li class="page-item"
                            v-bind:class="pagination.current_page >= pagination.last_page ? 'disabled' : ''">
                            <a class="page-link"
                               aria-label="Next"
                               v-on:click.prevent="getGroups(pagination.current_page + 1)">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Следующая</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
            <div class="tab-pane fade"
                 :class="{ 'active show': isActive('subjects') }">
                {{ variables.titles.subjects }}
            </div>
            <div class="tab-pane fade"
                 :class="{ 'active show': isActive('students') }">
                {{ variables.titles.students }}
            </div>
            <div class="tab-pane fade" v-if="serviceTab"
                 :class="{ 'active show': isActive('service') }">

                <show v-if="components === 'show'" v-bind:group="serviceTab"></show>
                <edit v-else-if="components === 'edit'" v-bind:obj="serviceTab"></edit>
                <add v-else-if="components === 'new'"></add>
            </div>
        </div>
    </div>
</template>


<script>

import index from "./groups/index";
import show from "./groups/show";
import edit from "./groups/edit";
import add from "./groups/add";
import LangVariables from '../../lang/ru/crud.json'

export default {
    name: 'Tabs',
    components: {
        add,
        edit,
        index,
        show,
    },
    data: () => ({
        activeItem: 'groups',
        components: false,
        groups: [],
        serviceTab: false,
        variables: LangVariables,
        pagination: {
            'current_page': 1,
            'last_page': false
        },
        offset: 6
    }),
    methods: {
        // Переключение и определение текущей вкладки
        isActive(menuItem) {
            return this.activeItem === menuItem
        },
        setActive(menuItem) {
            this.activeItem = menuItem
        },
        getGroups(page) {

            $.ajax({
                url: '/api/groups?page=' + page,
                method: 'get',
                success: (data) => {
                    this.groups = data.groups.data

                    this.pagination.current_page = page;
                    this.pagination.last_page = data.pagination.last_page;
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
        isCurrentPage(page) {
            return this.pagination.current_page === page;
        }
    },
    watch: {
        // Отслеживание состояния вкладок
        activeItem: function (value) {
            // при переключении на соответствующую вкладку
            if (value === 'groups') {
                // это Ajax запрос
                this.getGroups(this.pagination.current_page);
            }

            if (value !== 'service') {
                this.serviceTab = false
            }
        },
    },
    created() {
        // Делаем Ajax запрос как только создан экземпляр
        this.getGroups(this.pagination.current_page);
    },
    computed: {
        pages() {
            let pages = [];
            let from = this.pagination.current_page - Math.floor(this.offset / 2);

            if (from < 1) {
                from = 1;
            }

            let to = from + this.offset - 1;

            if (to > this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            while (from <= to) {
                pages.push(from);
                from++;
            }
            return pages;
        }
    },
}
</script>
