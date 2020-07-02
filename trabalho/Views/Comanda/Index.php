<style>
    .pulse {
        overflow: visible;
        position: relative;
    }

    .pulse:before {
        content: '';
        display: block;
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: inherit;
        border-radius: inherit;
        transition: opacity .3s, transform .3s;
        animation: pulse-animation 1s cubic-bezier(0.24, 0, 0.38, 1) infinite;
        z-index: -1;
    }

    @keyframes pulse-animation {
        0% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: 0;
            transform: scale(1.07);
        }

        100% {
            opacity: 0;
            transform: scale(1);
        }
    }
</style>

<div class="row card-columns">
    <?php
    $total = 0;
    foreach ($comandas as $comanda) {
    ?>
        <div class="col-md-4">
            <div class="card box-shadow <?php if ($comanda->status == "Novo") echo "pulse" ?>">
                <div class="card-header">
                    <strong><?= $comanda->id ?></strong>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <h4><span class="badge <?php switch ($comanda->status) {
                                                    case "Novo":
                                                        echo "badge-primary";
                                                        break;
                                                    case "Em preparo":
                                                        echo "badge-warning";
                                                        break;
                                                    case "Concluido":
                                                        echo "badge-success";
                                                        break;
                                                }  ?>"> <?= $comanda->status ?></span>
                        </h4>
                    </li>
                    <li class="list-group-item">
                        <p class="card-text">
                            <?php foreach ($comanda->itens as $item) {
                                $total += ((float) $item->itemPreco * (int) $item->itemQnt)  ?>
                                <strong><?= $item->itemQnt ?>x</strong> <?= $item->itemNome ?> <br>
                            <?php
                            }
                            ?>
                        </p>
                    </li>
                    <li class="list-group-item">
                        <strong>Observação</strong><br>
                        <?= $comanda->observacao ?>
                    </li>
                    <li class="list-group-item"><strong>Total:</strong> R$ <?= $total ?></li>
                </ul>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <a href="#" onclick="editarComanda(<?= $comanda->id ?>)" class="form-control btn btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                        <div class="form-group col-md-6">
                            <a href="#" class="form-control btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
        $total = 0;
    }
    ?>
</div>

<div class="modal fade" id="edicaoModalComanda" tabindex="-1" role="dialog" aria-labelledby="edicaoModalComandaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edicaoModalComandaLabel">Editar Comanda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="edicaoComandaItens">Item</label>
                        <select class="form-control" id="edicaoComandaItens" name="edicaoComandaItens">

                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="edicaoComandaItemPreco">Preço</label>
                        <input type="text" class="form-control" disabled id="edicaoComandaItemPreco" name="edicaoComandaItemPreco">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="edicaoComandaItemQnt">Qnt</label>
                        <input type="number" class="form-control" id="edicaoComandaItemQnt" name="edicaoComandaItemQnt">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="" style="color: white;">Salvar</label>
                        <button onclick="edicaoInserirItemNaComanda()" class="btn btn-success form-control">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="edicaoComandaObservacao">Observação</label>
                        <textarea name="edicaoComandaObservacao" id="edicaoComandaObservacao" class="form-control">
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group col-md-2">
                    <div class="row">
                        <h5>Total: <span id="edicaoComandaPrecoTotal">R$ 0.00</span></h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="cadastrarComanda()">Salvar</button>
            </div>
            <div class="modal-footer" id="edicaoItens">
            </div>
        </div>
    </div>
</div>