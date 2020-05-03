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
                    <button :disabled="form.busy" type="submit" class="btn btn-primary">Salvar</button>
                </form>
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
            })
        }
    },
    methods: {
        salvar(){
             this.form.post('/contato')
                .then(({ data }) => {
                    this.LimparForm()
                    this.$swal({
                        icon: 'success',
                        text: 'Contato salvo com sucesso'
                    });
                })
                .catch(err => {
                    this.$swal({
                        icon: 'error',
                        text: 'Erro ao salvar contato'
                    });
                })
        },

        LimparForm() {
            this.form = new Form({
                id: null,
                nome: '',
                telefone: '',
            })
        }
    }
}
</script>