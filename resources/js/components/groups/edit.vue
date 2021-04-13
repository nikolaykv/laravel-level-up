<template>
    <div>
        <div class="form-group row col-md-8 ml-auto mr-auto mt-4">
            <label for="group-name"
                   class="col-md-2 col-form-label text-md-right">
                Имя группы
            </label>

            <div class="col-md-10">
                <input id="group-name"
                       type="text"
                       class="form-control"
                       required
                       autofocus
                       v-model="group.name">

                <div class="alert alert-success mt-3" v-if="success">
                    {{ message }}
                </div>

                <span class="invalid-error" v-else>
                    <strong>
                        {{ message }}
                    </strong>
                </span>

            </div>


            <div class="offset-md-2 col-md-10 text-right mt-3">
                <button class="btn btn-primary" @click.prevent="updateGroup(obj)">
                    Изменить
                </button>
            </div>
        </div>
    </div>
</template>

<script>


export default {
    name: "edit",
    props: ['obj'],
    data: () => ({
        group: {
            name: ''
        },
        message: '',
        success: '',
    }),
    methods: {
        updateGroup(obj) {
            $.ajax({
                url: '/api/groups/' + obj.id,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: this.group.name,
                },
                method: 'patch',
                dataType: 'json',
                cache: false,
                success: (data) => {
                    if (data.success) {
                        this.success = data.success
                        this.message = data.message

                        $('.nav-link.active').text(data.name)

                    } else {
                        this.success = false
                        this.message = data.message
                    }
                },
            });
        },
    },
}
</script>
