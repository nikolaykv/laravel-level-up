<template>
    <div class="form-group row col-md-8 ml-auto mr-auto mt-4">
        <label for="group-name"
               class="col-md-3 col-form-label text-md-right">
            {{ variables.add.name }}
        </label>

        <div class="col-md-9">
            <input id="group-name"
                   type="text"
                   class="form-control"
                   required
                   autofocus
                   v-model="group.name">

            <span class="success-message" v-bind:class="isActive">{{ variables.add.success }}</span>
            <span class="invalid-error" v-if="error">{{ messages }}</span>

        </div>
        <div class="offset-md-2 col-md-10 text-right mt-3">
            <button class="btn btn-primary" v-on:click="addNew">
                {{ variables.add.save }}
            </button>
        </div>
    </div>
</template>

<script>
import LangVariables from '../../../lang/ru/crud.json'

export default {
    name: 'add-group',
    data: () => ({
        group: {
            name: ''
        },
        counter: 0,
        variables: LangVariables,
        error: false,
        messages: '',
        isActive: 'd-none'
    }),
    methods: {
        addNew() {
            $.ajax({
                url: '/api/groups',
                method: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: this.group.name,
                },
                success: (data) => {
                    this.counter += 1;
                    this.isActive = 'd-block';
                    this.messages = '';

                    if (this.counter > 1) {
                        $('.success-message').text('Вы успешно добавили ещё одну запись!')
                    }
                },
                error: (error) => {
                    this.isActive = 'd-none';
                    this.error = true;
                    this.messages = error.responseJSON.errors.name[0];
                },
            });
        },
    }
}
</script>

<style scoped="scoped">
.success-message {
    color: #1d643b;
}
</style>
