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
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade"
                 :class="{ 'active show': isActive('groups') }">
                Группы
            </div>
            <div class="tab-pane fade"
                 :class="{ 'active show': isActive('subjects') }">
                Предметы
            </div>
            <div class="tab-pane fade"
                 :class="{ 'active show': isActive('students') }">
                Студенты
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'Tabs',
    data: () => ({
        activeItem: 'groups'
    }),
    methods: {
        isActive(menuItem) {
            return this.activeItem === menuItem
        },
        setActive(menuItem) {
            this.activeItem = menuItem
        }
    }
}
</script>
