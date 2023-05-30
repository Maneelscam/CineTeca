<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/cadastro.css">
</head>

<body>

    <div class="box">
        <form class="animate__animated animate__fadeInDownBig" action="" method="post" autocomplete="off">
            <h2>LOGIN</h2>

            <div class="inputBox">
                <label for=""></label>
                <input type="text" name="cpf" id="input" required="required">
                <span>CPF</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" name="senha" id="input" required="required">
                <span>Senha</span>
                <i></i>
            </div>
            <div class="links">
                <a href="#">Esqueci a senha</a>
                <a href="cadastro.php">Cadastre-se</a>
            </div>

            <input type="submit" value="Entrar" name="submit">
            <p class="erro">
                <?php
                if (isset($_POST['submit'])) {
                    session_start();
                    $cpf_post = $_POST['cpf'];
                    $senha_post = $_POST['senha'];
                    include_once('php/conexao.php');

                    // Extrai somente os números
                    $cpf_post = preg_replace('/[^0-9]/is', '', $cpf_post);
                    $sql = "SELECT * FROM cadastros WHERE cpf LIKE '" . $cpf_post . "' AND senha LIKE '" . $senha_post . "'";
                    $result = $conexao->query($sql);
                    if (!$result) {
                        echo "Houve um erro!";
                    } else {
                        if ($result->num_rows < 1) {
                            echo "Cpf ou senha incorretos!";
                        } else {
                            $usuario_logado = mysqli_fetch_assoc($result);
                            $_SESSION['nome'] = $usuario_logado['nome'];
                            header("Location:index.html");
                        }
                    }
                }
                ?>
            </p>
        </form>
    </div>

</body>

</html>