<template>
    <Head title="Login"/>

    <main class="grid place-items-center min-h-screen">
        <section class="bg-white p-8 rounded-xl max-w-md border mx-auto">
            <h1 class="text-3xl mb-6">Вход</h1>

            <form @submit.prevent="submit">
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="username">Логин</label>
                    <input v-model="form.username" type="text" class="border  p-2 w-full rounded" name="username" id="username">
                    <div v-if="form.errors.username" v-text="form.errors.username" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="password">Пароль</label>
                    <input v-model="form.password" type="password" class="border  p-2 w-full rounded" name="password" id="password">
                    <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="mb-6">
                    <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500" :disabled="form.processing">Войти</button>
                </div>
            </form>
        </section>
    </main>
</template>

<script>
    export default {
        layout: null
    }
</script>

<script setup>
    import {useForm} from "@inertiajs/inertia-vue3";

    let form = useForm({
        username: 'admin',
        password: 'mrap8f'
    })

    let submit = () => {
        form.post('/login');
    }
</script>

<style scoped>

</style>
