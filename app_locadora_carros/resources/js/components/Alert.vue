<template>
    <div :class="estilo" class="alert alert-success" role="alert">
        {{ titulo }}
        <hr>
        <p>{{ detalhes.messagem }}</p>
        <br>
        <ul v-if="detalhes.dados">
            <li v-for="e, key in detalhes.dados" :key="key">
                {{ e[0]}}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: ['tipo', 'titulo', 'detalhes'],
    computed: {
        estilo() {
            return `alert alert-${this.tipo}`
        }
    }
}
</script>
