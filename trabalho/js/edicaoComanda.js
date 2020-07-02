var edicaoItensInseridosNaComanda = [];
var edicaoItens = [];
var edicaoItemSelectElement = document.getElementById("edicaoComandaItens");
var edicaoQntInputElement = document.getElementById("edicaoComandaItemQnt");
var edicaoPrecoInputElement = document.getElementById("edicaoComandaItemPreco");
var edicaoObservacaoInputElement = document.getElementById("edicaoComandaObservacao");

function editarComanda(id) {
    axios.get(`?pagina=comanda&metodo=obterPorIdViaJson&id=${id}`).then((response) => {
        if (response.data.success == true) {
            edicaoItensInseridosNaComanda = [];
            response.data.message.itens.map((item) => {
                let novoItem = {
                    id: item.itemId,
                    nome: `${item.itemNome} - R$ ${item.itemPreco}`,
                    preco: item.itemPreco,
                    qnt: item.itemQnt
                };
                console.log(item)
                edicaoItensInseridosNaComanda.push(novoItem);
            });
            edicaoObterItens();
            edicaoConstruirCorpoDosItensSelecionados(edicaoItensInseridosNaComanda)
            $('#edicaoModalComanda').modal('toggle');
        } else {
            console.log(response.data);
        }
    }).catch((erro) => {
        alert(erro)
    });
}

// $("#comandaItens").change(() => {
//     let id = $(this).children(":selected").attr("id");

//     for (var item of itens) {
//         if (item.id == id)
//             precoInputElement.value = item.preco;
//     }
// });

function edicaoInserirItemNaComanda() {

    var novoItem = {
        id: Number($("#edicaoItemComandaItens").children(":selected").attr("id")),
        nome: edicaoItemSelectElement.value,
        qnt: (Number(edicaoQntInputElement.value) || 1),
        preco: Number(edicaoPrecoInputElement.value)
    }

    edicaoItensInseridosNaComanda.push(novoItem);

    edicaoConstruirCorpoDosItensSelecionados(edicaoItensInseridosNaComanda);
}

function edicaoConstruirCorpoDosItensSelecionados(itens) {
    let corpoDivElement = document.getElementById('edicaoItens');
    let precoTotalSpanElement = document.getElementById("edicaoComandaPrecoTotal");
    let valor = 0.00;
    let corpo = "";

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
                <button onclick="edicaoDeletarItemDaComanda(${index})" class="btn btn-danger form-control">
                <span data-octicon="check"><i class="fas fa-trash"></i></span>
                </button>
            </div>
            <div class="col-md-12 form-group">
            <hr>
            </div>
            </div>
            `;
        valor += item.preco * item.qnt;
    });

    corpoDivElement.innerHTML = corpo;
    precoTotalSpanElement.innerHTML = `R$ ${valor}`;
}

function edicaoDeletarItemDaComanda(index) {
    edicaoItensInseridosNaComanda.splice(index, 1);

    var corpoDivElement = document.getElementById('edicaoItens');

    corpoDivElement.innerHTML = "";

    edicaoConstruirCorpoDosItensSelecionados(edicaoItensInseridosNaComanda);
}

function edicaoObterItens() {
    axios.get(`?pagina=item&metodo=obterTodos`).then((response) => {
        edicaoItens = response.data;
        let edicaoSelectOption = "";

        for (let item of edicaoItens) {
            console.log(item)
            edicaoSelectOption += `<option id="${item.id}">${item.nome} - R$ ${item.preco}</option>`;
        }

        edicaoItemSelectElement.innerHTML = edicaoSelectOption;
        console.log(edicaoSelectOption)

        let id = $("#edicaoComandaItens").children(":selected").attr("id");

        for (let item of edicaoItens) {
            if (item.id == id)
                edicaoPrecoInputElement.value = item.preco;
        }
    }).catch((erro) => {
        alert(erro)
    });
}

// function cadastrarComanda() {
//     var data = new FormData();
//     data.append('title', 'itensInseridosNaComanda');
//     data.append('body', itensInseridosNaComanda);

//     axios.post('?pagina=comanda&metodo=cadastrarViaJson', {
//         observacao: observacaoInputElement.value || "",
//         itens: itensInseridosNaComanda
//     })
//         .then(response => {
//             if (response.data.success) {
//                 alert(response.data.message);
//                 location.reload();
//             } else {
//                 alert(response.data.message);
//             }
//         })
//         .catch(e => {
//             alert("erro de conexão")
//         });
// }