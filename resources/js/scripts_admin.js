
//Validação do Campo Preço 
document.addEventListener("DOMContentLoaded", function() {
    const input = document.querySelector('.preco-mask');

    function formatCurrency(value) {
        // Remove tudo que não é número
        value = value.replace(/\D/g, '');
        // Converte para centavos
        value = (Number(value) / 100).toFixed(2);
        // Formata para moeda Angolana
        return value.replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    input.addEventListener('input', function(e) {
        let cursorPosition = this.selectionStart;
        let originalLength = this.value.length;

        this.value = 'KZ$ ' + formatCurrency(this.value);

        let newLength = this.value.length;
        cursorPosition = cursorPosition + (newLength - originalLength);
        this.setSelectionRange(cursorPosition, cursorPosition);
    });

    // Inicializa o valor caso esteja vazio
    if(!input.value) {
        input.value = 'KZ$ 0,00';
    }
});



















// Receber o seletor do campo preço
let inputPrice = document.getElementById("price");

// Verificar se existe o seletor no HTML
if (inputPrice) {
    // Aguardar o usuário digitar valor no campo
    inputPrice.addEventListener("input", function () {
        // Obter o valor atual removendo qualquer caractere que não seja número
        let valuePrice = this.value.replace(/[^\d]/g, "");

        // Adicionar os separadores de milhares
        var formattedPrice =
            valuePrice.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, ".") +
            "" +
            valuePrice.slice(-2);

        // Adicionar a vírgula e até dois dígitos se houver centavos
        if (formattedPrice.length > 2) {
            formattedPrice =
                formattedPrice.slice(0, -2) + "," + formattedPrice.slice(-2);
        }

        // Atualizar o valor do campo
        this.value = formattedPrice;
    });
}

// ======================== FOTO PREVIEW ========================
document.addEventListener("DOMContentLoaded", function () {
    const inputFile = document.getElementById("foto");
    const previewImg = document.getElementById("imagePreview");
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

// ======================== GRUPO DE CRIMES ========================
document.addEventListener("DOMContentLoaded", function () {
    var inputSelectGrupo = document.querySelector("#grupoCrime_id");
    var inputSelectCrime = document.querySelector("#crime_id");
    var elementoComRota = document.getElementById("rotadeCrimes");

    if (inputSelectGrupo && inputSelectCrime && elementoComRota) {
        var buscarCrimesnaBD = elementoComRota.dataset.route;
        axios.defaults.headers.common["X-CSRF-TOKEN"] =
            document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        inputSelectGrupo.addEventListener("change", () => buscarnaBdCrimes());

        function buscarnaBdCrimes() {
            inputSelectCrime.innerHTML = '<option value="">Carregando...</option>';
            axios
                .post(buscarCrimesnaBD, { grupoCrime_id: inputSelectGrupo.value })
                .then((response) => {
                    inputSelectCrime.innerHTML = `<option value="">Selecione a opção</option>`;
                    response.data.forEach((row) => {
                        inputSelectCrime.innerHTML += `<option value="${row.id}">${row.designacao_crime}</option>`;
                    });
                })
                .catch((error) => console.error("Erro ao carregar os crimes:", error));
        }
    }
});


// ======================== ATIVIDADES ========================
document.addEventListener("DOMContentLoaded", function () {
    const tipoAtividadeSelect = document.getElementById("tipo_atividade_id");
    const atividadeSelect = document.getElementById("atividade_id");

    if (tipoAtividadeSelect && atividadeSelect) {
        tipoAtividadeSelect.addEventListener("change", function () {
            const tipoAtividadeId = this.value;
            atividadeSelect.innerHTML = "<option>Carregando...</option>";

            if (tipoAtividadeId) {
                axios
                    .get(`/atividades?tipo_atividade_id=${tipoAtividadeId}`)
                    .then((response) => {
                        atividadeSelect.innerHTML = "<option>Selecione uma opção</option>";
                        response.data.forEach((atividade) => {
                            atividadeSelect.innerHTML += `<option value="${atividade.id}">${atividade.designacao_actividade}</option>`;
                        });
                    })
                    .catch(() => {
                        atividadeSelect.innerHTML = "<option>Erro ao carregar atividades</option>";
                    });
            } else {
                atividadeSelect.innerHTML = "<option>Selecione uma opção</option>";
            }
        });
    }
});

// ======================== MINISTÉRIO / RAMO / POSTO ========================
document.addEventListener("DOMContentLoaded", function () {
    const ministerioSelect = document.getElementById("ministerio");
    const ramoSelect = document.getElementById("ramo");
    const postoSelect = document.getElementById("posto");

    if (ministerioSelect && ramoSelect && postoSelect) {
        ministerioSelect.addEventListener("change", function () {
            const ministerioId = ministerioSelect.value;
            if (ministerioId) {
                axios.get(`/ramos-ministerio?ministerio_id=${ministerioId}`)
                    .then((response) => {
                        ramoSelect.innerHTML = "<option>Selecione um Ramo</option>";
                        postoSelect.innerHTML = "<option>Selecione um Posto</option>";
                        response.data.forEach((ramo) => {
                            if (ramo.id !== 1) {
                                ramoSelect.innerHTML += `<option value="${ramo.id}">${ramo.designacao_ramo}</option>`;
                            }
                        });
                    })
                    .catch((error) => console.error(error));
            }
        });

        ramoSelect.addEventListener("change", function () {
            const ramoId = ramoSelect.value;
            if (ramoId) {
                axios.get(`/postos-militar?ramo_id=${ramoId}`)
                    .then((response) => {
                        postoSelect.innerHTML = "<option>Selecione um Posto</option>";
                        const ramoIdInt = parseInt(ramoId);
                        response.data.forEach((posto) => {
                            let designacao = posto.designacao_posto;
                            if (ramoIdInt === 4) designacao = posto.designacao_mga;
                            else if (ramoIdInt === 5) designacao = posto.designacao_pna;
                            else if (ramoIdInt === 6) designacao = posto.designacao_sic;
                            else if (ramoIdInt === 7) designacao = posto.designacao_sme;
                            else if (ramoIdInt === 9) designacao = posto.designacao_spcb;
                            else if (ramoIdInt === 8) designacao = posto.designacao_sp;
                            postoSelect.innerHTML += `<option value="${posto.id}">${designacao}</option>`;
                        });
                    })
                    .catch((error) => console.error(error));
            }
        });
    }
});

// ======================== APAGAR COM SWEETALERT ========================
document.querySelectorAll(".btnDelete").forEach(function (button) {
    button.addEventListener("click", function (event) {
        event.preventDefault();
        var deleteId = this.getAttribute("data-delete-id");
        if (deleteId && document.getElementById(`formDelete${deleteId}`)) {
            Swal.fire({
                title: "Tem certeza?",
                text: "Você não poderá reverter isso!",
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: "#0d6efd",
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Sim, excluir!",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`formDelete${deleteId}`).submit();
                }
            });
        }
    });
});

// ======================== CAMPO ALTURA ========================
document.addEventListener("DOMContentLoaded", function () {
    const alturaInput = document.getElementById("altura");
    if (alturaInput) {
        alturaInput.addEventListener("input", function (event) {
            let value = event.target.value.replace(/[^0-9.]/g, "");
            let parts = value.split(".");
            if (parts.length > 2) value = parts[0] + "." + parts.slice(1).join("");
            if (parts[0].length > 1) {
                value = parts[0][0] + "." + parts[0].slice(1) + (parts[1] || "");
            }
            if (parts.length === 2) {
                parts[1] = parts[1].slice(0, 2);
                value = parts[0] + "." + parts[1];
            }
            event.target.value = value;
        });
    }
});

// ======================== BI (número de documento) ========================
document.addEventListener("DOMContentLoaded", function () {
    const inputField = document.querySelector('input[name="numero_documento"]');
    if (inputField) {
        inputField.addEventListener("input", function () {
            let value = inputField.value.replace(/[^0-9A-Za-z]/g, "");
            let numbers1 = value.substring(0, 9).replace(/[^0-9]/g, "");
            let letters = value.substring(9, 11).replace(/[^A-Za-z]/g, "").toUpperCase();
            let numbers2 = value.substring(11, 14).replace(/[^0-9]/g, "");
            inputField.value = numbers1 + letters + numbers2;
        });
    }
});

// ======================== SELECT2 ========================
$(function () {
    if ($(".select2").length) {
        $(".select2").select2({ theme: "bootstrap-5" });
    }
});