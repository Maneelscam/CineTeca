const carrosselItems = document.querySelectorAll('.carrossel-item');
const indicadores = document.querySelectorAll('.carrossel-indicadores span');

let indiceAtual = 0;

function exibirSlide(indice) {
    // Remove a classe 'active' de todos os itens e indicadores
    carrosselItems.forEach(item => item.classList.remove('active'));
    indicadores.forEach(indicador => indicador.classList.remove('active'));

    // Adiciona a classe 'active' ao item e indicador atual
    carrosselItems[indice].classList.add('active');
    indicadores[indice].classList.add('active');
}

function avancarSlide() {
    indiceAtual++;
    if (indiceAtual === carrosselItems.length) {
        indiceAtual = 0;
    }
    exibirSlide(indiceAtual);
}

function iniciarCarrossel() {
    setInterval(avancarSlide, 3000);
}

iniciarCarrossel();

/* ===================== icon-menu-mobile============== */

const botao_icon = document.querySelector("#mobile-menu-icon")
const nav = document.querySelector(".cabecalho-mobile")
botao_icon.onclick = function descermenu() {
    nav.classList.toggle("open")
    const isopen = nav.classList.contains("open")
    botao_icon.classList = isopen
        ? "fa-solid fa-xmark"
        : "fa-solid fa-bars"

}
/* ===================== FIM --- > > icon-menu-mobile============== */

/* ===================== INICIO -- > > icon-USER-NAV============== */

const user_icon = document.querySelector("#icon-user");
const navUser = document.querySelector(".user-nav-ul");
user_icon.onclick = function descermenu() {
    navUser.classList.toggle("open");
    const isopen = navUser.classList.contains("open");

};

/* ===================== FIM -- > > icon-USER-NAV============== */

