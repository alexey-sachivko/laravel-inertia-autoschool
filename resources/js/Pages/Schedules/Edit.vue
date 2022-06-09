<template>
    <Head :title="`Расписание группы ${form.group_number}`" />
    <h1 class="mb-4 text-3xl font-bold">
        <Link class="text-blue-500 hover:text-blue-600" href="/schedules">Расписание групп</Link>
        <span class="text-blue-500 font-bold"> /</span> Редактировать
    </h1>

    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
        <form @submit.prevent="update">
            <div class="flex flex-wrap -mr-6 p-8">
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="class_time" class="mb-2 block text-gray-700 select-none">Время занятий:</label>
                    <input id="class_time" type="time" v-model="form.class_time" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.class_time" v-text="$page.props.errors.class_time" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="day_of_week" class="mb-2 block text-gray-700 select-none">День недели:</label>
                    <select id="day_of_week" v-model="form.day_of_week" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" >
                        <option value="Понедельник">Понедельник</option>
                        <option value="Вторник">Вторник</option>
                        <option value="Среда">Среда</option>
                        <option value="Четверг">Четверг</option>
                        <option value="Пятница">Пятница</option>
                        <option value="Суббота">Суббота</option>
                        <option value="Воскресенье">Воскресенье</option>
                    </select>
                    <div v-if="form.errors.day_of_week" v-text="$page.props.errors.day_of_week" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="group" class="mb-2 block text-gray-700 select-none">Группа:</label>
                    <select id="group" v-model="form.group_id" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" >
                        <option v-for="group in groups" :key="group.id" :value="group.id">{{ group.group_number }}</option>
                    </select>
                    <div v-if="form.errors.group_id" v-text="$page.props.errors.group_id" class="text-red-500 text-xs mt-1"></div>
                </div>
            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                <loading-button :loading="form.processing" class="btn-indigo" type="submit">Редактировать расписание группы</loading-button>
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
                class_time: this.schedule.class_time,
                day_of_week: this.schedule.day_of_week,
                group_id: this.schedule.group_id,
            })
        }
    },
    props: {
        schedule: Object,
        groups: Array
    },
    methods: {
        update() {
            this.form.put(`/schedules/${this.schedule.id}`)
        }
    }
}
</script>

<style scoped>

</style>
