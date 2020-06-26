<div class="col s12 m7">
    <form class="col s12" method="post" action="?pagina=professor&metodo=editPost">

        <div class="card horizontal">
            <div class="card-stacked">
                <div class="card-content">
                    <h5>Editar professor</h5>
                    <div class="row">
                        <input type="hidden" name="id" value="<?= $professor->id ?>">
                        <div class="input-field col s6">
                            <input value="<?= $professor->nome ?>" id="nome" name="nome" type="text" class="validate">
                            <label for="nome">Nome</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="registro" name="registro" value="<?= $professor->registro ?>" type="number" class="validate">
                            <label for="registro">Registro</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="titulacao" name="titulacao" value="<?= $professor->titulacao ?>" type="text" class="validate">
                            <label for="titulacao">Titulação</label>
                        </div>
                        <div class="input-field col s6">
                            <select name="sexo">
                                <?php if ($professor->sexo == "M") { ?>
                                    <option value="M" selected>Masculino</option>
                                    <option value="F">Feminina</option>
                                <?php } else { ?>
                                    <option value="M">Masculino</option>
                                    <option value="F" selected>Feminina</option>
                                <?php } ?>
                            </select>
                            <label>Sexo</label>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Editar
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>