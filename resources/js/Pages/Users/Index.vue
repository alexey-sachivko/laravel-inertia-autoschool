<template>
    <Head>
        <title>Сотрудники</title>
    </Head>

    <div class="mb-4">
        <h2 class="text-3xl">Сотрудники</h2>
    </div>

    <div class="mb-4 flex justify-between items-center">
        <input v-model="search" type="text" placeholder="Поиск..." class="border px-2 py-2 rounded-lg" />
        <Link href="/users/create" class="inline-block rounded-lg py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white">Добавить сотрудника</Link>
    </div>

    <div class="bg-white overflow-auto rounded-lg">
        <table class="text-left w-full border-collapse">
            <thead>
                <tr>
                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">ФИО</th>
                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Дата рождения</th>
                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Контактные данные</th>
                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Должность</th>
                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users.data" :key="user.id" class="hover:bg-grey-lighter">
                    <td class="py-4 px-6 border-b border-grey-light">{{ user.surname }} {{ user.name }} {{ user.third_name }}</td>
                    <td class="py-4 px-6 border-b border-grey-light">{{ user.birthday }}</td>
                    <td class="py-4 px-6 border-b border-grey-light">{{ user.contact_info }}</td>
                    <td class="py-4 px-6 border-b border-grey-light">{{ user.rank }}</td>
                    <td class="py-4 px-4 border-b border-grey-light">
                        <div class="flex justify-center gap-x-3">
                            <Link :href="`/users/${user.id}/edit`" class="text-indigo-600 hover:text-indigo-900">
                                Редактировать
                            </Link>
                            <Link v-if="user.id != id" :href="`/users/${user.id}/delete`" method="delete" class="text-red-600 hover:text-red-900">
                                Удалить
                            </Link>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <pagination class="mt-6" :links="users.links" />
</template>

<script setup>
    import Pagination from "../../Shared/Pagination";
    import { ref, watch, computed } from "vue";
    import debounce from "lodash/debounce";
    import {Inertia} from "@inertiajs/inertia";
    import { usePage } from '@inertiajs/inertia-vue3'

    let props = defineProps({
        users: Object,
        filters: Object
    });

    let search = ref(props.filters.search);
    watch(search, debounce(function (value) {
        Inertia.get('/users', { search: value }, { preserveState: true, replace: true });
    }, 300));

    let id = computed(() => usePage().props.value.auth.user.id)
</script>
