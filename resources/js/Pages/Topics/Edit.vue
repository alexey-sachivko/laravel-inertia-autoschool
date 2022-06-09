<template>
    <Head>
        <title>{{ topic.topic_name }}</title>
    </Head>

    <h1 class="mb-4 text-3xl font-bold">
        <Link class="text-blue-500 hover:text-blue-600" href="/topics">Темы</Link>
        <span class="text-blue-500 font-bold"> /</span> {{ form.topic_name }}
    </h1>

    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
        <form @submit.prevent="update">
            <div class="flex flex-wrap -mr-6 p-8">
                <div class="pb-8 pr-6 w-full lg:w-1/2">
                    <label for="topic_name" class="mb-2 block text-gray-700 select-none">Тема:</label>
                    <input id="topic_name" type="text" v-model="form.topic_name" class="p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring" />
                    <div v-if="form.errors.topic_name" v-text="$page.props.errors.topic_name" class="text-red-500 text-xs mt-1"></div>
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
                <loading-button :loading="form.processing" class="btn-indigo" type="submit">Редактировать тему</loading-button>
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
                topic_name: this.topic.topic_name,
                category_id: this.topic.category_id,
            })
        }
    },
    props: {
        topic: Object,
        categories: Array
    },
    methods: {
        update() {
            this.form.put(`/topics/${this.topic.id}`)
        }
    }
}
</script>

<style scoped>

</style>
