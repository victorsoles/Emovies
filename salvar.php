<?php

// Verifica se a requisição foi feita com o método POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("HTTP/1.0 405 Method Not Allowed");
    die("Método não permitido");
}

// Verifica se o token de segurança é válido
// $token = $_POST["token"];

// if ($token != "seu_token_aleatorio_aqui") {
//     header("HTTP/1.0 403 Forbidden");
//     die("Token de segurança inválido");
// }

// Configuração do banco de dados
$host = "localhost";
$user = "root";
$password = "";
$database = "emovies";

// Conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $database);

// Verifica se a conexão foi bem sucedida
if ($conn->connect_error) {
    header("HTTP/1.0 500 Internal Server Error");
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Obtém os dados do formulário
$nome = $_POST["nome"];
$diretor = $_POST["diretor"];
$categoria = $_POST["categoria"];
$sinopse = $_POST["sinopse"];

// Verifica se os campos obrigatórios foram preenchidos
if (empty($_POST["nome"]) || empty($_POST["diretor"]) || empty($_POST["categoria"]) || empty($_POST["sinopse"])) {
    die("Todos os campos são obrigatórios");
}

// Prepara os dados para inserção no banco de dados
$nome = $conn->real_escape_string($nome);
$diretor = $conn->real_escape_string($diretor);
$categoria = $conn->real_escape_string($categoria);
$sinopse = $conn->real_escape_string($sinopse);

// Verifica se uma imagem foi enviada
if (!empty($_FILES["imagem"])) {
    $imagem = $_FILES["imagem"];

    // Verifica se houve erro no upload da imagem
    if ($imagem["error"] != UPLOAD_ERR_OK) {
        header("HTTP/1.0 500 Internal Server Error");
        die("Erro no upload da imagem: " . $imagem["error"]);
    }

    // Verifica o tipo da imagem
    $allowed_types = array("image/jpeg", "image/png");

    if (!in_array($imagem["type"], $allowed_types)) {
        die("O tipo de imagem não é permitido");
    }

    // Salva a imagem em um diretório no servidor
    $upload_dir = "imagens/";
    $upload_file = $upload_dir . basename($imagem["name"]);

    if (!move_uploaded_file($imagem["tmp_name"], $upload_file)) {
        header("HTTP/1.0 500 Internal Server Error");
        die("Erro ao salvar a imagem no servidor");
    }

    // Salva o caminho da imagem no banco de dados
    $imagem = $conn->real_escape_string($upload_file);
} else {
    // Caso não tenha sido enviada uma imagem, utiliza uma imagem padrão
    $imagem = $conn->real_escape_string("imagens/default.jpg");
}

// Salva os dados no banco de dados
$sql = "INSERT INTO filmes (nome, diretor, categoria, sinopse, imagem) VALUES ('$nome', '$diretor', '$categoria', '$sinopse', '$imagem')";

if ($conn->query($sql) === TRUE) {
    echo "Filme cadastrado com sucesso!";
} else {
    header("HTTP/1.0 500 Internal Server Error");
    die("Erro ao cadastrar o filme no banco de dados: " . $conn->error);
}

// Fecha a conexão com o banco de dados
$conn->close();
