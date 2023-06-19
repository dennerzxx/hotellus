<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    exit;
}

include 'connection.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $stmt = $conn->prepare("SELECT * FROM reservas");
    $stmt -> execute();
    $reservas = $stmt ->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($reservas);
    
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $entrada = $_POST['entrada'];
    $saida = $_POST['saida'];

    $stmt = $conn->prepare("INSERT INTO reservas (nome, email, entrada, saida) values (:nome, :email, :entrada, :saida)");

    $stmt -> bindParam(':nome', $nome);
    $stmt -> bindParam(':email', $email);
    $stmt -> bindParam(':entrada', $entrada);
    $stmt -> bindParam(':saida', $saida);

    if($stmt->execute()){
        echo 'Reserva cadastrada com sucesso!';
    }else{
        echo 'Erro ao cadastrar o reserva';
    }
}

if($_SERVER['REQUEST_METHOD']==='PUT' && isset($_GET['id'])){
    parse_str(file_get_contents("php://input"), $_PUT);


    $id = $_GET['id'];
    $novoNome = $_PUT['nome'];
    $novoEmail = $_PUT['email'];
    $novaEntrada = $_PUT['entrada'];
    $novaSaida = $_PUT['saida'];

    $stmt = $conn->prepare("UPDATE reservas SET nome = :nome, email = :email, entrada = :entrada, saida = :saida WHERE id = :id");
    $stmt->bindParam(':nome', $novoNome);
    $stmt->bindParam(':email', $novoEmail);
    $stmt->bindParam(':entrada', $novaEntrada);
    $stmt->bindParam(':saida', $novaSaida);
    $stmt->bindParam(':id', $id);


    if($stmt->execute()){
        echo "Reserva atualizada com sucesso!!";

    } else{
        echo "Erro ao atualizar reserva!!";
    }

}

if($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM reservas WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if($stmt->execute()){
        echo "Reserva excluida com sucesso!!";
    } else {
        echo "Erro ao excluir Reserva";
    }
}

?>