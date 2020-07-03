<div class="card">
    <div class="card-header">
        Cadastrar usuário
    </div>
    <div class="card-body">
        <form enctype="multipart/form-data" class="needs-validation" method="post" action="?pagina=usuario&metodo=cadastrarPost">
            <div class="form-row">
                <div class="col-md-6 form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="col-md-6 form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 form-group">
                    <label for="senha">Senha</label>
                    <input type="text" class="form-control" id="senha" name="senha" required>
                </div>
                <div class="col-md-6 form-group">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo" class="form-control">
                        <option value="Admin">Admin</option>
                        <option value="Funcionário">Funcionário</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Cadastrar</button>
        </form>
    </div>
</div>