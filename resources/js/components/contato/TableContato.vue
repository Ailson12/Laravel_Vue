<template>
<div class="card">
    <div class="card-header">Tabela de Contatos</div>

    <div class="card-body">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Acoe</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="c in contatos" :key="c.id">
                <td>{{ c.id }}</td>
                <td>{{ c.nome}}</td>
                <td>{{ c.Telefone}}</td>
            </tr>
        </tbody>
    </table>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            contatos: []
        }
    },
    mounted(){
        axios.get('/contato')
        .then(({ data }) => {
            this.contatos =  data
        })
        .catch(err => {
            this.$swal({
                icon: 'error',
                text: 'Erro ao encontrar contato'
            });
        })
    }
}
</script>