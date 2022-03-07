<template>
    <app-layout>
        <div class="">
            <form @submit.prevent="submit">
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
					<label for="name">Name</label>
                    <input type="text" v-model="form.name" class="pr-6 pb-8" name="name"/>
                    <div v-if="errors.name">{{ errors.name }}</div>
					<label for="parent_id">Parent ID</label>
                    <input type="text" v-model="form.parent_id" class="pr-6 pb-8" name="parent_id"/>
                    <div v-if="errors.parent_id">{{ errors.parent_id }}</div>
                </div>
                <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                    <button class="border bg-indigo-300 rounded-xl px-4 py-2 m-4" type="submit">Create Category</button>
                </div>
            </form>
            <my-drop :children="arr" @onSelect="updateParent"></my-drop>
            <div>
                {{vari}}
            </div>
            <div>
				<select v-model="valuee">
					<option v-for="item in arrr" :key="item.id" :value="item.id">{{item.name}}</option>
				</select>
            </div>
            <div>
				{{valuee}}
            </div>
            <div>
                <treeselect v-model="value" :max-height="150" :multiple="false" :options="arr" :normalizer="normalizer" v-on:select="treeChange" style="max-width:300px"/>
            </div>
            <div>
                <treeselect v-model="valuee" :max-height="150" :multiple="false" :options="arrr" :normalizer="normalizer" v-on:select="treeChange" style="max-width:300px"/>
            </div>
            <div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import MyDrop from '@/Components/Drop'
    import Treeselect from '@riophae/vue-treeselect'
    import '@riophae/vue-treeselect/dist/vue-treeselect.css'

    export default {
        components: {
            AppLayout,
            MyDrop,
            Treeselect,
        },

        props: {
            errors : Object,
            data: Array,
        },

        data() {
            return {
                form: {
                    name: null,
                    parent_id: null,
                },

                vari: 0,
                value: null,
                arr: this.data,
                valuee: 0,
                arrr: null,
                selected: [],

                normalizer(node) {
                    return {
                        label: node.name,
                    }
                },

            }
        },
        methods: {
            submit() {
                this.$inertia.post(this.route('categories.store'), this.form)
            },
            updateParent(vari){
                this.vari = vari
                var parent = this.data.filter(function(value){
                    return value.id == vari
                })
                this.selected.push(vari)

				var child = parent.map(function(item, index){
					return item.children
				})
				
				this.arrr = child[0]
				
					//~ var getChildren(key) {
					  //~ var x = source.filter(function(s){
						 //~ return s.k == key;
					  //~ });

					  //~ if( x.length && typeof x[0].children !== 'undefined') {
					   //~ return x[0].children;
					  //~ }

					  //~ return false;
					//~ }
					
//                console.log(typeof parent)
                console.log(JSON.stringify(this.arr))
                console.log(JSON.stringify(this.arrr))

                console.log(this.selected)
            },
            treeChange(node, instanceId){
                this.value = node.id
                alert(node.name + ' --- ' + this.value)
//                this.$inertia.get(route('categories', {'cat':this.value}))
            },
        },
    }
</script>
