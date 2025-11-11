// MENU LATERAL
function toggleMenu() {
  document.getElementById("menu-lateral").classList.toggle("active");
}

// FECHAR MENU AO CLICAR FORA
document.addEventListener("click", function(event) {
  const menuLateral = document.getElementById("menu-lateral");
  const menuHamburguer = document.querySelector(".menu-hamburguer");

  // Verifica se o clique foi fora do menu e do botão
  if (
    menuLateral.classList.contains("active") && // menu está aberto
    !menuLateral.contains(event.target) && // clique não foi dentro do menu
    !menuHamburguer.contains(event.target) // clique não foi no botão
  ) {
    menuLateral.classList.remove("active"); // fecha o menu
  }
});

// MENU HAMBURGUER - animação ao rolar a página
let menu = document.querySelector('.menu-hamburguer');
window.addEventListener('scroll', function() {
  let scrollAtual = window.pageYOffset || document.documentElement.scrollTop;
  if (scrollAtual > 50) {
    menu.style.top = '-10.97vh';
  } else {
    menu.style.top = '18vh';
  }
});
