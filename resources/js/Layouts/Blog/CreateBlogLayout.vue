<template>
    <form class="CreateBlogLayout"  @submit.prevent="form.post(route('blog.store'))">
        <div class="flex flex-row justify-center">
            <div class="basis-1/2 mt-8 w-64">
                <InputLabel for="title" value="Título" />
                <text-input
                    id="title"
                    type="text"
                    class="block w-full mt-1"
                    v-model="form.title"
                    required
                />
                <!-- autocomplete="road" -->
            </div>
        </div>
        <div class="flex flex-row justify-center">
            <div class="basis-1/2 mt-8 w-96">
                <InputLabel for="content" value="Conteúdo" />
                <div class="px-4 py-2 bg-white rounded-b-lg dark:bg-gray-800">
                    <textarea
                        v-model="form.content"
                        id="editor"
                        rows="25"
                        class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write an article..." required
                    >
                    </textarea>
                </div>
            </div>
        </div>
        <div class="flex flex-row justify-end">
            <div class="basis-1/4 mt-8 w-80">
                <PrimaryButton :disabled="form.processing">
                    Criar
                </PrimaryButton>
            </div>
        </div>
    </form>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3'

// import { onMounted } from "vue";
import TextInput from '../../Components/Forms/TextInput.vue';
import InputLabel from '../../Components/Forms/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    title: "",
    content: "",
});
// onMounted(() =>{
//     if(!form.title){
//         form.title = newsBlog.value.title
//         form.content = newsBlog.value.content
//         form.hash_id = newsBlog.value.hash_id
//     }
// })
</script>
