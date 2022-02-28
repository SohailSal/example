<template>
    <div>
        <ul v-for="child in children" :key="child.id">
            <li>{{child.id}} -- {{child.name}}</li>
            <li class="pl-10"><my-tree :children="child.children"></my-tree></li>
        </ul>
        <select v-for="child in children" :key="child.id">
            <option :value="child.id">{{ child.name }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        props: ['children'],
        name: 'my-tree',
    }
</script>