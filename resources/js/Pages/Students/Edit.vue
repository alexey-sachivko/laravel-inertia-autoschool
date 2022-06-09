<template>
    <Head :title="`${form.surname} ${form.name} ${form.third_name}`" />
    <h1 class="mb-4 text-3xl font-bold">
        <Link class="text-blue-500 hover:text-blue-600" href="/students">Курсанты</Link>
        <span class="text-blue-500 font-bold"> /</span> {{ form.surname }} {{ form.name }} {{ form.third_name }}
    </h1>

    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
        <form @submit.prevent="update">
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
                    <label for="group" class="mb-2 block text-gray-700 select-none">Группа:</label>
                    <select id="group" v-model="form.group_id" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" >
                        <option v-for="group in groups" :key="group.id" :value="group.id">{{ group.group_number }}</option>
                    </select>
                    <div v-if="form.errors.group_id" v-text="$page.props.errors.group_id" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="auto" class="mb-2 block text-gray-700 select-none">Автомобиль:</label>
                    <select id="auto" v-model="form.auto_id" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" >
                        <option v-for="auto in autos" :key="auto.id" :value="auto.id">{{ auto.brand }} {{ auto.model }} | {{ auto.registration_number }}</option>
                    </select>
                    <div v-if="form.errors.auto_id" v-text="$page.props.errors.auto_id" class="text-red-500 text-xs mt-1"></div>
                </div>
            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                <loading-button :loading="form.processing" class="btn-indigo" type="submit">Редактировать курсанта</loading-button>
            </div>
        </form>
    </div>
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
                surname: this.student.surname,
                name: this.student.name,
                third_name: this.student.third_name,
                birthday: this.student.birthday,
                address: this.student.address,
                contact_info: this.student.contact_info,
                passport_info: this.student.passport_info,
                group_id: this.student.group_id,
                auto_id: this.student.auto_id
            })
        }
    },
    props: {
        student: Object,
        groups: Array,
        autos: Array
    },
    methods: {
        update() {
            this.form.put(`/students/${this.student.id}`)
        }
    }
}
</script>

<style scoped>

</style>
