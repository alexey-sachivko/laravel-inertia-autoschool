<template>
    <Head>
        <title>Расписание групп</title>
    </Head>

    <div class="mb-4">
        <h2 class="text-3xl">Расписание групп</h2>
    </div>

    <div class="mb-4 flex justify-between items-center">
        <select v-model="search" class="p-2 leading-normal block w-60 border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" >
            <option selected disabled>Выберите группу:</option>
            <option v-for="group in groups" :key="group.id" :value="group.id">{{ group.group_number }}</option>
        </select>
        <Link href="/schedules/create" class="inline-block rounded-lg py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white">Добавить расписание группы</Link>
    </div>

    <div class="bg-white overflow-auto rounded-lg">
        <table class="text-left w-full border-collapse">
            <thead>
            <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Группа</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Время занятий</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">День недели</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="schedule in schedules.data" :key="schedule.id" class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">{{ schedule.group }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ schedule.class_time }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ schedule.day_of_week }}</td>
                <td class="py-4 px-4 border-b border-grey-light">
                    <div class=" flex justify-center gap-x-3 ">
                        <Link :href="`/schedules/${schedule.id}/edit`" class="text-indigo-600 hover:text-indigo-900">
                            Редактировать
                        </Link>
                        <Link :href="`/schedules/${schedule.id}/delete`" method="delete" class="text-red-600 hover:text-red-900">
                            Удалить
                        </Link>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <pagination class="mt-6" :links="schedules.links" />
</template>

<script setup>
import Pagination from "../../Shared/Pagination";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";
import {Inertia} from "@inertiajs/inertia";

let props = defineProps({
    schedules: Object,
    filters: Object,
    groups: Array
});

let search = ref(props.filters.search);
watch(search, debounce(function (value) {
    Inertia.get('/schedules', { search: value }, { preserveState: true, replace: true });
}, 300));
</script>
