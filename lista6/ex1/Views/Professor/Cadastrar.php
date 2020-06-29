<div class="col s12 m7">
    <form class="col s12" method="post" action="?pagina=professor&metodo=cadastrarPost">

        <div class="card horizontal">
            <div class="card-stacked">
                <div class="card-content">
                    <h5>Cadastrar professor</h5>
                    <div class="row">
                        <div class="input-field col s6">
                            <input required id="nome" name="nome" type="text" class="validate">
                            <label for="nome">Nome</label>
                        </div>
                        <div class="input-field col s6">
                            <input required id="registro" name="registro" type="number" class="validate">
                            <label for="registro">Registro</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input required id="titulacao" name="titulacao" type="text" class="validate">
                            <label for="titulacao">Titulação</label>
                        </div>
                        <div class="input-field col s6">
                            <select name="sexo">
                                <option value="M" selected>Masculino</option>
                                <option value="F">Feminina</option>
                            </select>
                            <label>Sexo</label>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Cadastrar
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>