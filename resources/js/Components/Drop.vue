<template>
    <div>
        <select>
            <option v-for="child in children" :key="child.id" :value="child.id">{{ child.name }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        props: ['children'],
        name: 'my-tree',
    }
</script>