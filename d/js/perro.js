const body = document.getElementById("myBody");
const item1 = document.getElementById("item-1");
const item2 = document.getElementById("item-2");
const item3 = document.getElementById("item-3");

body.style.backgroundColor = "green";


item1.addEventListener("change", function() {
  body.style.background = "linear-gradient(to bottom, #19950b, #000)";
});

item2.addEventListener("change", function() {
  body.style.background = "linear-gradient(to bottom,  #0074D9, #000)";
});

item3.addEventListener("change", function() {
  body.style.background = "linear-gradient(to bottom,  #e10202, #000)";
});