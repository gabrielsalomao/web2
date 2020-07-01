<div class="modal fade" id="modalComanda" tabindex="-1" role="dialog" aria-labelledby="modalComandaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalComandaLabel">Nova Comanda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="item">Item</label>
                        <select class="form-control" id="comandaItens" name="comandaItens">
                            <option value="10">1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="comandaItemPreco">Preço</label>
                        <input type="text" class="form-control" disabled id="comandaItemPreco" name="comandaItemPreco">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="comandaItemQnt">Qnt</label>
                        <input type="number" class="form-control" id="comandaItemQnt" name="comandaItemQnt">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="" style="color: white;">Salvar</label>
                        <button onclick="inserirItemNaComanda()" class="btn btn-success form-control">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="comandaItemObservacao">Observação</label>
                        <textarea name="comandaItemObservacao" id="comandaItemObservacao" class="form-control">
                            </textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <div class="form-group col-md-2">
                    <div class="row">
                        <h5>Total: <span id="precoTotal">R$ 0.00</span></h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
            </div>
            <div class="modal-footer" id="itens">
            </div>
        </div>
    </div>
</div>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/8935557787.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
    var itensInseridosNaComanda = [];
    var itens = [];
    var itemSelectElement = document.getElementById("comandaItens");
    var qntInputElement = document.getElementById("comandaItemQnt");
    var precoInputElement = document.getElementById("comandaItemPreco");


    $("#comandaItens").change(function() {
        let id = $(this).children(":selected").attr("id");

        for (var item of itens) {
            if (item.id == id)
                precoInputElement.value = item.preco;
        }
    });

    function inserirItemNaComanda() {

        var novoItem = {
            nome: itemSelectElement.value,
            qnt: (Number(qntInputElement.value) || 1),
            preco: Number(precoInputElement.value)
        }

        itensInseridosNaComanda.push(novoItem);

        construirCorpoDosItensSelecionados(itensInseridosNaComanda);
    }

    function construirCorpoDosItensSelecionados(itens) {
        var corpoDivElement = document.getElementById('itens');
        var precoTotalSpanElement = document.getElementById("precoTotal");
        var valor = 0.00;
        var corpo = "";

        itens.map((item, index) => {
            corpo += `<div class="row"><div class="form-group col-md-6">
                    <input type="text" value="${item.nome}" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" value="${item.preco}" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" value="${item.qnt}" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <button onclick="deletarItemDaComanda(${index})" class="btn btn-danger form-control">
                    <span data-octicon="check"><i class="fas fa-trash"></i></span>
                    </button>
                </div>
                <div class="col-md-12 form-group">
                <hr>
                </div>
                </div>
                `;
            valor += item.preco;
        });
        corpoDivElement.innerHTML = corpo;
        precoTotalSpanElement.innerHTML = `R$ ${valor}`;
    }

    function deletarItemDaComanda(index) {
        itensInseridosNaComanda.splice(index, 1);

        var corpoDivElement = document.getElementById('itens');

        corpoDivElement.innerHTML = "";

        construirCorpoDosItensSelecionados(itensInseridosNaComanda);
    }

    function obterItens() {
        axios.get(`?pagina=item&metodo=obterTodos`).then((response) => {
            itens = response.data;
            var selectOption = "";

            for (var item of itens) {
                selectOption += `<option id="${item.id}">${item.nome} - R$ ${item.preco}</option>`;
            }

            itemSelectElement.innerHTML = selectOption;

            let id = $("#comandaItens").children(":selected").attr("id");

            for (var item of itens) {
                if (item.id == id)
                    precoInputElement.value = item.preco;
            }
        }).catch((erro) => {
            alert(erro)
        });
    }
</script>
</body>

</html>