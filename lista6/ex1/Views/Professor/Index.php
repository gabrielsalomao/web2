<div class="col s12 m12">
    <div class="card horizontal">
        <div class="card-stacked">
            <div class="card-content">
                <a class="waves-effect waves-light btn-large blue" href="?pagina=professor&metodo=cadastrar">
                    <i class="material-icons left">add_circle</i>
                    Novo
                </a>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Registro</th>
                            <th>Titulação</th>
                            <th>Sexo</th>
                            <th>Ação</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (empty($professores)) {
                            echo "Nenhum professor encontrado";
                        } else {
                            foreach ($professores as $professor) {
                        ?>
                                <tr>
                                    <td><?= $professor->id ?></td>
                                    <td><?= $professor->nome ?></td>
                                    <td><?= $professor->registro ?></td>
                                    <td><?= $professor->titulacao ?></td>
                                    <td><?= $professor->obterSexo() ?></td>
                                    <td>
                                        <a class="waves-effect waves-light btn" href="?pagina=professor&metodo=editar&id=<?= $professor->id ?>">Editar</a>
                                        <a id="<?= $professor->id ?>" onclick="deletarProfessor(this.id)" class="waves-effect waves-light btn red">Excluir</a>
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
    function deletarProfessor(id) {
        axios.get(`?pagina=professor&metodo=deletar&id=${id}`).then((response) => {
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