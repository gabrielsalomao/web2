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
                        <img src="https://i.imgur.com/VUEGlFp.jpeg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item->nome ?></h5>
                            <p class="card-text"><?= $item->observacao ?></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Preço:</strong> R$ <?= $item->preco ?></li>
                        </ul>
                        <div class="card-body">
                            <a href="#" class="btn btn-primary">
                                <span data-octicon="pencil"></span>
                                Editar
                            </a>
                            <a href="#" class="btn btn-danger">
                                <span data-octicon="trashcan"></span>
                                Deletar
                            </a>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>