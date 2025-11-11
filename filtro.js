
document.querySelectorAll('.filtro').forEach(btn => {
    btn.addEventListener('click', () => {
        const inicio = parseInt(btn.dataset.inicio);
        const fim = parseInt(btn.dataset.fim);

        document.querySelectorAll('table tr[data-numero]').forEach(tr => {
            const num = parseInt(tr.dataset.numero);
            if (num >= inicio && num <= fim) {
                tr.style.display = '';
            } else {
                tr.style.display = 'none';
            }
        });
    });
});

