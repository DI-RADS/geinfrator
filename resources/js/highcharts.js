import Highcharts from "highcharts";
import Exporting from "highcharts/modules/exporting";
import ExportData from "highcharts/modules/export-data";
import Accessibility from "highcharts/modules/accessibility";

// Inicializar os módulos corretamente
Exporting(Highcharts);
ExportData(Highcharts);
Accessibility(Highcharts);

// Definir uma função global para renderizar os gráficos
window.renderHighcharts = function () {
    console.log("Executando renderHighcharts...");

    if (typeof Highcharts === "undefined") {
        console.error("Highcharts não foi carregado corretamente!");
        return;
    }
};

console.log("window.renderHighcharts foi definido!");
