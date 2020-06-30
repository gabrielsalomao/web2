<div class="card">
    <div class="card-header">
        Editar item
    </div>
    <div class="card-body">
        <form enctype="multipart/form-data" class="needs-validation" method="post" action="?pagina=item&metodo=editarPost">
            <input type="hidden" id="id" name="id" value="<?= $item->id ?>">
            <div class="form-row">
                <div class="col-md-10 mb-3 form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" value="<?= $item->nome ?>" id="nome" name="nome" placeholder="Ex: Macarrão" required>
                </div>
                <div class="col-md-2 form-group">
                    <label for="preco">Preço</label>
                    <input type="text" class="form-control" value="<?= $item->preco ?>" id="preco" name="preco" placeholder="R$ 0.00" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 form-group">
                    <label for="observacao">Observação</label>
                    <textarea class="form-control" id="observacao" name="observacao" rows="3"><?= $item->observacao ?></textarea>
                </div>
                <div class="form-group col-md-12">
                    <label for="imagem">Imagem</label>
                    <input type="file" class="form-control-file" name="imagem" id="imagem">
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Editar</button>
        </form>
    </div>
</div>