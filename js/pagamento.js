// Função para obter a data formatada como "dia/mês/ano"
function getFormattedDate(date) {
    const day = date.getDate();
    const month = date.getMonth() + 1;

    return `${day}/${month}`;
}

// Função para atualizar as datas nas divs
function updateDates() {
    const currentDate = new Date(); // Obtém a data atual

    const div1 = document.getElementById("date1");
    div1.textContent = "Hoje";

    const nextDate1 = new Date(currentDate);
    nextDate1.setDate(nextDate1.getDate() + 1);
    const div2 = document.getElementById("date2");
    div2.textContent = getFormattedDate(nextDate1);

    const nextDate2 = new Date(currentDate);
    nextDate2.setDate(nextDate2.getDate() + 2);
    const div3 = document.getElementById("date3");
    div3.textContent = getFormattedDate(nextDate2);
}

// Chamada inicial para atualizar as datas
updateDates();



function selecionarLi(id) {
    var elementos = document.querySelectorAll('#filmes li');
    for (var i = 0; i < elementos.length; i++) {
        elementos[i].style.background = '#a0a0a0';
    }

    var liSelecionado = document.getElementById(id);
    liSelecionado.style.background = 'green';

    $.ajax({
        url: "pagamento.php",
        method: "POST",
        data: { valor: id },
        success: function (response) {
            console.log("Valor enviado com sucesso!");
            // Faça algo com a resposta do servidor, se necessário
        },
        error: function () {
            console.log("Ocorreu um erro ao enviar o valor.");
        }
    });


}