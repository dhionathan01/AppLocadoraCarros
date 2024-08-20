<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!--  Início do card de busca -->
                <card-component titulo="Busca de marcas">
                    <template v-slot:conteudo>
                        <div class="row">
                            <div class="col mb-3">
                                <input-container-component titulo="ID" id="inputId" id-help="idHelp"
                                    texto-ajuda="Opcional. Informe o id da marca">
                                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp"
                                        placeholder="ID" v-model="busca.id">
                                </input-container-component>
                            </div>
                            <div class="col mb-3">
                                <input-container-component titulo="Nome da marca" id="inputNome" id-help="nomeHelp"
                                    texto-ajuda="Opcional. Informe o nome da marca">
                                    <input type="text" class="form-control" id="inputId" aria-describedby="nomeHelp"
                                        placeholder="Nome da marca" v-model="busca.nome">
                                </input-container-component>
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <button type="button" class="btn btn-primary btn-sm float-end" @click="pesquisar()">Pesquisar</button>

                    </template>
                </card-component>
                <!-- Fim do card de busca -->
                <!-- Inicio do card de listagem de marcas -->
                <card-component titulo="Relação de marcas">
                    <template v-slot:conteudo>
                        <table-component :dados="marcas.data"
                        :visualizar="true"
                        :atualizar="false"
                        :remover="false"
                        :titulos="{
                            id: { titulo: 'ID', tipo: 'texto' },
                            nome: { titulo: 'Nome', tipo: 'texto' },
                            imagem: { titulo: 'Imagem', tipo: 'imagem' },
                            created_at: { titulo: 'Data de criação', tipo: 'data' }
                        }"></table-component>
                    </template>

                    <template v-slot:rodape>
                        <div class="row">
                            <div class="col-10">
                                <paginate-component>
                                    <li v-for="l, key in marcas.links" :class=" l.active ? 'page-item active' : 'page-item'">
                                        <a class="page-link" v-html="l.label" @click="paginacao(l)"></a>
                                    </li>
                                </paginate-component>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal"
                                    data-bs-target="#modalMarca">Adicionar</button>
                            </div>
                        </div>

                    </template>
                </card-component>
                <!--  Fim do card de listagem de marcas -->
            </div>
        </div>
        <modal-component id="modalMarca" titulo="Adicionar marca">
            <template v-slot:alertas>
                <alert-component tipo="success" titulo="Cadastro realizado com sucesso." :detalhes="transacaoDetalhes"
                    v-if="transacaoStatus == 'adicionado'"></alert-component>
                <alert-component tipo="danger" titulo="Erro ao tentar cadastrar a marca." :detalhes="transacaoDetalhes"
                    v-if="transacaoStatus == 'erro'"></alert-component>
            </template>
            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component titulo="Nome da marca" id="novoNome" id-help="novoNomeHelp"
                        texto-ajuda="Opcional. Informe o nome da marca">
                        <input type="text" class="form-control" id="inputId" aria-describedby="novoNomeHelp"
                            placeholder="Nome da marca" v-model="nomeMarca">
                    </input-container-component>
                    {{ nomeMarca }}
                </div>
                <div class="form-group">
                    <input-container-component titulo="Imagem" id="novoImagem" id-help="novoImagemHelp"
                        texto-ajuda="Selecione uma imagem no formato PNG">
                        <input type="file" class="form-control" id="inputId" aria-describedby="novoImagemHelp"
                            placeholder="Selecione uma imagem" @change="carregarImagem($event)">
                    </input-container-component>
                    {{ arquivoImagem }}
                </div>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="salvar()">Salvar</button>
            </template>
        </modal-component>
    </div>
</template>

<script>
export default {
    data() {
        return {
            urlBase: 'http://localhost:8000/api/v1/marca',
            urlPaginacao: '',
            urlFiltro: '',
            nomeMarca: '',
            arquivoImagem: [],
            transacaoStatus: '',
            transacaoDetalhes: [],
            marcas: { data: [] },
            busca: {id: '', nome: ''}
        }
    },
    computed: {
        token() {
            let token = document.cookie.split(';').find(indice => {
                return indice.includes('token=')
            });
            token = token.split('=')[1]
            token = 'Bearer ' + token;
            return token;
        }
    },
    methods: {
        pesquisar() {
            let filtro = ''
            for (let chave in this.busca) {
                if (this.busca[chave]) {
                    if (filtro != '') {
                        filtro += ';'
                    }
                    filtro += `${chave}:like:${this.busca[chave]}`
                }
            }
            if (filtro != '') {
                this.urlPaginacao = `&page=1`
                this.urlFiltro = `&filtro=${filtro}`
            } else {
                this.urlFiltro = ''
            }
            this.carregarLista();// requisitando novamente os dados para nossa API
        },
        paginacao(link_paginate) {
            if (link_paginate.url) {
                this.urlPaginacao = link_paginate.url.split('?')[1]
                /* this.urlBase = link_paginate.url */ // ajustando a url de consulta com o parâmetro da página
                this.carregarLista(); // requisitando novamente os dados para nossa API
            }
        },
        carregarLista() {
            let url = `${this.urlBase}?${this.urlPaginacao}${this.urlFiltro}`;
            let config = {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': this.token
                }
            }
            axios.get(url, config)
                .then(response => {
                    this.marcas = response.data
                })
                .catch(error => {
                })
        },
        carregarImagem(event) {
            this.arquivoImagem = event.target.files;

        },
        salvar() {
            let formData = new FormData();
            formData.append('nome', this.nomeMarca);
            formData.append('imagem', this.arquivoImagem[0]);
            let config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Accept': 'application/json',
                    'Authorization': this.token
                }
            }
            axios.post(this.urlBase, formData, config)
                .then(response => {
                    this.transacaoStatus = 'adicionado'
                    this.transacaoDetalhes =
                    {
                        mensagem: 'ID do registro: ' + response.data.id
                    }
                })
                .catch(errors => {
                    this.transacaoStatus = 'erro'
                    this.transacaoDetalhes = {
                        mensagem: errors.response.data.message,
                        dados: errors.response.data.errors
                    };
                    /* errors.response.data.message */
                })
        }
    },
    mounted() {
        this.carregarLista();
    }
}
</script>
