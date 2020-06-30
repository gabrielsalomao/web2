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
            <a href="?pagina=item&metodo=cadastrar" class="btn btn-success">Novo</a>
        </div>
    </div>
    <div class="row">
        <?php if (empty($itens)) {
            echo "<h1>Nenhum item encontrado</h1>";
        } else {
            foreach ($itens as $item) {
        ?>
                <div class="col-md-4" style="margin-bottom: 1rem;">
                    <div class="card">
                        <img src="<?= $item->imagem == null ? "Imagens/default.jpg" : $item->imagem ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item->nome ?></h5>
                            <p class="card-text"><?= $item->observacao ?></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Preço:</strong> R$ <?= $item->preco ?></li>
                        </ul>
                        <div class="card-body">
                            <a href="index.php?pagina=item&metodo=editar&id=<?= $item->id ?>" class="btn btn-primary">
                                <span data-octicon="pencil"></span>
                                Editar
                            </a>
                            <button href="#" id="<?= $item->id ?>" onclick="deletarItem(this.id)" class="btn btn-danger">
                                <span data-octicon="trashcan"></span>
                                Deletar
                            </button>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>

<script>
    function deletarItem(id) {
        axios.get(`?pagina=item&metodo=deletar&id=${id}`).then((response) => {
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