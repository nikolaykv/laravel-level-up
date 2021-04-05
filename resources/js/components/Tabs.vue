<template>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link"
                   @click.prevent="setActive('groups')"
                   :class="{ active: isActive('groups') }">
                    Учебные группы
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   @click.prevent="setActive('subjects')"
                   :class="{ active: isActive('subjects') }">
                    Учебные предметы
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   @click.prevent="setActive('students')"
                   :class="{ active: isActive('students') }">
                    Студенты
                </a>
            </li>

            <li class="nav-item" v-if="sericeTab">
                <a class="nav-link"
                   @click.prevent="setActive('service')"
                   :class="{ active: isActive('service') }">
                    {{ sericeTab.name }}
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade" :class="{ 'active show': isActive('groups') }">
                <index v-bind:groups="groups" v-on:showDetail="showDetailGroup"></index>
            </div>
            <div class="tab-pane fade"
                 :class="{ 'active show': isActive('subjects') }">
                Предметы
            </div>
            <div class="tab-pane fade"
                 :class="{ 'active show': isActive('students') }">
                Студенты
            </div>
            <div class="tab-pane fade" v-if="sericeTab"
                 :class="{ 'active show': isActive('service') }">
                <show v-bind:group="sericeTab"></show>
            </div>


        </div>
    </div>
</template>

<script>

import index from "./groups/index";
import show from "./groups/show";

export default {
    name: 'Tabs',
    components: {
        index,
        show,
    },
    data: () => ({
        activeItem: 'groups',
        groups: [],
        sericeTab: false,
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
                dataType: 'json',
                cache: false,
                success: (data) => {
                    this.groups = data.groups
                }
            });
        },

        // Обработка данных из дочернего компонента
        showDetailGroup(group) {
            this.sericeTab = group // Принимаем данные
            this.activeItem = 'service' // Переключаем вкладку
        }
    },
    watch: {
        // Отслеживание состояния вкладок
        activeItem: function (value) {
            // пр переключении на соответствующую вкладку
            if (value === 'groups') {
                // это Ajax запрос
                this.getGroups();
            }

            if (value !== 'service') {
                this.sericeTab = false
            }
        },
    },
    created() {
        // Делаем Ajax запрос как только создан экземпляр
        this.getGroups();
    }
}
</script>
