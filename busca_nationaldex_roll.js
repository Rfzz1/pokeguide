const input = document.getElementById("searchInput");
const suggestions = document.getElementById("suggestions");
let selectedIndex = -1; // índice do item selecionado

// função para dar highlight no nome da tabela
function highlightPokemon(name) {
    document.querySelectorAll(".nome.highlight-name").forEach(el => el.classList.remove("highlight-name"));

    const row = Array.from(document.querySelectorAll("tr")).find(tr => {
        const cell = tr.querySelector(".nome a");
        return cell && cell.textContent.toLowerCase() === name.toLowerCase();
    });

    if (row) {
        const nomeCell = row.querySelector(".nome");
        if (nomeCell) {
            nomeCell.classList.add("highlight-name");
            row.scrollIntoView({ behavior: "smooth", block: "center" });

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

// atualiza lista de sugestões
input.addEventListener("input", () => {
    const value = input.value.toLowerCase().trim();
    suggestions.innerHTML = "";
    selectedIndex = -1;

    if (!value) return;

    const matches = pokemonList.filter(p => p.name.toLowerCase().includes(value)).slice(0, 8);

    matches.forEach((p, i) => {
        const li = document.createElement("li");
        li.classList.add("suggestion-item");

        const img = document.createElement("img");
        img.src = p.sprite || "img/default_poke.png";
        img.alt = p.name;
        img.classList.add("suggestion-sprite");

        const text = document.createElement("span");
        text.innerHTML = `<strong>${p.name}</strong><br><small>${p.tipo1 || '-'}${p.tipo2 ? '/' + p.tipo2 : ''}</small>`;

        li.appendChild(img);
        li.appendChild(text);

        li.addEventListener("click", () => {
            input.value = p.name;
            suggestions.innerHTML = "";
            highlightPokemon(p.name);
        });

        suggestions.appendChild(li);
    });
});

// setas e Enter
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
            const value = input.value.trim();
            const match = pokemonList.find(p => p.name.toLowerCase() === value) ||
                          pokemonList.find(p => p.name.toLowerCase().includes(value));
            if (match) highlightPokemon(match.name);
        }
        suggestions.innerHTML = "";
        return;
    } else {
        return;
    }

    items.forEach(item => item.classList.remove("active"));
    items[selectedIndex].classList.add("active");
    input.value = items[selectedIndex].querySelector("strong").textContent;
});

// clique no botão de busca
document.getElementById("searchButton").addEventListener("click", () => {
    const value = input.value.trim();
    if (!value) return;

    const match = pokemonList.find(p => p.name.toLowerCase() === value) ||
                  pokemonList.find(p => p.name.toLowerCase().includes(value));
    if (match) highlightPokemon(match.name);

    suggestions.innerHTML = "";
});

// efeito de rolagem do container
const searchContainer = document.querySelector('.search-container');
window.addEventListener('scroll', () => {
    const scrollY = window.scrollY;
    searchContainer.style.top = scrollY > 50 ? '12vh' : '16.5vh';
});
