<template>
    <Head>
        <title>Категории</title>
    </Head>

    <div class="mb-4">
        <h2 class="text-3xl">Категории</h2>
    </div>

    <div class="bg-white overflow-auto rounded-lg">
        <table class="text-left w-full border-collapse">
            <thead>
                <tr>
                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Категория</th>
                </tr>
            </thead>
            <tbody>
            <tr v-for="category in categories" :key="category.id" class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">{{ category.category_name }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "Index",
    props: {
        categories: Array
    }
}
</script>

<style scoped>

</style>
