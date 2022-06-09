<template>
    <Link
        class="flex items-center text-white opacity-75 hover:opacity-100 py-4 px-4 nav-item"
        :class="{'opacity-100 active': active }"
    >
        <slot />
    </Link>
</template>

<script>
export default {
    name: "NavItem",
    props: {
        active: Boolean
    }
}
</script>

<style scoped>
    .nav-item:hover {
        background: #2563eb;
    }

    .active {
        background: #2563eb;
    }
</style>
