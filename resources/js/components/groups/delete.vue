<template>
    <div>
        <i class="far fa-trash-alt bg-danger text-white btn d-flex align-items-center"
           v-on:click="deleteGroup(); replace();"></i>
    </div>
</template>


<script>
export default {
    name: 'delete',
    props: ['id'],
    data: () => ({
        htmlSuccess: '<div class="alert alert-success mt-3">Запись успешно удалена!</div>',
        replaceHtml: false
    }),
    methods: {
        deleteGroup() {
            $.ajax({
                url: '/api/groups/' + this.id,
                method: 'delete',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: () => {}
            });
        },
        replace() {
            this.replaceHtml = this.$parent.$el.getElementsByTagName('table')[0];
            $(this.replaceHtml).html(this.htmlSuccess)
        }
    },

}
</script>

