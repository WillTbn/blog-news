<template>
    <div class="ListBlogLayout overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <!-- <div class="p-6 text-gray-900 dark:text-gray-100"> -->
        <table-body>
            <template #headColumns>
                <table-header type="first" label="criado por"/>
                <table-header type="normal" label="criado em"/>
                <table-header type="normal" label="titulo"/>
                <table-header type="action" label="Ações"/>
            </template>
            <template #tableRows>
                <tr v-for="(item, index) in news" :key="index">
                    <table-data type="first">
                        <div class="flex flex-row items-center ">
                            <img class="mx-2 rounded-full w-7 h-7" :src="item.user.avatar" :srcset="item.user.avatar" :alt="item.create_email">
                            {{ item.user.email }}
                        </div>
                    </table-data>
                    <table-data type="normal">
                        {{ item.created_at }}
                    </table-data>
                    <table-data type="normal">
                        {{ item.title }}
                    </table-data>
                    <table-data type="action">
                        <Link
                            method="get"
                            class="rounded-lg bg-blue-900 p-2 mr-4"
                            :href="route('blog.getOne', item.id)"
                        >
                            <font-awesome-icon color="blue"  :icon="['fass', 'fa-edit']"/>
                            <span class="text-white ml-2">Editar</span>
                        </Link>
                        <DangerButton
                            class="rounded-lg bg-red-900 p-2"
                            @click.prevent="showDelete(item.title, item.hash_id)"
                        >
                            <font-awesome-icon color="red"  :icon="['fass', 'fa-trash']"/>
                            <span class="text-white ml-2">excluir</span>
                        </DangerButton>
                    </table-data>
                </tr>
            </template>
        </table-body>
        <!-- </div> -->
        <ConfirmDeleteNewsDialog :hash_id="itemHashId" :open="showModalDelete" :title="titleModal" @hide-Dialog="showModalDelete = false" />
    </div>
</template>
<script setup>
import { ref, onMounted } from 'vue'
import { Link } from '@inertiajs/vue3';
import TableBody from '@/Components/Table/TableBody.vue';
import TableData from '@/Components/Table/TableData.vue';
import TableHeader from '@/Components/Table/TableHeader.vue';
// import ConfirmDeleteNews from '@/Components/ConfirmDeleteNews.vue';
// import Modal from '@/Components/Modal.vue';
import DangerButton from "@/Components/DangerButton.vue"
import ConfirmDeleteNewsDialog from "@/Components/Dialogs/ConfirmDeleteNewsDialog.vue"
const showModalDelete = ref(false);
const titleModal = ref("")
const itemHashId = ref("")
const showDelete =  ( title, hash_id ) =>{
    showModalDelete.value = true
    titleModal.value =  ` ${title}`
    itemHashId.value = hash_id
}

// const closeModal = () =>{
//     showModalDelete.value = false

// }
defineProps({
    news:{type:Array}
});

onMounted(() => {
    showModalDelete.value = false
})
</script>
<style lang="">

</style>
