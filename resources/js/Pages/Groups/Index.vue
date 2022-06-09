<template>
    <Head>
        <title>Группы</title>
    </Head>

    <div class="mb-4">
        <h2 class="text-3xl">Группы</h2>
    </div>

    <div class="mb-4 flex justify-between items-center">
        <div></div>
        <Link href="/groups/create" class="inline-block rounded-lg py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white">Добавить группу</Link>
    </div>

    <div class="bg-white overflow-auto rounded-lg">
        <table class="text-left w-full border-collapse">
            <thead>
            <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Номер группы</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Начало обучения</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Конец обучения</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Категория</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="group in groups.data" :key="group.id" class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">{{ group.group_number }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ group.date_start }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ group.date_end }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ group.category }}</td>
                <td class="py-4 px-4 border-b border-grey-light">
                    <div class=" flex justify-center gap-x-3 ">
                        <Link :href="`/groups/${group.id}/edit`" class="text-indigo-600 hover:text-indigo-900">
                            Редактировать
                        </Link>
                        <Link :href="`/groups/${group.id}/delete`" method="delete" class="text-red-600 hover:text-red-900">
                            Удалить
                        </Link>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <pagination class="mt-6" :links="groups.links"/>
</template>

<script setup>
import Pagination from "../../Shared/Pagination";

let props = defineProps({
    groups: Object
});
</script>
