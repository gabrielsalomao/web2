<div class="col s12 m7">
    <form class="col s12" method="post" action="?pagina=curso&metodo=createPost">

        <div class="card horizontal">
            <div class="card-stacked">
                <div class="card-content">
                    <h5>Cadastrar curso</h5>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="nome" name="nome" type="text" class="validate">
                            <label for="nome">Nome</label>
                        </div>
                        <div class="input-field col s6">
                            <select name="professor">
                                <?php
                                foreach ($professores as $professor) {
                                ?>
                                    <option value="<?= $professor->id ?>"><?= $professor->nome ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <label>Professor</label>
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