<div class="col s12 m12">
    <div class="card horizontal">
        <div class="card-stacked">
            <div class="card-content">
                <a class="waves-effect waves-light btn-large blue" href="?pagina=curso&metodo=create">
                    <i class="material-icons left">add_circle</i>
                    Novo
                </a>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Professor</th>
                            <th>Ação</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (empty($cursos)) {
                            echo "Nenhum curso encontrado";
                        } else {
                            foreach ($cursos as $curso) {
                        ?>
                                <tr>
                                    <td><?= $curso->id ?></td>
                                    <td><?= $curso->nome ?></td>
                                    <td><?= $curso->professor->nome ?></td>
                                    <td>
                                        <a class="waves-effect waves-light btn" href="?pagina=curso&metodo=edit&id=<?= $curso->id ?>">Editar</a>
                                        <a id="<?= $curso->id ?>" onclick="deletarCurso(this.id)" class="waves-effect waves-light btn red">Excluir</a>
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
    function deletarCurso(id) {
        axios.get(`?pagina=curso&metodo=delete&id=${id}`).then((response) => {
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