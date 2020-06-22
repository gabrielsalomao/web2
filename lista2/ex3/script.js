var ulElement = document.querySelector('ul');

var vetorDeNomes = ['Joãozinho', 'Maria', 'Ganriel'];

vetorDeNomes.map(nome => {
    var liElement = document.createElement('li');
    var textElement = document.createTextNode(nome);

    liElement.appendChild(textElement);
    ulElement.appendChild(liElement);
});