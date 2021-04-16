<template>
    <div>
        <i class="far fa-trash-alt bg-danger text-white btn d-flex align-items-center"
           v-on:click="deleteGroup()"></i>

    </div>
</template>


<script>

export default {
    name: 'delete',
    props: ['id'],
    data: () => ({
        currentPage: false,
    }),
    methods: {
        deleteGroup() {
            $.ajax({
                url: '/api/groups/' + this.id,
                method: 'delete',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: (data) => {
                   if (this.$parent.$options.name === 'show') {
                       this.$parent.$options.methods.redrawHtml()
                   } else if (this.$parent.$options.name === 'index') {
                       $($(this.$el).parent()).parent().fadeOut("slow")
                   }
                }
            });
        },
    },
}
</script>

