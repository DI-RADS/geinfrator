import { DataTable } from "simple-datatables";

window.initDataTable = (selector) => {
    const table = document.querySelector(selector);
    if (!table) return;

    const dataTable = new DataTable(table, {
        perPage: 5,
        searchable: true,
        sortable: true,
        fixedHeight: true,
        labels: {
            placeholder: "Pesquisar...",
            perPage: "{select} resultados por página",
            noRows: "Nenhum resultado encontrado",
            info: "Mostrando {start} a {end} de {rows} registros",
        },
    });

    // Filtro por select
    const filterSelect = table.closest("div").querySelector("[data-datatable-filter]");
    const searchInput = table.closest("div").querySelector("[data-datatable-search]");

    if (filterSelect) {
        filterSelect.addEventListener("change", () => {
            const value = filterSelect.value.toLowerCase();

            dataTable.rows().forEach(row => {
                const tipo = row.cells[2].data.toLowerCase();
                if (!value || tipo.includes(value)) {
                    row.show();
                } else {
                    row.hide();
                }
            });
        });
    }

    if (searchInput) {
        searchInput.addEventListener("input", () => {
            dataTable.search(searchInput.value);
        });
    }

    return dataTable;
};
