<template>
    <Head>
        <title>{{ group.group_number }}</title>
    </Head>
    <h1 class="mb-4 text-3xl font-bold">
        <Link class="text-blue-500 hover:text-blue-600" href="/groups">Группы</Link>
        <span class="text-blue-500 font-bold"> /</span> {{ group.group_number }}
    </h1>

    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
        <form @submit.prevent="update">
            <div class="flex flex-wrap -mr-6 p-8">
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="group_number" class="mb-2 block text-gray-700 select-none">Номер группы:</label>
                    <input id="group_number" type="text" v-model="form.group_number" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.group_number" v-text="$page.props.errors.group_number" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="date_start" class="mb-2 block text-gray-700 select-none">Дата начала обучения:</label>
                    <input id="date_start" type="text" v-model="form.date_start" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.date_start" v-text="$page.props.errors.date_start" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="date_end" class="mb-2 block text-gray-700 select-none">Дата окончания обучения:</label>
                    <input id="date_end" type="text" v-model="form.date_end" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.date_end" v-text="$page.props.errors.date_end" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="description" class="mb-2 block text-gray-700 select-none">Описание:</label>
                    <input id="description" type="text" v-model="form.description" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.description" v-text="$page.props.errors.description" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="user" class="mb-2 block text-gray-700 select-none">Сотрудник:</label>
                    <select id="user" v-model="form.user_id" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" >
                        <option v-for="user in users" :key="user.id" :value="user.id">{{ user.surname }} {{ user.name }} {{ user.third_name }}</option>
                    </select>
                    <div v-if="form.errors.user_id" v-text="$page.props.errors.user_id" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="category" class="mb-2 block text-gray-700 select-none">Категория:</label>
                    <select id="category" v-model="form.category_id" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" >
                        <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.category_name }}</option>
                    </select>
                    <div v-if="form.errors.category_id" v-text="$page.props.errors.category_id" class="text-red-500 text-xs mt-1"></div>
                </div>
            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                <loading-button :loading="form.processing" class="btn-indigo" type="submit">Редактировать группу</loading-button>
            </div>
        </form>
    </div>

    <h1 class="mt-8 mb-2 text-2xl font-bold">Курсанты</h1>
    <div v-if="students.length > 0" class="bg-white overflow-auto rounded-lg">
        <table class="text-left w-full border-collapse">
            <thead>
            <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">ФИО</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Дата рождения</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Контактные данные</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="student in students" :key="student.id" class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">{{ student.surname }} {{ student.name }} {{ student.third_name }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ student.birthday }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ student.contact_info }}</td>
                <td class="py-4 px-4 border-b border-grey-light flex justify-center gap-x-3 ">
                    <Link :href="`/students/${student.id}/edit`" class="text-indigo-600 hover:text-indigo-900">
                        Редактировать
                    </Link>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <p v-else class="text-lg">Курсанты не найдены</p>
</template>

<script>
import LoadingButton from "../../Shared/LoadingButton";

export default {
    name: "Edit",
    components: {
        LoadingButton
    },
    data() {
        return {
            form: this.$inertia.form({
                group_number: this.group.group_number,
                date_start: this.group.date_start,
                date_end: this.group.date_end,
                description: this.group.description,
                user_id: this.group.user_id,
                category_id: this.group.category_id,
            })
        }
    },
    props: {
        group: Object,
        users: Array,
        categories: Array,
        students: Array
    },
    methods: {
        update() {
            this.form.put(`/groups/${this.group.id}`)
        }
    }
}
</script>

<style scoped>

</style>
