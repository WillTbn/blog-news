<template>
    <Head title="Editando noticia"/>
    <Dialog :open="flash.success" title="Sucesso!" :description="flash.message" button="Ok!" />
    <AuthenticatedLayout>
        <CreateBlogLayout />
    </AuthenticatedLayout>
</template>
<script setup>
import { Head} from '@inertiajs/vue3';

import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
// import { Inertia} from '@inertiajs/inertia'
import Dialog from '../../Components/Dialog.vue';
import CreateBlogLayout from '../../Layouts/Blog/CreateBlogLayout.vue';
defineProps({
    flash:{type:Object}
})
</script>
