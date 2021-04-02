<template>
    <app-layout>
        <div class="">
            <form @submit.prevent="submit">
                <input type="text" v-model="form.name" />
                <input type="file" v-on:change="onFileChange"/>
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                {{ form.progress.percentage }}%
                </progress>
                <button type="submit">Submit</button>
            </form>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
 
 export default {
        components: {
            AppLayout,
        },

        props: [],

        data(){
            return {
                form: this.$inertia.form({
                    name: null,
                    avatar: null,
                }),
            }
        },

        methods: {
            
            submit() {
//            this.$inertia.put(route('file'),this.form)
            this.form.post('file')
            }, 

            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.form.avatar = files[0];
            },

        },
    }
</script>
