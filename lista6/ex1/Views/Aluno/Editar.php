<div class="col s12 m7">
    <form class="col s12" method="post" action="?pagina=aluno&metodo=editarPost">

        <div class="card horizontal">
            <div class="card-stacked">
                <div class="card-content">
                    <h5>Editar Aluno</h5>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="nome" name="nome" type="text" value="<?= $aluno->nome ?>" class="validate">
                            <label for="nome">Nome</label>
                        </div>
                        <div class="input-field col s6">
                            <select name="sexo">
                                <option value="M" selected>Masculino</option>
                                <option value="F">Feminina</option>
                            </select>
                            <label>Sexo</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input id="data_nascimento" name="data_nascimento" value="<?= $aluno->getDataFormatada() ?>" type="text" class="validate datepicker">
                            <label for="data_nascimento">Data de nascimento</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="registro" name="registro" type="number" class="validate">
                            <label for="registro">Registro</label>
                        </div>
                        <input type="hidden" name="cursos" id="cursos">
                        <div class="input-field col s4">
                            <select multiple id="cursosSelect" name="cursosSelect">
                                <option value="" disabled selected>Escolha</option>
                                <?php foreach ($cursos as $curso) { ?>
                                    <option value="<?= $curso->id ?>"><?= $curso->nome ?></option>
                                <?php } ?>
                            </select>
                            <label>Cursos</label>
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