<template>
    <Head>
        <title>Курсанты</title>
    </Head>

    <div class="mb-4">
        <h2 class="text-3xl">Курсанты</h2>
    </div>

    <div class="mb-4 flex justify-between items-center">
        <input v-model="search" type="text" placeholder="Поиск..." class="border px-2 py-2 rounded-lg" />
        <Link href="/students/create" class="inline-block rounded-lg py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white">Добавить курсанта</Link>
    </div>

    <div class="bg-white overflow-auto rounded-lg">
        <table class="text-left w-full border-collapse">
            <thead>
            <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">ФИО</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Дата рождения</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Контактные данные</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Группа</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="student in students.data" :key="student.id" class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">{{ student.surname }} {{ student.name }} {{ student.third_name }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ student.birthday }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ student.contact_info }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ student.group.group_number }}</td>
                <td class="py-4 px-4 border-b border-grey-light flex justify-center gap-x-3 ">
                    <Link :href="`/students/${student.id}/edit`" class="text-indigo-600 hover:text-indigo-900">
                        Редактировать
                    </Link>
                    <Link :href="`/students/${student.id}/delete`" method="delete" class="text-red-600 hover:text-red-900">
                        Удалить
                    </Link>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <pagination class="mt-6" :links="students.links" />
</template>

<script setup>
import Pagination from "../../Shared/Pagination";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";
import {Inertia} from "@inertiajs/inertia";

let props = defineProps({
    students: Object,
    filters: Object
});

let search = ref(props.filters.search);
watch(search, debounce(function (value) {
    Inertia.get('/students', { search: value }, { preserveState: true, replace: true });
}, 300));
</script>
