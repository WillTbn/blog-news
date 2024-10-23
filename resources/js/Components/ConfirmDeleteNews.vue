<template>
    <div class="ConfirmDeleteNews  relative z-10">
        <div class="grid justify-center text-center m-3">
            <p>Você realmente quer deletar o artigo?</p>
            <h2 class="text-2xl font-medium">
               {{ title }}
            </h2>
        </div>
        <div class="flex">
            <DangerButtom @click.prevent="canceled">
                Cancelar
            </DangerButtom>
        </div>

    </div>
</template>
<script setup>
import DangerButtom from "./DangerButton.vue"
defineProps(['title'])
const emit = defineEmits(['closed'])
const canceled = () =>{
    emit('closed')
}
</script>
