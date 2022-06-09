<template>
    <Head title="Добавить автомобиль" />
    <h1 class="mb-4 text-3xl font-bold">
        <Link class="text-blue-500 hover:text-blue-600" href="/autos">Автомобили</Link>
        <span class="text-blue-500 font-bold"> /</span> Добавить
    </h1>

    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
        <form @submit.prevent="store">
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
                        <option :value="null" />
                        <option value="легковой">Легковой</option>
                        <option value="грузовой">Грузовой</option>
                        <option value="автобус">Автобус</option>
                    </select>
                    <div v-if="form.errors.type" v-text="$page.props.errors.type" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="status" class="mb-2 block text-gray-700 select-none">Статус:</label>
                    <select id="status" v-model="form.status" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" >
                        <option :value="null" />
                        <option value="на ходу">На ходу</option>
                        <option value="в ремонте">В ремонте</option>
                    </select>
                    <div v-if="form.errors.status" v-text="$page.props.errors.status" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="user" class="mb-2 block text-gray-700 select-none">Сотрудник:</label>
                    <select id="user" v-model="form.user_id" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" >
                        <option :value="null" />
                        <option v-for="user in users" :key="user.id" :value="user.id">{{ user.surname }} {{ user.name }} {{ user.third_name }}</option>
                    </select>
                    <div v-if="form.errors.user_id" v-text="$page.props.errors.user_id" class="text-red-500 text-xs mt-1"></div>
                </div>
            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                <loading-button :loading="form.processing" class="btn-indigo" type="submit">Добавить автомобиль</loading-button>
            </div>
        </form>
    </div>
</template>

<script>
import LoadingButton from "../../Shared/LoadingButton";

export default {
    name: "Create",
    props: {
        errors: Object,
        users: Array
    },
    components: {
        LoadingButton
    },
    data() {
        return {
            form: this.$inertia.form({
                brand: '',
                model: '',
                registration_number: '',
                year_of_manufacture: '',
                type: '',
                status: '',
                user_id: null,
            })
        }
    },
    methods: {
        store() {
            this.form.post('/autos')
        }
    }
}
</script>
