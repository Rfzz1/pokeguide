const input = document.getElementById("searchInput");
const suggestions = document.getElementById("suggestions");

function highlightPokemon(variety) {
    document.querySelectorAll('tr.highlight').forEach(tr => tr.classList.remove('highlight'));
    const rowId = 'pokemon-' + variety.toLowerCase().replace(/[^a-z0-9]+/g, '-');
    const row = document.getElementById(rowId);
    if (row) {
        row.classList.add('highlight');
        row.scrollIntoView({ behavior: 'smooth', block: 'center' });
    } else alert('Pokémon não encontrado na tabela!');
}

// Input
input.addEventListener("input", () => {
    const value = input.value.toLowerCase().trim();
    suggestions.innerHTML = "";
    if (!value) return;
    const matches = pokemonList.filter(p => p.display.toLowerCase().includes(value)).slice(0,6);
    matches.forEach(p => {
        const li = document.createElement("li");
        li.classList.add("suggestion-item");
        const img = document.createElement("img");
        img.src = p.sprite;
        img.alt = p.display;
        img.classList.add("suggestion-sprite");
        const text = document.createElement("span");
        text.innerHTML = `<strong>${p.display}</strong> <small>[${p.tipo1||'-'}${p.tipo2?'/'+p.tipo2:''}]</small>`;
        li.appendChild(img); li.appendChild(text);
        li.addEventListener("click", () => highlightPokemon(p.variety));
        suggestions.appendChild(li);
    });
});

// Enter
input.addEventListener("keydown", e => {
    if (e.key==="Enter") {
        e.preventDefault();
        const value = input.value.toLowerCase().trim();
        const match = pokemonList.find(p => p.display.toLowerCase()===value);
        if (match) highlightPokemon(match.variety);
    }
});
document.getElementById("searchButton").addEventListener("click", () => {
    const value = input.value.toLowerCase().trim();
    const match = pokemonList.find(p => p.display.toLowerCase()===value);
    if (match) highlightPokemon(match.variety);
});