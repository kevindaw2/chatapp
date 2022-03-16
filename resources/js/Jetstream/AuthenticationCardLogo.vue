<template>
    <Link :href="'/'">
        <img src="/public/images/logo.jpg" alt="" style="width: 320px; height: 150px">
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
    })
</script>
