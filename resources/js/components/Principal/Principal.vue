<template>
    <div>
        <cabecera />
        <router-view />
    </div>
</template>

<script>
import cabecera from '../Header/Header'
export default {
    name: 'Principal',
    components: {
        cabecera
    }
}
</script>

<style>

</style>