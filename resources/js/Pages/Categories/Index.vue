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
        <div>
            <table class="shadow-lg border m-4 rounded-xl">
                <thead>
                    <tr class="bg-indigo-100">
                        <th class="py-2 px-4 border">ID</th>
                        <th class="py-2 px-4 border">Name</th>
                        <!-- <th class="py-2 px-4 border">Parent ID</th> -->
                        <th class="py-2 px-4 border">Children</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in data" :key="item.id">
                        <td class="py-2 px-4 border">{{item.id}}</td>
                        <td class="py-2 px-4 border">{{item.name}}</td>
                        <!-- <td class="py-2 px-4 border">{{item.parent_id}}</td> -->
                        <td class="py-2 px-4 border">
                            <my-tree :children="item.children"></my-tree>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
				<tree-select v-model="selected" :treeData="data" :replaceFields="{ children:'children', title:'name', key:'id', value: 'id' }" showSearch="true" treeDefaultExpandAll="true"></tree-select>
            </div>
            <div>
                {{selected}}
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import MyTree from '@/Components/Tree'
	import TreeSelect from 'ant-design-vue/lib/tree-select'
	import 'ant-design-vue/dist/antd.css'
//    import { Head, Link } from '@inertiajs/inertia-vue3'

 export default {
        components: {
            AppLayout,
            MyTree,
            TreeSelect,
  //          Head,
  //          Link
        },
        props: ['data'],
        data(){
            return {
                selected: 'Select category',
            }
        },
        methods: {
        },
    }
</script>
