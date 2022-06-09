<template>
    <Head title="Добавить сотрудника" />
    <h1 class="mb-4 text-3xl font-bold">
        <Link class="text-blue-500 hover:text-blue-600" href="/users">Сотрудники</Link>
        <span class="text-blue-500 font-bold"> /</span> Добавить
    </h1>

    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
        <form @submit.prevent="store">
            <div class="flex flex-wrap -mr-6 p-8">
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="surname" class="mb-2 block text-gray-700 select-none">Фамилия:</label>
                    <input id="surname" type="text" v-model="form.surname" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.surname" v-text="$page.props.errors.surname" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="name" class="mb-2 block text-gray-700 select-none">Имя:</label>
                    <input id="name" type="text" v-model="form.name" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.name" v-text="$page.props.errors.name" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="third_name" class="mb-2 block text-gray-700 select-none">Отчество:</label>
                    <input id="third_name" type="text" v-model="form.third_name" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.third_name" v-text="$page.props.errors.third_name" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="birthday" class="mb-2 block text-gray-700 select-none">Дата рождения:</label>
                    <input id="birthday" type="text" v-model="form.birthday" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.birthday" v-text="$page.props.errors.birthday" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="address" class="mb-2 block text-gray-700 select-none">Адрес проживания:</label>
                    <input id="address" type="text" v-model="form.address" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.address" v-text="$page.props.errors.address" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="rank" class="mb-2 block text-gray-700 select-none">Должность:</label>
                    <select id="rank" v-model="form.rank" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" >
                        <option :value="null" />
                        <option value="admin">Администратор</option>
                        <option value="teacher">Преподаватель</option>
                        <option value="instructor">Инструктор</option>
                    </select>
                    <div v-if="form.errors.rank" v-text="$page.props.errors.rank" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="contact_info" class="mb-2 block text-gray-700 select-none">Контактные данные:</label>
                    <input id="contact_info" type="text" v-model="form.contact_info" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.contact_info" v-text="$page.props.errors.contact_info" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="passport_info" class="mb-2 block text-gray-700 select-none">Паспортные данные:</label>
                    <input id="passport_info" type="text" v-model="form.passport_info" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.passport_info" v-text="$page.props.errors.passport_info" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="username" class="mb-2 block text-gray-700 select-none">Имя пользователя:</label>
                    <input id="username" type="text" v-model="form.username" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.username" v-text="$page.props.errors.username" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="password" class="mb-2 block text-gray-700 select-none">Пароль:</label>
                    <input id="password" type="password" v-model="form.password" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.password" v-text="$page.props.errors.password" class="text-red-500 text-xs mt-1"></div>
                </div>
            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                <loading-button :loading="form.processing" class="btn-indigo" type="submit">Добавить сотрудника</loading-button>
            </div>
        </form>
    </div>
</template>

<script>
import LoadingButton from "../../Shared/LoadingButton";

export default {
    name: "Create",
    props: {
        errors: Object
    },
    components: {
        LoadingButton
    },
    data() {
        return {
            form: this.$inertia.form({
                surname: '',
                name: '',
                third_name: '',
                birthday: '',
                address: '',
                rank: '',
                contact_info: '',
                passport_info: '',
                username: '',
                password: ''
            })
        }
    },
    methods: {
        store() {
            this.form.post('/users')
        }
    }
}
</script>

<style scoped>

</style>
