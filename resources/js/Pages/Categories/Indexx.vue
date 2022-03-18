<template>
    <app-layout>
        <div v-if="$page.props.flash.success" class="bg-green-600 text-white">
            {{ $page.props.flash.success }}
        </div>
        <div>
            <my-drop :children="data" @onSelect="updateParent"></my-drop>
        </div>
        <div>
            <my-drop v-for="item in selected" :key="item.id" :children="item" @onSelect="updateParent"></my-drop>
        </div>
        <!-- <div>
            <my-drop :children="selected[0]" @onSelect="updateParent"></my-drop>
        </div>
        <div>
            <my-drop :children="selected[1]" @onSelect="updateParent"></my-drop>
        </div> -->
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
        props: ['data'],
        data(){
            return {
                selected: [],
            }
        },
        methods: {
            updateParent(vari){
                var parent = null
                if(this.selected.length == 0) {
                    parent = this.data.filter(function(value){
                        return value.id == vari
                    })
                }
                else {
                    parent = this.selected[this.selected.length - 1].filter(function(value){
                        return value.id == vari
                    })
                }
				var child = parent.map(function(item, index){
					return item.children
				})
				this.selected.push(child[0])
				
 //               console.log(child[0][0].id)
console.log(vari)
                // for (let i = 0; i < this.selected.length; i++) {
                //     console.log(JSON.stringify(this.selected[i]))
                // }
            },
//             updateParent2(vari){

//                 var parent = this.selected[0].filter(function(value){
//                     return value.id == vari
//                 })
// 				var child = parent.map(function(item, index){
// 					return item.children
// 				})
// 				this.selected.push(child[0])
				
//  //               console.log(child[0][0].id)
// console.log(vari)
//                 // for (let i = 0; i < this.selected.length; i++) {
//                 //     console.log(JSON.stringify(this.selected[i]))
//                 // }
//             },
        },
    }
</script>
