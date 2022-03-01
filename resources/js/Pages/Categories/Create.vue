<template>
    <app-layout>
        <div class="">
            <form @submit.prevent="submit">
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <input type="text" v-model="form.name" class="pr-6 pb-8 w-full lg:w-1/2" label="name"/>
                    <div v-if="errors.name">{{ errors.name }}</div>
                    <input type="text" v-model="form.parent_id" class="pr-6 pb-8 w-full lg:w-1/2" label="parent_id"/>
                    <div v-if="errors.parent_id">{{ errors.parent_id }}</div>
                </div>
                <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                    <button class="border bg-indigo-300 rounded-xl px-4 py-2 m-4" type="submit">Create Category</button>
                </div>
            </form>
            <my-drop :children="data"></my-drop>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import MyDrop from '@/Components/Drop'

    export default {
        components: {
            AppLayout,
            MyDrop,
        },

        props: {
            errors : Object,
            data: Object,
        },

        data() {
            return {
                form: {
                    name: null,
                    parent_id: null,
                },
            }
        },
        methods: {
            submit() {
            this.$inertia.post(this.route('categories.store'), this.form)
            },
        },
    }
</script>