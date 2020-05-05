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
                <th>Açõe</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="c in contatos" :key="c.id">
                <td>{{ c.id }}</td>
                <td>{{ c.nome}}</td>
                <td>{{ c.telefone}}</td>
                <td>
                    <button class="btn btn-sm btn-primary" @click="editContato(c)">Editar</button>
                    <button class="btn btn-sm btn-danger" @click="excluir(c)">Excluir</button>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
</div>
</template>

<script>
export default {
   props: [
       'contatos'
   ],
   methods: {
       excluir(contato){
          this.$swal({
            title: 'Atenção', 
            text: 'Deseja mesmo excluir este contato?',
            showCancelButton: true,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não',
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#3490dc'
        }) .then((result) => {
            if (result.value) {
                axios.delete('/contato/' + contato.id)
                .then(({ data }) => {
                    this.$emit('listar-contatos')
                    this.$swal(
                     'Deletado!',
                     'Contato deletado com sucesso',
                     'success'
                     )
                }) .catch(err => {
                    this.$swal({
                      icon: 'error',
                      text: 'Erro ao excluir contato'
                      });
                })
            }
        })
       },
       editContato(contato){
           this.$emit('selecionar-contato', contato)
       }
   }
}
</script>