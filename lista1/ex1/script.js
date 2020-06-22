var endereco = {
    rua: "R. Taquarí",
    numero: 831,
    bairro: "Santo Antonio",
    cidade: "Campo Grande",
    uf: "MS",
    cep: 79100510
};

function mostrarEndereco() {
    return `O usuário mora em ${endereco.cidade}/${endereco.uf}, no bairro
     ${endereco.bairro}, na rua “${endereco.rua}” com nº ${endereco.numero}, CEP: ${endereco.cep}.`
}

console.log(mostrarEndereco());