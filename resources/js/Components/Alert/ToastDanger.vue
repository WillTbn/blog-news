<template lang="">
    <div
        id="toast-top-left"
        class="fixed flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x rtl:divide-x-reverse divide-gray-200 rounded-lg shadow top-5 left-5 dark:text-gray-400 dark:divide-gray-700 dark:bg-gray-800"
        role="alert"
    >
        <div class="text-sm font-normal">{{ textMessage }}</div>
    </div>
</template>
<script setup>
defineProps({
    textMessage: {
        type: String,
    }
});
</script>
<style lang="">

</style>
