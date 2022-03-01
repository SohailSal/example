<template>
    <div>
        <select v-on:change="update">
            <option v-for="child in children" :key="child.id" :value="child.id">{{ child.name }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        props: ['children'],
        name: 'my-tree',
        methods: {
            update(event){
//                console.log(event.target.value)
                this.$emit('onSelect',event.target.value)
            },
        },

    }
</script>