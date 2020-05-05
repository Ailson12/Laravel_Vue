<template>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Formulario de Contatos</div>

            <div class="card-body">
                <form @submit.prevent="salvar" @keydown="form.onKeydown($event)">
                    <div class="form-group">
                        <label>Nome</label>
                        <input v-model="form.nome" type="text" name="nome"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('nome') }">
                        <has-error :form="form" field="nome"></has-error>
                    </div>

                    <div class="form-group">
                        <label>Telefone</label>
                        <input v-model="form.telefone" type="text" name="telefone"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('telefone') }">
                        <has-error :form="form" field="telefone"></has-error>
                    </div>
                    <button :disabled="form.busy" type="submit" class="btn btn-success">Salvar</button>
                    <button type="reset" class="btn btn-primary"><i class="fa fa-undo"></i></button>
                </form>
            </div>
        </div>
         <div class="row mt-3">
                    <div class="col-md-12">
                        <table-contato 
                        :contatos="contatosCompleto" 
                        @listar-contatos="listarContatos"
                        @selecionar-contato="selecionarContato"></table-contato>
                    </div>
                </div>
    </div>
</template>

<script>
import { Form} from 'vform'
export default {
    data(){
        return {
            form: new Form({
                id: null,
                nome: '',
                telefone: '',
            }),
            contatosCompleto: [],
        }
    },

    mounted(){
       this.listarContatos()
    },
    methods: {
        salvar(){
            if (this.form.id) {
                this.form.put('/contato/' + this.form.id)
                .then(({ data }) => {
                    this.LimparForm()
                    this.listarContatos()
                    this.$swal({
                        icon: 'success',
                        text: 'Contato atualizado com sucesso'
                    });
                })
                .catch(err => {
                    this.$swal({
                        icon: 'error',
                        text: 'Erro ao Atualizar contato'
                    });
                })   
            } else {
             this.form.post('/contato')
                .then(({ data }) => {
                    this.LimparForm()
                    this.listarContatos()
                    this.$swal({
                        icon: 'success',
                        text: 'Contato salvo com sucesso',
                    });
                })
                .catch(err => {
                    this.$swal({
                        icon: 'error',
                        text: 'Erro ao salvar contato'
                    });
                })   
            }
        },

        LimparForm() {
            this.form = new Form({
                id: null,
                nome: '',
                telefone: '',
            })
        },
        listarContatos(){
            axios.get('/contato')
                .then(({ data }) => {
                    this.contatosCompleto =  data
                })
                .catch(err => {
                    this.$swal({
                        icon: 'error',
                        text: 'Erro ao encontrar contato'
                    });
                })
        },
        selecionarContato(contato){
            this.form = new Form({
                id: contato.id,
                nome: contato.nome,
                telefone: contato.telefone,
            })
        }
    }
}
</script>