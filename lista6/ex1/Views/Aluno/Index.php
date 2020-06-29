<div class="col s12 m12">
    <div class="card horizontal">
        <div class="card-stacked">
            <div class="card-content">
                <a class="waves-effect waves-light btn-large blue" href="?pagina=aluno&metodo=cadastrar">
                    <i class="material-icons left">add_circle</i>
                    Novo
                </a>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Sexo</th>
                            <th>Data de Nascimento</th>
                            <th>Registro</th>
                            <th>Ação</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (empty($alunos)) {
                            echo "Nenhum aluno encontrado";
                        } else {
                            foreach ($alunos as $aluno) {
                        ?>
                                <tr>
                                    <td><?= $aluno->id ?></td>
                                    <td><?= $aluno->nome ?></td>
                                    <td><?= $aluno->obterSexo() ?></td>
                                    <td><?= $aluno->obterDataFormatada() ?></td>
                                    <td><?= $aluno->registro ?></td>
                                    <td>
                                        <a class="waves-effect waves-light btn" href="?pagina=aluno&metodo=editar&id=<?= $aluno->id ?>">Editar</a>
                                        <a id="<?= $aluno->id ?>" onclick="deletarAluno(this.id)" class="waves-effect waves-light btn red">Excluir</a>
                                    </td>
                                </tr>
                    </tbody>
            <?php
                            }
                        }
            ?>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
    function deletarAluno(id) {
        axios.get(`?pagina=aluno&metodo=deletar&id=${id}`).then((response) => {
            if (response.data.success == true) {
                alert(response.data.message);
                location.reload();
            } else {
                alert(response.data);
            }
        }).catch((erro) => {
            alert(erro)
        });
    }
</script>