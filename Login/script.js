const registerButton = document.getElementById("register");
const loginButton = document.getElementById("login");
const container = document.getElementById("container");

registerButton.addEventListener("click", () => {
  var alert = document.querySelector("#alertRegistro");
  container.classList.add("right-panel-active");
});

loginButton.addEventListener("click", () => {
  var alert = document.querySelector("#alertInicio");

  container.classList.remove("right-panel-active");
});