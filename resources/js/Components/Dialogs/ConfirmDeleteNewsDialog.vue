<template>
    <TransitionRoot appear :show="localOpen" as="template">
        <Dialog as="div" @close="closedDialog" class="relative z-10">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black/25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex min-h-full items-center justify-center p-4 text-center"
                >
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                            class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                        >
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Você realmente quer deletar o artigo?
                                </p>
                            </div>
                            <DialogTitle
                                as="h3"
                                class="text-lg font-medium leading-6 text-gray-900"
                            >
                                {{ title }}
                            </DialogTitle>
                            <div class="mt-6">
                                <div class="flex justify-between">
                                    <DangerButton @click.prevent="closedDialog">
                                        Cancelar
                                    </DangerButton>
                                    <PrimaryButton @click.prevent="confirmDelete">
                                        Confirma
                                    </PrimaryButton>
                                </div>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
<script setup>
// import {  router} from '@inertiajs/vue3';
import DangerButton from "@/Components/DangerButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref, watch } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { useForm } from '@inertiajs/vue3';
// import { CheckIcon } from '@heroicons/vue/24/outline'
const props = defineProps(['open', 'title', 'hash_id']);
const emit = defineEmits(['hide-Dialog'])
const localOpen = ref(props.open)
watch(() => props.open, (newVal) => {
  localOpen.value = newVal
})
watch(() => props.hash_id, (newVal) => {
    form.hash_id = newVal
})

const form = useForm({
    hash_id: props.hash_id,
});
const confirmDelete = () =>{
    console.log(form.hash_id)
    form.delete(route('blog.destroy'), {
        preserveScroll: true,
        onSuccess: () => closedDialog(),
        // onError: () => passwordInput.value.focus(),
        // onFinish: () => form.reset(),
    });
}
const closedDialog = () =>{
    emit('hide-Dialog')
    localOpen.value = false
    // window.location.reload();
}
</script>
