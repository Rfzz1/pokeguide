const input = document.getElementById("searchInput");
const suggestions = document.getElementById("suggestions");
let selectedIndex = -1; // índice do item selecionado

function highlightPokemon(variety) {
    // remove destaque anterior
    document.querySelectorAll(".nome.highlight-name").forEach(el => el.classList.remove("highlight-name"));

    const rowId = "pokemon-" + variety.toLowerCase().replace(/[^a-z0-9]+/g, "-");
    const row = document.getElementById(rowId);

    if (row) {
        const nomeCell = row.querySelector(".nome");
        if (nomeCell) {
            nomeCell.classList.add("highlight-name");
            row.scrollIntoView({ behavior: "smooth", block: "center" });

            // animação do background amarelo que desaparece
            nomeCell.animate([
                { backgroundColor: '#363636ff' },
                { backgroundColor: 'transparent' }
            ], {
                duration: 1500,
                easing: 'ease-out',
                fill: 'forwards'
            });
        }
    } else {
        alert("Pokémon não encontrado na tabela!");
    }
}

// Atualiza lista de sugestões
input.addEventListener("input", () => {
    const value = input.value.toLowerCase().trim();
    suggestions.innerHTML = "";
    selectedIndex = -1;

    if (!value) return;
    const matches = pokemonList.filter(p => p.display.toLowerCase().includes(value)).slice(0, 8);

    matches.forEach((p, i) => {
        const li = document.createElement("li");
        li.classList.add("suggestion-item");

        const img = document.createElement("img");
        img.src = p.sprite || "img/default_poke.png";
        img.alt = p.display;
        img.classList.add("suggestion-sprite");

        const text = document.createElement("span");
        text.innerHTML = `<strong>${p.display}</strong><br><small>${p.tipo1 || '-'}${p.tipo2 ? '/' + p.tipo2 : ''}</small>`;

        li.appendChild(img);
        li.appendChild(text);

        li.addEventListener("click", () => {
            input.value = p.display;
            suggestions.innerHTML = "";
            highlightPokemon(p.variety);
        });

        suggestions.appendChild(li);
    });
});

// Navegação com setas e Enter
input.addEventListener("keydown", (e) => {
    const items = suggestions.querySelectorAll(".suggestion-item");
    if (!items.length) return;

    if (e.key === "ArrowDown") {
        e.preventDefault();
        selectedIndex = (selectedIndex + 1) % items.length;
    } else if (e.key === "ArrowUp") {
        e.preventDefault();
        selectedIndex = (selectedIndex - 1 + items.length) % items.length;
    } else if (e.key === "Enter") {
        e.preventDefault();
        if (selectedIndex >= 0 && selectedIndex < items.length) {
            items[selectedIndex].click();
        } else {
            const value = input.value.toLowerCase().trim();
            const match = pokemonList.find(p => p.display.toLowerCase() === value) ||
                          pokemonList.find(p => p.display.toLowerCase().includes(value));
            if (match) highlightPokemon(match.variety);
        }
        suggestions.innerHTML = "";
        return;
    } else {
        return;
    }

    items.forEach(item => item.classList.remove("active"));
    items[selectedIndex].classList.add("active");

    // preenche input com o item selecionado
    input.value = items[selectedIndex].querySelector("strong").textContent;
});

// Clique no botão de busca
document.getElementById("searchButton").addEventListener("click", () => {
    const value = input.value.toLowerCase().trim();
    if (!value) return;

    const match = pokemonList.find(p => p.display.toLowerCase() === value) ||
                  pokemonList.find(p => p.display.toLowerCase().includes(value));
    if (match) highlightPokemon(match.variety);

    suggestions.innerHTML = "";
});

// Efeito de rolagem do container
const searchContainer = document.querySelector('.search-container');
window.addEventListener('scroll', () => {
    const scrollY = window.scrollY;
    searchContainer.style.top = scrollY > 50 ? '12vh' : '16.5vh';
});
