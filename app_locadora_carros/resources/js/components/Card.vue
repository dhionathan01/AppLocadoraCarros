<template>
    <div class="card mb-3" id="card_busca">
        <div class="card-header">{{ titulo }}</div>
        <div class="card-body">
            <slot name="conteudo"></slot>
        </div>
        <div class="card-footer">
            <slot name="rodape"></slot>
        </div>
    </div>
</template>

<script>
export default {
    props:['titulo']
}
</script>
