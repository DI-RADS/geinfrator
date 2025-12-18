$(document).ready(function () {
    $("#filtroListaRecluso").on("change", function () {
        const tipoLista = parseInt($(this).val()); // Converter para número

        // Resetar todas as divs e requisitos
        $("#divEstadoPrisional, #divMinisterio, #divRamos, #divDataInicial, #divDataFinal").hide();
        $("#estado_prisional, #ministerio, #ramo, #DataInicial, #DataFinal").prop("required", false);

        // Aplicar lógica baseada no tipo de listagem
        switch (tipoLista) {
            case 2: // Estado Prisional
                $("#divEstadoPrisional").show();
                $("#estado_prisional").prop("required", true);
                break;

            case 3: // Ministério
                $("#divMinisterio").show();
                $("#ministerio").prop("required", true);
                break;

            case 4: // Ramo
                $("#divRamos").show();
                $("#ramo").prop("required", true);
                break;

            case 5: // Data
                $("#divDataInicial, #divDataFinal").show();
                $("#DataInicial, #DataFinal").prop("required", true);
                break;
        }
    });
});


/*/filtrar listagem dos Reclusos
$(document).ready(function () {
    // Filtrar listagem dos Reclusos
    $("#tipoListaRecluso").on("change", function () {
      const tipoLista = $("#tipoListaRecluso").val();
  
      // Resetar todas as divs e requisitos
      $(
        "#divEstadoPrisional, #divUnidade, #divMinisterio, #divDataInicial, #divDataFinal"
      ).hide();
      $(
        "#estado_prisional, #unidade_prisional, #designacao_ministerio, #inputDataInicial, #inputDataFinal"
      ).prop("required", false);
  
      // Aplicar lógica baseada no tipo de listagem
      switch (tipoLista) {
        case "1": // Listagem Geral
          break; // Nenhuma ação adicional necessária
  
        case "2": // Listagem por Estado Prisional
          $("#divEstadoPrisional").show();
          break;
  
        case "3": // Listagem por Sexo Masculino
        case "4": // Listagem por Sexo Feminino
          break; // Nenhuma ação adicional necessária
  
        case "5": // Listagem por Ministério
          $("#divUnidade").show();
          break;
  
        case "6": // Listagem por Ramo
          $("#divMinisterio").show();
          break;
  
        case "7": // Listagem por Data
          $("#divDataInicial, #divDataFinal").show();
          break;
  
        default:
          alert("Opção não existente");
          break;
      }
    });
  });
  */
