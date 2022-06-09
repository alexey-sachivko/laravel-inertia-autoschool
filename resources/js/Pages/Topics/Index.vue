<template>
    <Head>
        <title>Темы</title>
    </Head>

    <div class="mb-4">
        <h2 class="text-3xl">Темы</h2>
    </div>

    <div class="mb-4 flex justify-between items-center">
        <select v-model="search" class="p-2 leading-normal block w-60 border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" >
            <option selected disabled>Выберите категорию:</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.category_name }}</option>
        </select>
        <Link href="/topics/create" class="inline-block rounded-lg py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white">Добавить тему</Link>
    </div>

    <div class="bg-white overflow-auto rounded-lg">
        <table class="text-left w-full border-collapse">
            <thead>
            <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Тема</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Категория</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="topic in topics.data" :key="topic.id" class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">{{ topic.topic_name }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ topic.category }}</td>
                <td class="py-4 px-4 border-b border-grey-light">
                    <div class=" flex justify-center gap-x-3 ">
                        <Link :href="`/topics/${topic.id}/edit`" class="text-indigo-600 hover:text-indigo-900">
                            Редактировать
                        </Link>
                        <Link :href="`/topics/${topic.id}/delete`" method="delete" class="text-red-600 hover:text-red-900">
                            Удалить
                        </Link>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <pagination class="mt-6" :links="topics.links" />
</template>

<script setup>
import Pagination from "../../Shared/Pagination";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";
import {Inertia} from "@inertiajs/inertia";

let props = defineProps({
    topics: Object,
    filters: Object,
    categories: Array
});

let search = ref(props.filters.search);
watch(search, debounce(function (value) {
    Inertia.get('/topics', { search: value }, { preserveState: true, replace: true });
}, 300));
</script>
