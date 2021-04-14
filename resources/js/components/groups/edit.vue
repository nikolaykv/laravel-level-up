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

              <span class="invalid-error" v-if="error">
                    <strong>
                        {{ messages }}
                    </strong>
                </span>


                <div class="alert alert-success mt-3" v-bind:class="isActive">
                    Успешно обновлено
                </div>

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
        error: false,
        messages: '',
        isActive: 'd-none'
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
                success: (data) => {
                    this.isActive = 'd-block';
                    $('.nav-link.active').text(data.name);
                    this.messages = '';
                },
                error: (error) => {
                  this.isActive = 'd-none';
                    this.error = true;
                    this.messages = error.responseJSON.errors.name[0];
                }
            });
        },
    },
}
</script>

<style scoped="scoped">
.invalid-error {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 80%;
    color: #e3342f;
}
</style>
