<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/cadastro.css">

    <!--Icons...-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <div class="box">
        <form class="animate__animated animate__fadeInDownBig" action="" method="post" autocomplete="off">
            <h2>Cadastro</h2>

            <div class="inputBox">
                <label for=""></label>
                <input type="text" name="cpf" id="input" required="required">
                <span>CPF</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" name="nome" id="input" required="required">
                <span>Nome</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="email" name="email" id="input" required="required">
                <span>Email</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="number" name="idade" id="input" required="required">
                <span>Idade</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" name="senha" id="input" required="required">
                <span>Senha</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" name="confirmasenha" id="input" required="required">
                <span>Confirme a Senha</span>
                <i></i>
            </div>
            <input type="submit" value="Cadastrar" name="submit">

            <div class="form-iconBack">
            <a href="login.php"><i class='bx bx-arrow-back'></i></a>
            </div>
           
            
            <p class="erro"><?php

                            if (isset($_POST['submit'])) {

                                include_once('php/conexao.php');

                                $cpf = $_POST['cpf'];
                                $nome = $_POST['nome'];
                                $email = $_POST['email'];
                                $idade = $_POST['idade'];
                                $senha = $_POST['senha'];
                                $confirmasenha = $_POST['confirmasenha'];

                                // Extrai somente os números
                                $cpf = preg_replace('/[^0-9]/is', '', $cpf);

                                if (validarCampoUnico($conexao, $cpf)) {
                                    echo "Cpf já cadastrado";
                                } elseif (!validarCPF($cpf)) {
                                    echo "CPF inválido.";
                                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    echo "Email inválido";
                                } elseif ($senha != $confirmasenha) {
                                    echo "Confirme a senha corretamente";
                                } elseif (!validarSenha($senha)) {
                                    echo "Senha com no mínimo 8 caracteres";
                                } else {
                                    $result = mysqli_query($conexao, "INSERT INTO cadastros(cpf,nome,email,idade,senha) VALUES('$cpf','$nome','$email','$idade','$senha')");
                                    header("Location: login.php");
                                }
                            }
                            ?></p>
        </form>
    </div>
</body>

</html>


<?php
function validarCPF($cpf)
{
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

function validarCampoUnico(object $conexao, string $value)
{
    $sql = "SELECT * FROM cadastros WHERE cpf = '$value'";

    // Substitui o parâmetro :cpf pelo valor do CPF a ser verificado
    //$stmt->bindParam(':cpf', $value);

    // Executa a consulta
    $stmt = $conexao->query($sql);

    // Verifica se encontrou algum registro
    if ($stmt->num_rows > 0) {
        return true;
    }

    return false;
}

function validarSenha($senha)
{
    // Verificar o comprimento mínimo da senha
    if (strlen($senha) < 8) {
        return false;
    }

    // Verificar se a senha contém espaços em branco
    if (strpos($senha, ' ') !== false) {
        return false;
    }

    return true;
}
?>