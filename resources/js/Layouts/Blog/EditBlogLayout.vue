<template>
    <form class="EditBlogLayout"  @submit.prevent="submitForm">
        <div class="flex flex-row justify-center">
            <div class="basis-1/2 mt-8 w-64">
                <label
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    for="small_size">
                    Imagem de Header da noticia
                </label>
                <input
                    class="block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="small_size"
                    type="file"
                    @change="handleFileUpload"
                />
            </div>
        </div>
        <div class="flex flex-row justify-center">
            <div class="basis-1/2 mt-8 w-64">
                <InputLabel for="title" value="Título" />
                <text-input
                    id="title"
                    type="text"
                    class="block w-full mt-1"
                    v-model="form.title"
                    required
                    autocomplete="road"
                />
            </div>
        </div>
        <div class="flex flex-row justify-center">
            <div class="basis-1/2 mt-8 w-64">
                <InputLabel for="subtitle" value="SubTitulo" />
                <text-input
                    id="subtitle"
                    type="text"
                    class="block w-full mt-1"
                    v-model="form.subtitle"
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
                <!-- <button
                    type="button"
                    class="focus:outline-none cursor-pointer text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                    :class="{'cursor-not-allowed': isButtom}"
                    :disabled="isButtom"
                    @click.prevent="onSubmit"
                >
                    Salvar alteração
                </button> -->
                <PrimaryButton :disabled="form.processing">
                    Atualizar
                </PrimaryButton>
            </div>
        </div>
    </form>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3'
import { useBlogStore } from '../../Stores/Blog';
import { storeToRefs } from "pinia";
// import { onMounted } from "vue";
import TextInput from '../../Components/Forms/TextInput.vue';
import InputLabel from '../../Components/Forms/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const storeBlog = useBlogStore();
const { newsBlog } = storeToRefs(storeBlog);
const form = useForm({
    title: newsBlog.value.title,
    content: newsBlog.value.content,
    hash_id: newsBlog.value.hash_id,
    subtitle: newsBlog.value.subtitle,
    photo: newsBlog.value.photo
});
const handleFileUpload = (event) => {
    form.photo = event.target.files[0];
};

const submitForm = () => {
    const formData = new FormData();
    formData.append('name', form.name);
    formData.append('email', form.email);
    if (form.photo) {
        formData.append('photo', form.photo);
    }

    form.post(route('blog.update', form), {
        forceFormData: true, // Isso força o Inertia a usar FormData
    });
};
// onMounted(() =>{
//     if(!form.title){
//         form.title = newsBlog.value.title
//         form.content = newsBlog.value.content
//         form.hash_id = newsBlog.value.hash_id
//     }
// })
</script>
