function definirCategoriaPorIdade(idade) {
    if (idade <= 7)
        return "Infantil A";
    else if (idade >= 8 && idade <= 10)
        return 'Infantil B';
    else if (idade >= 11 && idade <= 12)
        return 'Infantil C';
    else if (idade >= 13 && idade <= 17)
        return 'Juvenil';
    else if (idade >= 17)
        return 'Adulto';
}

var idade = definirCategoriaPorIdade(18);

console.log(idade)