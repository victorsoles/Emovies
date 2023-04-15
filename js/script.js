function enviar() {
    document.getElementById("submitForm").reset();
}

function sair() {
    const resposta = confirm("Você tem certeza que deseja sair?");
    if (resposta == true) {
        window.location.href = "../Login/login.html"; // redireciona para a página de login se a resposta for "sim"
    } else {
        return
    }
}