<style>
    .card-img-top {
        width: 100%;
        height: 10vw;
        object-fit: cover;
    }
</style>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 1rem;">
            <a href="?pagina=usuario&metodo=cadastrar" class="btn btn-success">Novo Usuário</a>
        </div>
    </div>
    <div class="row col-md-12">

        <?php if (empty($usuarios)) {
        } else {
            echo  '<div class="card" style="width: 100%;">
                    <ul class="list-group list-group-flush">';
            foreach ($usuarios as $usuario) {
        ?>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-3">
                            <strong>
                                <?= $usuario->id ?>
                            </strong>
                            -
                            <?= $usuario->nome ?>
                        </div>
                        <div class="col-md-3">
                            <?= $usuario->email ?>
                        </div>
                        <div class="col-md-2">
                            <?= $usuario->senha ?>
                        </div>
                        <div class="col-md-2">
                            <?= $usuario->tipo ?>
                        </div>
                        <div class="col-md-2 btn-group" role="group" aria-label="Ações">
                            <a href="index.php?pagina=usuario&metodo=editar&id=<?= $usuario->id ?>" type="button" class="btn btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" onclick="deletarUsuario(<?= $usuario->id ?>)" type="button" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>

                </li>
        <?php
            }
            echo '</ul>
            </div>';
        }
        ?>

    </div>
</div>

<script>
    function deletarUsuario(id) {
        axios.get(`?pagina=usuario&metodo=deletar&id=${id}`).then((response) => {
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