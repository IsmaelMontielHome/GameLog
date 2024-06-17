const caja1 = document.querySelector('#caja1');
const img1 = caja1.querySelector('img');

caja1.addEventListener('mouseover', () => {
  img1.src = 'img/xboxf.gif';
 
});

caja1.addEventListener('mouseout', () => {
  img1.src = 'img/xbox.png';

});

const caja2 = document.querySelector('#caja2');
const img2 = caja2.querySelector('img');

caja2.addEventListener('mouseover', () => {
  img2.src = 'img/nintendof.gif';
});

caja2.addEventListener('mouseout', () => {
  img2.src = 'img/nintendo.png';
});

const caja3 = document.querySelector('#caja3');
const img3 = caja3.querySelector('img');

caja3.addEventListener('mouseover', () => {
  img3.src = 'img/playf.gif';
});

caja3.addEventListener('mouseout', () => {
  img3.src = 'img/play.jpg';
});

const caja4 = document.querySelector('#caja4');
const img4 = caja4.querySelector('img');

caja4.addEventListener('mouseover', () => {
  img4.src = 'img/multif.gif';
});

caja4.addEventListener('mouseout', () => {
  img4.src = 'img/pc 1.jpg';
});

const caj1 = document.querySelector('#caja1');
const caj2 = document.querySelector('#caja2');
const caj3 = document.querySelector('#caja3');
const caj4 = document.querySelector('#caja4');

const body = document.querySelector('body');
const bodyColorOriginal = body.style.backgroundColor;

function getRandomColor() {
  const letters = "0123456789ABCDEF";
  let color = "#";
  for (let i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

caj1.addEventListener('mouseover', () => {
  body.style.background = "linear-gradient(to bottom, rgb(60, 255, 0), black)";
});

caj2.addEventListener('mouseover', () => {
  body.style.background = "linear-gradient(to bottom, red, black)";
});

caj3.addEventListener('mouseover', () => {
  body.style.background = "linear-gradient(to bottom, blue, black)";
});

caj4.addEventListener('mouseover', () => {
  const randomColor = getRandomColor();
  body.style.background = "linear-gradient(to bottom, rgb(57, 2, 57), black)";
});

caj1.addEventListener('mouseout', () => {
  body.style.background = bodyColorOriginal;
});

caj2.addEventListener('mouseout', () => {
  body.style.background = bodyColorOriginal;
});

caj3.addEventListener('mouseout', () => {
  body.style.background = bodyColorOriginal;
});

caj4.addEventListener('mouseout', () => {
  body.style.background = bodyColorOriginal;
});