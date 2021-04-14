<template>
    <div>
        <i class="far fa-trash-alt bg-danger text-white btn d-flex align-items-center" v-on:click="deleteGroup"></i>
    </div>
</template>

<script>
export default {
    name: 'delete',
    props: ['id'],
    methods: {
        deleteGroup() {
            $.ajax({
                url: '/api/groups/' + this.id,
                method: 'delete',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: (data) => {
                    this.$el.parentElement.parentElement.remove();
                }
            });
        },
    },
}
</script>

