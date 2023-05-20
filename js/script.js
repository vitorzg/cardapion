var senhaInput = document.getElementById("senha");
var confsenhaInput = document.getElementById("confsenha");
var submitButton = document.getElementById("submit");
var avisoSenha = document.getElementById("aviso_senha");

avisoSenha.style.display = "none";

function verificarSenhas() {
  var senha = senhaInput.value;
  var confsenha = confsenhaInput.value;

  if (senha === confsenha) {
    submitButton.disabled = false; 
    avisoSenha.style.display = "none"; 
  } else {
    submitButton.disabled = true; 
    avisoSenha.style.display = "block";
  }
}

senhaInput.addEventListener("input", verificarSenhas);
confsenhaInput.addEventListener("input", verificarSenhas);
