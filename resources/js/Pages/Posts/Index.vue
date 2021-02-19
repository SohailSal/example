<template>
    <app-layout>
        <div v-if="$page.props.flash.success" class="bg-green-600 text-white">
            {{ $page.props.flash.success }}
        </div>
        <p> my name is Muhammad Haris and we are trying to understand the process of pull request across more than one team member</p>
        <div><h1>hello, {{hello}}</h1></div>
        <jet-button @click.native="create">Create</jet-button>        
        <div class="">
            <table class="shadow-lg border m-4 rounded-xl">
                <thead>
                    <tr class="bg-indigo-100">
                        <th class="py-2 px-4 border">Title</th>
                        <th class="py-2 px-4 border w-2/5">Body</th>
                        <th class="py-2 px-4 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in data" :key="item.id">
                        <td class="py-2 px-4 border">{{item.title}}</td>
                        <td class="py-2 px-4 border w-2/5">{{item.body}}</td>
                        <td class="py-2 px-4 border">
                            <inertia-link class="border bg-indigo-300 rounded-xl px-4 py-2 m-4" :href="route('posts.edit', item.id)">
                                <span>Edit</span>
                            </inertia-link>        
                            <button class="border bg-indigo-300 rounded-xl px-4 py-2 m-4" @click="destroy(item.id)">
                                <span>Delete</span>
                            </button>        
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <form>
            <div class="">
                <label>Select Post:</label>
                <select class='' v-model='post' >
                    <option disabled value="">Please select one</option>
                    <option v-for='dat in data' :value='dat.id' :key='dat.id'>{{ dat.title }}</option>
                </select>
            </div>

            <div class="">
                <label>Select Comment:</label>
                <select class=''>
                    <option v-for='data in data2' :value='data.id' :key='data.id'>{{ data.line }}</option>
                </select>
            </div>
            </form>
        </div>

        <div class="panel-body"> 
            <a class="border bg-indigo-300 rounded-xl px-4 py-2 m-4"  @click="addRow" >Add row</a>
            <table class="table border">
                <thead class="">
                    <tr>                            
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for='(user, index) in users' :key="user.id">                            
                        <td>
                        <input  v-model="user.name"  type="text" />
                        </td>
                        <td>
                        <input v-model="user.email" type="text" />
                        </td>
                        <td>
                        <input v-model="user.mobno"  type="text"/>
                        </td>
                        <td>
                        <a  @click="deleteRow(index)" class="border bg-indigo-300 rounded-xl px-4 py-2 m-4" >Delete</a>
                        </td>
                    </tr>                        
                </tbody>
            </table>
        </div>                        
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetButton from '@/Jetstream/Button'
//    import { Inertia } from '@inertiajs/inertia'
 
 export default {
        components: {
            AppLayout,
            JetButton,
        },

        props: ['data','data2','hello'],

        data(){
            return {
                post: 0,
                users: [{
                    name:'',email:'',mobno:''
                }]
            }
        },

        watch: {
            post: function() {
                this.$inertia.get(this.route('posts',  {post:this.post} ));
            },
        },

        methods: {

            addRow() {      
                this.users.push({name:'',email:'',mobno:''})
            },

            deleteRow(index){    
                this.users.splice(index,1);             
            },
            
            create() {
            this.$inertia.get(route('posts.create'))
            }, 

            destroy(id) {
            this.$inertia.delete(route('posts.destroy', id))
            },

        },
    }
</script>
