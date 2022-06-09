<template>
    <Head>
        <title>Автомобили</title>
    </Head>

    <div class="mb-4">
        <h2 class="text-3xl">Автомобили</h2>
    </div>

    <div class="mb-4 flex justify-between items-center">
        <select v-model="search" class="p-2 leading-normal block w-60 border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" >
            <option selected disabled>Выберите марку автомобиля:</option>
            <option v-for="auto in autos.data" :key="auto.id" :value="auto.brand">{{ auto.brand }}</option>
        </select>
        <Link href="/autos/create" class="inline-block rounded-lg py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white">Добавить автомобиль</Link>
    </div>

    <div class="bg-white overflow-auto rounded-lg">
        <table class="text-left w-full border-collapse">
            <thead>
            <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Марка</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Модель</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Гос.номер</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Сотрудник</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="auto in autos.data" :key="auto.id" class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">{{ auto.brand }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ auto.model }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ auto.registration_number }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ auto.user }}</td>
                <td class="py-4 px-4 border-b border-grey-light flex justify-center gap-x-3 ">
                    <Link :href="`/autos/${auto.id}/edit`" class="text-indigo-600 hover:text-indigo-900">
                        Редактировать
                    </Link>
                    <Link :href="`/autos/${auto.id}/delete`" method="delete" class="text-red-600 hover:text-red-900">
                        Удалить
                    </Link>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <pagination class="mt-6" :links="autos.links" />
</template>

<script setup>
import Pagination from "../../Shared/Pagination";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";
import {Inertia} from "@inertiajs/inertia";

let props = defineProps({
    autos: Object,
    filters: Object
});

let search = ref(props.filters.search);
watch(search, debounce(function (value) {
    Inertia.get('/autos', { search: value }, { preserveState: true, replace: true });
}, 300));
</script>
