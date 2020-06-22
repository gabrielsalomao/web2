function exibirNumerosPares(de, ate) {
    if (de >= ate) {
        return console.log('Insire números válidos');
    }

    for (var i = de; i <= ate; i++) {
        if (i % 2 === 0)
            console.log(i);
    }
}

exibirNumerosPares(5, 20);