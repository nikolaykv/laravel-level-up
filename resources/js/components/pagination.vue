<template>
    <div>
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item"
                    v-bind:class="paginationData.current_page <= 1 ? 'disabled' : ''">
                    <a class="page-link"
                       aria-label="Previous" v-on:click.prevent="fetchData(url, paginationData.current_page - 1)">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">{{ variables.pagination.previous }}</span>
                    </a>
                </li>


                <li class="page-item" v-for="(page, index) in pages" v-bind:key="index"
                    v-bind:class="isCurrentPage(page) ? 'active' : ''">
                    <a class="page-link" v-on:click.prevent="fetchData(url, page)">
                        {{ page }}
                    </a>
                </li>

                <li class="page-item"
                    v-bind:class="paginationData.current_page >= pagination.last_page ? 'disabled' : ''">
                    <a class="page-link"
                       aria-label="Next" v-on:click.prevent="fetchData(url, paginationData.current_page + 1)">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">{{ variables.pagination.next }}</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import langVariables from '../../lang/ru/crud.json'

export default {
    name: 'pagination',
    props: ['pagination', 'url'],
    data: () => ({
        variables: langVariables,
        paginationData: {
            'current_page': 1,
            'last_page': false
        },
        offset: 6
    }),
    methods: {
        fetchData(url, page) {
            $.ajax({
                url: url + page,
                method: 'get',
                success: (data) => {
                    if ('groups' in data) {
                        this.$parent.$parent.$data.groups = data.groups.data
                    } else if ('subjects' in data) {

                        this.$parent.$parent.$data.subjects = data.subjects.data
                    }
                    this.paginationData.current_page = page;
                    this.paginationData.last_page = data.pagination.last_page;
                },
            });
        },
        isCurrentPage(page) {
            return this.paginationData.current_page === page;
        },
    },
    computed: {
        pages() {
            let pages = [];
            let from = this.paginationData.current_page - Math.floor(this.offset / 2);
            if (from < 1) {
                from = 1;
            }
            let to = from + this.offset - 1;
            if (to > this.paginationData.last_page) {
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
