<template>
    <div class="flex bg-gray-100">
        <aside class="h-screen w-2/12 shadow-xl bg-blue-500">
            <div class="p-6">
                <p class="text-white text-center text-2xl font-bold hover:text-gray-300">Автошкола</p>
            </div>


            <AdminNav v-if="rank == 'admin'" />
        </aside>
        <main class="w-full flex flex-col h-screen overflow-y-auto">
            <header class="w-full flex justify-between items-center bg-white py-6 px-6">
                <div></div>
                <div class="flex justify-between gap-x-3">
                    <p class="">Добро пожаловать, {{ user }}</p>
                    <Link href="/logout" method="post" class="hover:text-blue-400">Выйти</Link>
                </div>
            </header>
            <section class="w-full p-6">
                <notification />
                <slot />
            </section>
        </main>
    </div>
</template>

<script>
import AdminNav from "./AdminNav";
import Notification from "./Notification";

export default {
    name: "Layout",
    components: {AdminNav, Notification},
    computed: {
        user() {
            return this.$page.props.auth.user.username;
        },
        rank() {
            return this.$page.props.auth.user.rank;
        }
    }
}
</script>

<style scoped>

</style>
