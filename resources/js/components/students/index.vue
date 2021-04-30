<template>
    <div>
        <table class="table table-bordered list">
            <thead>
            <tr>
                <th>{{ variables.index.id }}</th>
                <th>{{ variables.index.student }}</th>
                <th>{{ variables.index.email }}</th>
                <th>{{ variables.index.group }}</th>
                <th>{{ variables.index.academicGrades }}</th>
                <th>{{ variables.index.dataCreated }}</th>
                <th>{{ variables.index.dataUpdated }}</th>
                <th>{{ variables.index.availableActions }}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="8">test</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

import langVariables from '../../../lang/ru/crud.json'
import pagination from "../pagination";

export default {
    name: 'index',
    props: ['students'],
    components: {pagination},
    data: () => ({
        variables: langVariables,
    })
}
</script>
