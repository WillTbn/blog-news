<template>
    <Head title="Editando noticia"/>
    <div class="" v-if="errors" :key="errors">
        <ToastDanger
            v-for="(item, index) in errors" :key="index"
            :textMessage="item"
        />
    </div>
    <Dialog :open="flash.success" title="Sucesso!" :description="flash.message" button="Ok!" />
    <AuthenticatedLayout>
        <editBlogLayout v-if="newsBlog" :key="newsBlog"/>
    </AuthenticatedLayout>
</template>
<script setup>
import { Head} from '@inertiajs/vue3';
import {useBlogStore} from '../../Stores/Blog'
import { storeToRefs } from "pinia";
import {onMounted } from "vue"

import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
// import { Inertia} from '@inertiajs/inertia'
import Dialog from '../../Components/Dialog.vue';
import EditBlogLayout from '../../Layouts/Blog/EditBlogLayout.vue';
import ToastDanger from '@/Components/Alert/ToastDanger.vue';

const props = defineProps({
    blog_new:{type:[Array,Object]},
    flash:{type:Object},
    errors:{type:[Object, Array]}
})


const storeBlog = useBlogStore()
const { newsBlog } = storeToRefs(storeBlog)


onMounted(() => {
    storeBlog.setNewBlog(props.blog_new)
})
</script>
<style lang="">

</style>
