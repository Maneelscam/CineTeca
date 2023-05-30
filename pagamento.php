<!-- 
    Essa é a tela de pagamento.
    A ideia aqui é criar um efeito de acordeom onde quando o cliente selecionar o dia que ele quer vê o filme a opção de baixo seja librada para que ele selecione o filme e assim vai sucetivamente.

    O update das datas é feito automaticamente pelo javascript assim ele mantem atualizado na pagina o dia de hoje e os 2 dias seguintes ( limitação de compra ate 2 dias posteriores devido a alta frequencia de alteração dos filmes em cartaz)

    A função filmes em cartaz utiliza um código php para pega do banco de dados o filme que esta em exibição e cria os li de acordo com a quantidade de filmes

    O evento onclick "selecionarLi" foi criado para que quando o usuario clicar no li seja pego o id do li( que é igual ao id do filme no banco) e o background mude para verde indicando que aquele li foi selecionado

    o código ajax dentro desse onclick serve para passar esse id para o php assim seria possivel fazer uma consulta no banco para exibir só as sessões referentes ao filme selecionado

    Na etapa de tipo ingresso a quantidade deve ser no maximo de 6 ingressos por compra, e ao selecionar a quantidade de ingressos de cada tipo ( meia e inteira ) será exibido o valor total da compra no momento

    forma de pagamento inicialmente será só pix

    "No momento a minha maior dificuldade é integrar os códigos php e javascript, além disso estou na duvida se posteriormente não teria problemas por estar usando li como "botoes, o efeito acordeom coloquei como ultimo recurso a ser implementado por ser puramente visual, dando assim preferencia aos códigos php"
    -->







<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineTeca</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/payment.css">
</head>

<body>
    <main>

        <div class="accordion-item">
            <div class="accordion-header">
                <p>Selecione o Dia</p>
            </div>
            <div class="accordion-content">
                <ul>
                    <li id="date1" class="li-red"></li>
                    <li id="date2"></li>
                    <li id="date3"></li>
                </ul>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-header">
                <p>Selecione o Filme</p>
            </div>
            <div class="accordion-content">
                <ul id="filmes">
                    <?php filmesemcartaz(); ?>
                </ul>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-header">
                <p>Selecione o Horario</p>
            </div>
            <div class="accordion-content">
                <ul id="horario">


                </ul>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-header">
                <p>Tipo de Ingresso</p>
            </div>
            <div class="accordion-content">
                <p>Quantidade</p>
                <input type="number" name="" id="">
                <p>Meia</p>
                <select name="" id="">
                    <option selected value="Qtd">Qtd</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
                <p>Inteira</p>
                <select name="" id="">
                    <option selected value="Qtd">Qtd</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>

            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-header">
                <p>Forma de Pagamento</p>
            </div>
            <div class="accordion-content">
                <ul>
                    <li><a href="">Pix</a></li>
                </ul>
            </div>
        </div>
        <div>
            <input class="button-voltar" type="button" value="Voltar">
            <input class="button-compra" type="button" value="Finalizar Compra">
        </div>

    </main>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/pagamento.js"></script>

</html>

<?php

function filmesemcartaz()
{
    // Código PHP para recuperar os nomes dos filmes do banco de dados
    include_once('php/conexao.php');

    $query = "SELECT idfilmes, nome FROM filmes";
    $result = mysqli_query($conexao, $query);

    $filmes = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $filmes[] = $row;
    }

    // Código para jogar na tela os filmes contidos no banco de dados

    foreach ($filmes as $filme) :
        // JavaScript para criar o elemento <li> com o nome do filme como innerHTML
        echo "<li id='" . $filme["idfilmes"] . "' onclick=\"selecionarLi(this.id)\">" . $filme["nome"] . "</li>";
    endforeach;
    mysqli_close($conexao);
}
$valor = $_POST['valor'];
echo $valor;
function horariosfilme()
{


    $valor = $_POST['valor'];
    include_once('php/conexao.php');

    $query = "SELECT sessao.Sala,sessao.horario,sessao.idioma FROM sessao INNER JOIN filmes ON sessao.idfilme = filmes.idfilmes WHERE filmes.idfilmes = $valor";

    $result = mysqli_query($conexao, $query);

    $sessoes = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $sessoes[] = $row;
    }

    foreach ($sessoes as $sessao) :

        // JavaScript para criar o elemento <li> com o nome do filme como innerHTML
        echo "<li id='" . $sessao["idsessao"] . "'>" . $sessao["sala"] . $sessao["horario"] . $sessao["idioma"] . "</li>";

    endforeach;
}


?>