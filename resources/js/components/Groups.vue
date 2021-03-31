<template>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#groups" data-toggle="tab">Учебные группы</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#subjects" data-toggle="tab">Учебные предметы</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#students" data-toggle="tab">Студенты</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade active show" id="groups">
                Группы
            </div>
            <div class="tab-pane fade" id="subjects">
                Предметы
            </div>
            <div class="tab-pane fade" id="students">
                Студенты
            </div>
        </div>
    </div>
</template>

<script>


export default {
    name: 'Groups',
}
</script>
