var bodyElement = document.querySelector('body');
var buttonElement = document.querySelector('button');

buttonElement.onclick = () => {

    var divElement = document.createElement('div');

    divElement.style.backgroundColor = 'red';
    divElement.style.width = '100px';
    divElement.style.height = '100px';

    bodyElement.appendChild(divElement);
}