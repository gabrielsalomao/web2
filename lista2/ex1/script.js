var colorpick1 = document.getElementById('colorpick1');
var colorpick2 = document.getElementById('colorpick2');
var buttonElement = document.querySelector('button');
var pagragrafosElement = document.querySelectorAll('p');

buttonElement.onclick = () => {
    pagragrafosElement.forEach(element => {
        element.style.backgroundColor = colorpick1.value;
        element.style.color = colorpick2.value;
    });
}

