import "./bootstrap";

// jQuery
import $ from "jquery";
window.$ = window.jQuery = $;

// Bootstrap JS
import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;

// Plugins
import Choices from "choices.js";
import "choices.js/public/assets/styles/choices.min.css";

import Alpine from 'alpinejs'

window.Alpine = Alpine
Alpine.start()

import DataTable from "datatables.net";

document.addEventListener("DOMContentLoaded", () => {
    $(".datatable").each(function () {
        // Evita erro "Cannot reinitialise DataTable"
        if ($.fn.DataTable.isDataTable(this)) {
            return;
        }

        new DataTable(this, {
            responsive: true,
            autoWidth: false,
            pageLength: 10,
           
            order: [],
            dom: `
        <"flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4"
            <"datatable-length-wrapper"l>
            <"datatable-search-wrapper"f>
        >
        rt
        <"flex flex-col md:flex-row md:items-center md:justify-between gap-4 mt-4"
            i
            p
        >
    `,
            language: {
                lengthMenu: "_MENU_",
                search: "",
                searchPlaceholder: "Pesquisar...",
                info: "Exibindo _START_ a _END_ de _TOTAL_ registros",
                zeroRecords: "Nenhum resultado encontrado",
                paginate: {
                    previous: "‹",
                    next: "›",  
                },
                
            },
            
        });

        aplicarEstiloTailwind();
    });
});

// 🔥 FILTRO POR ENTIDADE (COLUNA 3)
const filtroEntidade = document.getElementById("filtro-entidade");

if (filtroEntidade) {
    filtroEntidade.addEventListener("change", () => {
        const valor = filtroEntidade.value;

        // coluna 3 = "Entidade" (começa do 0)
        dt.columns(3).search(valor).draw();
    });
}



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

//SCRIPT PARA GERIR SELECT DE INPUT COM CHOISE
document.addEventListener("DOMContentLoaded", function () {
    const anoSelect = document.getElementById("anoInscricao");

    if (anoSelect) {
        new Choices(anoSelect, {
            searchEnabled: true,
            searchPlaceholderValue: "Digite o Ano ...",
            shouldSort: false,
            itemSelectText: "",
            allowHTML: false,
        });
    }
});
//SCRIPT PARA GERIR SELECT DE INPUT COM SELECT2
document.addEventListener("DOMContentLoaded", function () {
    $("#tanoInscricao").select2({
        placeholder: "Digite ou selecione o ano",
        allowClear: true,
        width: "100%", // ocupa todo o espaço
        dropdownAutoWidth: true,
        theme: "classic",
    });
});

//SCRIPT PARA GERIR SITUACAO DO PROCESSO E MOSTRA A SUA DESCRIÇÃO AO USER
document
    .getElementById("situacaoSelect")
    .addEventListener("change", function () {
        const selectedOption = this.options[this.selectedIndex];
        const descricao = selectedOption.getAttribute("data-descricao");

        const descricaoEl = document.getElementById("descricaoSituacao");

        if (descricao) {
            descricaoEl.textContent = descricao;
            descricaoEl.classList.remove("hidden");
        } else {
            descricaoEl.textContent = "";
            descricaoEl.classList.add("hidden");
        }
    });

//SCRIPT PARA GERIR SITUACAO DO PROCESSO E MOSTRA A SUA DESCRIÇÃO AO USER
document
    .getElementById("entidadejudidical")
    .addEventListener("change", function () {
        const selectedOption = this.options[this.selectedIndex];
        const descricao = selectedOption.getAttribute("data-descricao");

        const descricaoEl = document.getElementById("descricaoentidade");

        if (descricao) {
            descricaoEl.textContent = descricao;
            descricaoEl.classList.remove("hidden");
        } else {
            descricaoEl.textContent = "";
            descricaoEl.classList.add("hidden");
        }
    });

// ======================== FOTO PREVIEW ========================
document.addEventListener("DOMContentLoaded", function () {
    const inputFile = document.getElementById("tfoto");
    const previewImg = document.getElementById("timagePreview");
    if (inputFile && previewImg) {
        const defaultImg = previewImg.src;
        inputFile.addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => (previewImg.src = e.target.result);
                reader.readAsDataURL(file);
            } else {
                previewImg.src = defaultImg;
            }
        });
    }
});
// SELECIONAR O TIPO DE INFRAÇÃO E MOSTRAR INFRAÇOES
document.addEventListener("DOMContentLoaded", function () {
    const tipoSelect = document.getElementById("tipo_infracao");
    const infracaoSelect = document.getElementById("selected_infracao");

    // Segurança: se não existir, não executa
    if (!tipoSelect || !infracaoSelect) return;
    tipoSelect.addEventListener("change", function () {
        // Lê as infrações do atributo data-infracoes
        const infractions = JSON.parse(
            this.selectedOptions[0].dataset.infracoes || "[]"
        );

        // Limpa o select
        infracaoSelect.innerHTML =
            '<option value="" selected disabled>Selecione uma t opção</option>';

        infractions.forEach((inf) => {
            const opt = document.createElement("option");
            opt.value = inf.id;
            opt.textContent = inf.designacao_infracao;
            infracaoSelect.appendChild(opt);
        });
    });
});
