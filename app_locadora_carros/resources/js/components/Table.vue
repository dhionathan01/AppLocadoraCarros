<template>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th  v-for="t, key in titulos" :key="key" scope="col">{{ t.titulo }}</th>
                    <th v-if="visualizar || atualizar || remover"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="obj, chave in dadosFiltrados" :key="chave">
                    <td v-for="valor, chaveValor in obj" :key="chaveValor">
                        <span v-if="titulos[chaveValor].tipo == 'texto'">{{ valor }}</span>
                        <span v-if="titulos[chaveValor].tipo == 'data'">{{ '...'+valor }}</span>
                        <span v-if="titulos[chaveValor].tipo == 'imagem'">
                            <img :src="'/storage/'+valor" width="30" height="30">
                        </span>
                    </td>
                    <td v-if="visualizar || atualizar || remover">
                        <button v-if="visualizar" class="btn btn-outline-primary btn-sm">Visualizar</button>
                        <button v-if="atualizar" class="btn btn-outline-primary btn-sm">Atualizar</button>
                        <button v-if="remover" class="btn btn-outline-danger btn-sm">Remover</button>
                    </td>
                </tr>
                <!-- <tr v-for="obj in dados" :key="obj.id">
                    <td v-if="titulos.includes(chave)" v-for="valor, chave in obj" :key="chave">
                       <span v-if="chave == 'imagem'">
                           <img :src="'/storage/'+valor" alt="" width="30" height="30">
                       </span>
                       <span v-else>
                            {{ valor }}
                       </span>
                    </td>
                     <th scope="row">{{ m.id }}</th>
                    <td>{{ m.nome }}</td>
                    <td> <img :src="'/storage/'+m.imagem" alt="" width="30px" height="30px"></td>
                </tr> -->
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: ['dados', 'titulos', 'visualizar', 'atualizar', 'remover'],
    computed: {
        dadosFiltrados() {
            let campos = Object.keys(this.titulos);
            let dadosFiltrados = [];
            this.dados.map((item, chave) => {
                let itemFiltrado = {};
                campos.forEach(campo => {
                    itemFiltrado[campo] = item[campo] // utilizar a sintaxe de array para atribuir valores a objetos
                })
                dadosFiltrados.push(itemFiltrado);
            })
            return dadosFiltrados // returnar um array de objetos
        }
    }
}
</script>
