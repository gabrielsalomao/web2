var vetorDeNomes = ['Gabriel', 'Adair', 'Laura'];

function possuiNomeNoVetor(vetor, nome) {
    return vetor.indexOf(nome) >= 0;
}

console.log(possuiNomeNoVetor(vetorDeNomes, 'Gabriel'));