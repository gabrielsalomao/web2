<div class="card">
    <div class="card-header">
        Editar usuário
    </div>
    <div class="card-body">
        <form enctype="multipart/form-data" class="needs-validation" method="post" action="?pagina=usuario&metodo=editarPost">
            <input type="hidden" name="id" value="<?= $usuario->id ?>">
            <div class="form-row">
                <div class="col-md-6 form-group">
                    <label for="nome">Nome</label>
                    <input value="<?= $usuario->nome ?>" type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="col-md-6 form-group">
                    <label for="email">E-Mail</label>
                    <input value="<?= $usuario->email ?>" type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 form-group">
                    <label for="senha">Senha</label>
                    <input value="<?= $usuario->senha ?>" type="text" class="form-control" id="senha" name="senha" required>
                </div>
                <div class="col-md-6 form-group">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo" class="form-control">
                        <option value="Admin" <?php if ($usuario->tipo == "Admin") {
                                                    echo "selected";
                                                } ?>>Admin</option>
                        <option value="Usuário" <?php if ($usuario->tipo == "Usuário") {
                                                    echo "selected";
                                                } ?>>Usuário</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Editar</button>
        </form>
    </div>
</div>