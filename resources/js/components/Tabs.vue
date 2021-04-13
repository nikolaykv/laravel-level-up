<template v-on>
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
                       v-on:showDetail="showDetailGroup"
                       v-on:editGroup="editDetailGroup">
                </index>
            </div>
            <div class="tab-pane fade"
                 :class="{ 'active show': isActive('subjects') }">
                Предметы
            </div>
            <div class="tab-pane fade"
                 :class="{ 'active show': isActive('students') }">
                Студенты
            </div>
            <div class="tab-pane fade" v-if="serviceTab"
                 :class="{ 'active show': isActive('service') }">

                <show v-if="components === 'show'" v-bind:group="serviceTab"></show>
                <edit v-else-if="components === 'edit'" v-bind:obj="serviceTab"></edit>
            </div>
        </div>

    </div>
</template>


<script>

import index from "./groups/index";
import show from "./groups/show";
import edit from "./groups/edit";

export default {
    name: 'Tabs',
    components: {
        edit,
        index,
        show,
    },
    data: () => ({
        activeItem: 'groups',
        components: false,
        groups: [],
        serviceTab: false,
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
            // пр переключении на соответствующую вкладку
            if (value === 'groups') {
                // это Ajax запрос
                this.getGroups();
            }

            if (value !== 'service') {
                this.serviceTab = false
            }
        },
    },
    created() {
        // Делаем Ajax запрос как только создан экземпляр
        this.getGroups();
    },
}
</script>
