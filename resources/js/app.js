// Importação do seu bootstrap.js (axios, SweetAlert, Chart.js)
import "./bootstrap";

// jQuery - deve vir antes do DataTables
import $ from "jquery";
window.$ = window.jQuery = $;

// Bootstrap JS
import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;

// DataTables (deve vir **após o jQuery**)
import "datatables.net";
import "datatables.net-bs5";

//window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Inicializar DataTables após o carregamento do DOM
document.addEventListener("DOMContentLoaded", function () {
    if ($.fn.DataTable) {
        $(".datatable").DataTable({
            language: {
                info: "Mostrando _START_ até _END_ de _TOTAL_ registros",
                infoEmpty: "Nenhum registro disponível",
                infoFiltered: "(filtrado de _MAX_ registros totais)",
                lengthMenu: "Mostrar _MENU_ registros por página",
                search: "Pesquisar:",
                zeroRecords: "Nenhum resultado encontrado",
                paginate: {
                    first: "Primeiro",
                    last: "Último",
                    next: "Próximo",
                    previous: "Anterior",
                },
            },
            responsive: true, // Para melhor exibição em dispositivos móveis
            autoWidth: false, // Evita problemas de largura das colunas
            order: [], // Remove a ordenação automática da primeira coluna´
            columnDefs: [
                { targets: "_all", defaultContent: "-" }, // Evita erro se algum dado estiver faltando
                { targets: "no-sort", orderable: false }, // Classe CSS para desativar a ordenação em colunas específicas
                { targets: "text-start", className: "text-start" }, // Força alinhamento à esquerda onde necessário
            ],
        });
    } else {
        console.error("DataTables não foi carregado corretamente.");
    }
});

/**** Script para abrir/fechar o dropdown ****/
const dropdownButton = document.getElementById("userDropdownButton");
const dropdownContent = document.getElementById("dropdownContent");

dropdownButton.addEventListener("click", function () {
    const isOpen = dropdownContent.classList.contains("hidden");
    if (isOpen) {
        dropdownContent.classList.remove("hidden");
    } else {
        dropdownContent.classList.add("hidden");
    }
});

// Fechar o dropdown se clicar fora dele
window.addEventListener("click", function (event) {
    if (
        !dropdownButton.contains(event.target) &&
        !dropdownContent.contains(event.target)
    ) {
        dropdownContent.classList.add("hidden");
    }
});

/**** Apresentar e ocultar sidebar ****/
document.getElementById("toggleSidebar").addEventListener("click", function () {
    document.getElementById("sidebar").classList.toggle("sidebar-open");
});

document.getElementById("closeSidebar").addEventListener("click", function () {
    document.getElementById("sidebar").classList.remove("sidebar-open");
});

/**** Alterna entre tema claro e escuro ****/
document.addEventListener("DOMContentLoaded", function () {
    // Obter o elemento <html> para manipular a classe dark
    const htmlElement = document.documentElement;

    // Obter o id do botão tema claro e escuro
    const themeToggle = document.getElementById("themeToggle");

    // Obter o id do ícone escuro
    const iconMoon = document.getElementById("iconMoon");

    // Obter o id do ícone claro
    const iconSun = document.getElementById("iconSun");

    // Função para alternar os ícones claro e escuro
    function updateIcons() {
        if (htmlElement.classList.contains("dark")) {
            iconMoon.classList.remove("hidden");
            iconSun.classList.add("hidden");
        } else {
            iconMoon.classList.add("hidden");
            iconSun.classList.remove("hidden");
        }
    }

    // Aplicar o tema salvo no localStorage ou a preferência do sistema
    const isDarkMode =
        localStorage.theme === "dark" || // Se o localStorage.theme for "dark", ativa o modo escuro
        (!("theme" in localStorage) &&
            window.matchMedia("(prefers-color-scheme: dark)").matches);
    // Se NÃO houver um tema salvo no localStorage, verifica se o sistema está em dark mode

    htmlElement.classList.toggle("dark", isDarkMode);
    updateIcons(); // Atualiza os ícones na inicialização

    // Evento de clique para alternar o tema e os ícones
    themeToggle.addEventListener("click", function () {
        htmlElement.classList.toggle("dark");
        localStorage.theme = htmlElement.classList.contains("dark")
            ? "dark"
            : "light";
        updateIcons(); // Atualiza os ícones após alterar o tema
    });
});

// Função para apresentar o SweetAlert2 para confirmar a exclusão
window.confirmDelete = function (id) {
    Swal.fire({
        title: "Tem certeza?",
        text: "Essa ação não pode ser desfeita!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sim, excluir!",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("delete-form-" + id).submit();
        }
    });
};

/****** Academia de softwares estilo******/
document.addEventListener("DOMContentLoaded", () => {
    // Todos os botões que controlam dropdowns
    const dropdownToggles = document.querySelectorAll("[data-dropdown-toggle]");

    dropdownToggles.forEach((button) => {
        const targetId = button.getAttribute("data-dropdown-toggle");
        const dropdown = document.getElementById(targetId);
        const icon = button.querySelector("svg");

        button.addEventListener("click", (e) => {
            e.preventDefault();

            // Alternar a visibilidade do dropdown
            dropdown.classList.toggle("hidden");

            // Rotacionar ícone
            icon.classList.toggle("rotate-180");
        });

        // Fechar ao clicar fora
        document.addEventListener("click", (e) => {
            if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add("hidden");
                icon.classList.remove("rotate-180");
            }
        });
    });
});

//Futura definicão dos campos
//Validação do Campo Preço
document.addEventListener("DOMContentLoaded", function () {
    const input = document.querySelector(".preco_kwanza");

    function formatCurrency(value) {
        value = value.replace(/\D/g, ""); // remove não números
        value = (Number(value) / 100).toFixed(2); // converte centavos
        return value.replace(".", ",").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    input.addEventListener("input", function (e) {
        let cursorPosition = this.selectionStart;
        let originalLength = this.value.length;

        this.value = "KZ$ " + formatCurrency(this.value);

        let newLength = this.value.length;
        cursorPosition = cursorPosition + (newLength - originalLength);
        this.setSelectionRange(cursorPosition, cursorPosition);
    });

    // Inicializa o valor caso esteja vazio
    if (!input.value) {
        input.value = "KZ$ 0,00";
    }
});

//Mostar Imgame ao fazer upload
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("photoInput");
    const preview = document.getElementById("photoPreview");

    input.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                preview.src = reader.result; // substitui a imagem pelo preview
            });

            reader.readAsDataURL(file);
        }
    });
});

/* *+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
/*                           FILTRAGENS NOS CAMPOS DOS FORMULARIOS                              */
/* *+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */

// SELECIONAR CATEGORIA E MOSTRAR MARCAS DESTA CATEGORIA
document.addEventListener("DOMContentLoaded", function () {
    const categoriaSelect = document.getElementById("categoriaSelect");
    const marcaSelect = document.getElementById("marcaSelect");

    categoriaSelect.addEventListener("change", function () {
        const categoriaId = this.value;

        Array.from(marcaSelect.options).forEach((option) => {
            if (option.value === "") return; // mantém o "Selecione"
            option.style.display =
                option.dataset.categoria === categoriaId ? "block" : "none";
        });

        marcaSelect.value = ""; // reseta a seleção
    });
});

//SCRIPT PARA GERIR A QUANTIDADE DE ITEM DO PRODUTO E SERIES
document.addEventListener("DOMContentLoaded", function () {
    const hasSeriesCheckbox = document.getElementById("hasSeriesCheckbox");
    const quantidadeBox = document.getElementById("quantidadeBox");
    const boxSerie = document.getElementById("boxSerie");
    const estadoGeralBox = document.getElementById("estadoGeralBox");

    const inputSerie = document.getElementById("inputSerie");
    const inputEstadoSerie = document.getElementById("inputEstadoSerie");
    const btnAddSerie = document.getElementById("btnAddSerie");
    const seriesTableBody = document.getElementById("seriesTableBody");
    const seriesJsonInput = document.getElementById("seriesJson");

    let seriesList = [];

    hasSeriesCheckbox.addEventListener("change", function () {
        if (this.checked) {
            boxSerie.style.display = "block";
            quantidadeBox.style.display = "none";
            estadoGeralBox.style.display = "none";
        } else {
            boxSerie.style.display = "none";
            quantidadeBox.style.display = "block";
            estadoGeralBox.style.display = "block";
        }
    });

    btnAddSerie.addEventListener("click", function () {
        const serie = inputSerie.value.trim();
        const estadoId = inputEstadoSerie.value;

        if (!serie || !estadoId) {
            alert("Preencha série e estado corretamente.");
            return;
        }

        if (seriesList.some((item) => item.serie === serie)) {
            alert("Este número de série já existe.");
            return;
        }

        const estadoText =
            inputEstadoSerie.options[inputEstadoSerie.selectedIndex].text;

        seriesList.push({
            serie,
            estadoId,
            estadoText,
        });

        atualizarTabela();
        inputSerie.value = "";
        inputEstadoSerie.value = "";
    });

    function atualizarTabela() {
        seriesTableBody.innerHTML = "";
        seriesList.forEach((item, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td class="p-2">${index + 1}</td>
                <td class="p-2">${item.serie}</td>
                <td class="p-2">${item.estadoText}</td>
                <td class="p-2">
                    <button type="button" class="px-2 py-1 bg-red-500 text-white rounded" onclick="removerSerie(${index})">Remover</button>
                </td>
            `;
            seriesTableBody.appendChild(row);
        });

        seriesJsonInput.value = JSON.stringify(seriesList);
    }

    window.removerSerie = function (index) {
        seriesList.splice(index, 1);
        atualizarTabela();
    };
});
