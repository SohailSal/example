<template>
    <app-layout>
        <div v-if="$page.props.flash.success" class="bg-green-600 text-white">
            {{ $page.props.flash.success }}
        </div>
        <div>
            <inertia-link class="border bg-indigo-300 rounded-xl px-4 py-2 m-4" :href="route('categories.create')">
                <span>Create</span>
            </inertia-link>        
        </div>
        <div class="">
            <table class="shadow-lg border m-4 rounded-xl">
                <thead>
                    <tr class="bg-indigo-100">
                        <th class="py-2 px-4 border">ID</th>
                        <th class="py-2 px-4 border">Name</th>
                        <th class="py-2 px-4 border">Parent ID</th>
                        <th class="py-2 px-4 border">Children</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in data" :key="item.id">
                        <td class="py-2 px-4 border">{{item.id}}</td>
                        <td class="py-2 px-4 border">{{item.name}}</td>
                        <td class="py-2 px-4 border">{{item.parent_id}}</td>
                        <td class="py-2 px-4 border">
                            <ul v-for="child in item.children" :key="child.id">
                                <li>{{child.id}} -- {{child.name}}</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <sol-label>Hello</sol-label>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
//    import { Head, Link } from '@inertiajs/inertia-vue3'
    import SolLabel from '@/Components/Label'

 export default {
        components: {
            AppLayout,
            SolLabel,
  //          Head,
  //          Link
        },
        props: ['data'],
        data(){
            return {
                
            }
        },
        methods: {
        },
    }
</script>