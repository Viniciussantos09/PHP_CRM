function toggleMenu() {
    var menu = document.getElementById("menu-links");
    if (menu.classList.contains("show")) {
        menu.style.transform = "translateX(-100%)";  // Move o menu para fora da tela
        menu.style.opacity = "0";  // Torna o menu invisível
        setTimeout(function() {
            menu.classList.remove("show");  // Remove a classe após a transição
        }, 300);  // O tempo aqui deve corresponder ao tempo da transição no CSS (0.3s)
    } else {
        menu.classList.add("show");  // Adiciona a classe
        setTimeout(function() {
            menu.style.transform = "translateX(0)";  // Move o menu para a tela
            menu.style.opacity = "1";  // Torna o menu visível
        }, 10);  // Pequeno atraso para garantir que a transição ocorra
    }
}


/**
 * Função para rolar o carrossel de imagens
 * @param {number} direction - 1 para rolar para a direita, -1 para rolar para a esquerda
 */
function scrollCarousel(direction) {
    const container = document.querySelector('.carousel-fluid__list');
    const containerWidth = container.offsetWidth;
    const scrollAmount = containerWidth * 1.25; // Rola 90% da largura visível
    container.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
}


function toggleProponente() {
    var fields = document.getElementById('proponente_fields');
    if (fields.style.display === "none") {
        fields.style.display = "block";
    } else {
        fields.style.display = "none";
    }
}


function confirmLogout() {
    return confirm("Você tem certeza que deseja sair?");
}

