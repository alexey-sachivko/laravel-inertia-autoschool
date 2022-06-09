<template>
  <button :disabled="loading" class="py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">
    <slot />
  </button>
</template>

<script>
export default {
  props: {
    loading: Boolean,
  },
}
</script>
