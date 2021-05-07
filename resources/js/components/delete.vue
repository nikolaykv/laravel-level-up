<template>
    <div>
        <i class="far
                  fa-trash-alt
                  bg-danger
                  text-white
                  btn
                  d-flex
                  align-items-center"
           v-on:click="deleteItem(deleteData)">
        </i>
    </div>
</template>


<script>
export default {
    name: 'delete-item',
    props: ['deleteData'],
    data: () => ({
        currentPage: false,
    }),
    methods: {
        deleteItem(value) {
            $.ajax({
                url: value.url + value.id,
                method: 'delete',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: () => {
                    if (this.$parent.$options.name === 'show') {
                        this.$parent.$options.methods.redrawHtml()
                    } else if (this.$parent.$options.name === 'index') {
                        $($(this.$el).parent()).parent().parent().fadeOut('slow');
                    }
                }
            });
        },
    },
}
</script>

