<template>
    <Head :title="`${ form.brand } ${ form.model } | ${ form.registration_number }`" />
    <h1 class="mb-4 text-3xl font-bold">
        <Link class="text-blue-500 hover:text-blue-600" href="/autos">Автомобили</Link>
        <span class="text-blue-500 font-bold"> /</span> {{ form.brand }} {{ form.model }} | {{ form.registration_number }}
    </h1>

    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
        <form @submit.prevent="update">
            <div class="flex flex-wrap -mr-6 p-8">
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="brand" class="mb-2 block text-gray-700 select-none">Марка:</label>
                    <input id="brand" type="text" v-model="form.brand" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.brand" v-text="$page.props.errors.brand" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="model" class="mb-2 block text-gray-700 select-none">Модель:</label>
                    <input id="model" type="text" v-model="form.model" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.model" v-text="$page.props.errors.model" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="registration_number" class="mb-2 block text-gray-700 select-none">Регистрационный номер:</label>
                    <input id="registration_number" type="text" v-model="form.registration_number" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.registration_number" v-text="$page.props.errors.registration_number" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="year_of_manufacture" class="mb-2 block text-gray-700 select-none">Год производства:</label>
                    <input id="year_of_manufacture" type="text" v-model="form.year_of_manufacture" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.year_of_manufacture" v-text="$page.props.errors.year_of_manufacture" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="type" class="mb-2 block text-gray-700 select-none">Тип:</label>
                    <select id="type" v-model="form.type" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" >
                        <option value="легковой">Легковой</option>
                        <option value="грузовой">Грузовой</option>
                        <option value="автобус">Автобус</option>
                    </select>
                    <div v-if="form.errors.type" v-text="$page.props.errors.type" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="status" class="mb-2 block text-gray-700 select-none">Статус:</label>
                    <select id="status" v-model="form.status" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" >
                        <option value="на ходу">На ходу</option>
                        <option value="в ремонте">В ремонте</option>
                    </select>
                    <div v-if="form.errors.status" v-text="$page.props.errors.status" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="user" class="mb-2 block text-gray-700 select-none">Сотрудник:</label>
                    <select id="user" v-model="form.user_id" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" >
                        <option v-for="user in users" :key="user.id" :value="user.id">{{ user.surname }} {{ user.name }} {{ user.third_name }}</option>
                    </select>
                    <div v-if="form.errors.user_id" v-text="$page.props.errors.user_id" class="text-red-500 text-xs mt-1"></div>
                </div>
            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                <loading-button :loading="form.processing" class="btn-indigo" type="submit">Редактировать автомобиль</loading-button>
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
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Группа</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="student in students" :key="student.id" class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">{{ student.surname }} {{ student.name }} {{ student.third_name }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ student.birthday }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ student.contact_info }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ student.group.group_number }}</td>
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
    props: {
        errors: Object,
        auto: Object,
        users: Array,
        students: Array
    },
    components: {
        LoadingButton
    },
    data() {
        return {
            form: this.$inertia.form({
                brand: this.auto.brand,
                model: this.auto.model,
                registration_number: this.auto.registration_number,
                year_of_manufacture: this.auto.year_of_manufacture,
                type: this.auto.type,
                status: this.auto.status,
                user_id: this.auto.user_id,
            })
        }
    },
    methods: {
        update() {
            this.form.put(`/autos/${this.auto.id}`)
        }
    }
}
</script>

<style scoped>

</style>
