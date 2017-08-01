$(document).ready(function () {
    ConfigDatePickersReporte('.txtfechagestion');
    ConfigurarGridSemana1();
    ConfigurarGridSemana2();
    ConfigurarGridSemana3();
    ConfigurarGridSemana4();
    ConfigurarGridSemana5();

    $("#btnLimpiar").click(function () {
        $("#ResumenHistorialForm_fechagestion").val('');
        $("#ResumenHistorialForm_ejecutivo").val('');
        $("#tblGrid").jqGrid("clearGridData", true).trigger("reloadGrid");
    });
    $("#btnExcel").click(function () {
        GenerarDocumentoReporte('GenerateExcel');
    });
});
var datatest =
        [
            {
                "rhd_fecha_historial": "2017-06-01",
                "rhd_parametro": "PORCENTAJE-CUMPLIMIENTO",
                "rhd_valor": 71.8800,
                "rhd_semana": 1
            }
        ]

        ;
var datatest1 = [{"EJECUTIVO": "QU25", "FECHA_HISTORIAL": "01-06", "PARAMETRO": "NIVEL-CUMPLIMIENTO", "VALOR": "71.88%", "SEMANA": "1"}];
var datatest2 = [{"EJECUTIVO": "QU25", "FECHA_HISTORIAL": "05-06", "PARAMETRO": "NIVEL-CUMPLIMIENTO", "VALOR": "71.88%", "SEMANA": "2"}];
var datatest3 = [{"EJECUTIVO": "QU25", "FECHA_HISTORIAL": "12-06", "PARAMETRO": "NIVEL-CUMPLIMIENTO", "VALOR": "71.88%", "SEMANA": "3"}];
var datatest4 = [{"EJECUTIVO": "QU25", "FECHA_HISTORIAL": "12-06", "PARAMETRO": "NIVEL-CUMPLIMIENTO", "VALOR": "71.88%", "SEMANA": "4"}];
var datatest5 = [{"EJECUTIVO": "QU25", "FECHA_HISTORIAL": "26-06", "PARAMETRO": "NIVEL-CUMPLIMIENTO", "VALOR": "71.88%", "SEMANA": "5"}];

function ConfigurarGridSemana1() {
//    console.log(datatest);
    jQuery("#tblGridSemana1").jqGrid(
            'jqPivot'
            , datatest,
            {
                // pivot options 
                xDimension:
                        [
//                            {dataName: 'rhd_semana', width: 150},
                            {dataName: 'rhd_parametro', width: 450},
                        ],
                yDimension:
                        [
                            //{dataName: 'rh_chips_compra'},
                            {dataName: 'rhd_fecha_historial'},
//                            {dataName: 'rh_observacion_ruta'}

                        ],
                aggregates:
                        [
                            {member: 'rhd_valor', aggregator: 'sum', width: 150, label: 'Sum'},
//                          {member: 'tax', aggregator: 'sum', width: 50, summaryType: "sum", label: 'Sum'}
                        ],
                rowTotals: true,
//                colTotals: true,
            },
            // grid options
                    {
                        width: 700,
                        height: 255,
                        rowNum: 10,
                        pager: "#pager",
                        caption: "Semana 1"
                    });
        }

function ConfigurarGridSemana2() {
//    console.log(datatest);
    jQuery("#tblGridSemana2").jqGrid(
            'jqPivot'
            , datatest2,
            {
                // pivot options 
                xDimension:
                        [
                            {dataName: 'SEMANA', width: 150},
                            {dataName: 'PARAMETRO', width: 450},
                        ],
                yDimension:
                        [
                            //{dataName: 'rh_chips_compra'},
                            {dataName: 'FECHA_HISTORIAL'},
//                            {dataName: 'rh_observacion_ruta'}

                        ],
                aggregates:
                        [
                            {member: 'VALOR', aggregator: 'sum', width: 150, label: 'Sum'},
//                          {member: 'tax', aggregator: 'sum', width: 50, summaryType: "sum", label: 'Sum'}
                        ],
                rowTotals: true,
//                colTotals: true,
            },
            // grid options
                    {
                        width: 700,
                        height: 255,
                        rowNum: 100,
                        pager: "#pager",
                        caption: "Semana 2"
                    });
        }

function ConfigurarGridSemana3() {
//    console.log(datatest);
    jQuery("#tblGridSemana3").jqGrid(
            'jqPivot'
            , datatest3,
            {
                // pivot options 
                xDimension:
                        [
                            {dataName: 'SEMANA', width: 150},
                            {dataName: 'PARAMETRO', width: 450},
                        ],
                yDimension:
                        [
                            //{dataName: 'rh_chips_compra'},
                            {dataName: 'FECHA_HISTORIAL'},
//                            {dataName: 'rh_observacion_ruta'}

                        ],
                aggregates:
                        [
                            {member: 'VALOR', aggregator: 'sum', width: 150, label: 'Sum'},
//                          {member: 'tax', aggregator: 'sum', width: 50, summaryType: "sum", label: 'Sum'}
                        ],
                rowTotals: true,
//                colTotals: true,
            },
            // grid options
                    {
                        width: 700,
                        height: 255,
                        rowNum: 10,
                        pager: "#pager",
                        caption: "Semana 3"
                    });
        }

function ConfigurarGridSemana4() {
//    console.log(datatest);
    jQuery("#tblGridSemana4").jqGrid(
            'jqPivot'
            , datatest4,
            {
                // pivot options 
                xDimension:
                        [
                            {dataName: 'SEMANA', width: 150},
                            {dataName: 'PARAMETRO', width: 450},
                        ],
                yDimension:
                        [
                            //{dataName: 'rh_chips_compra'},
                            {dataName: 'FECHA_HISTORIAL'},
//                            {dataName: 'rh_observacion_ruta'}

                        ],
                aggregates:
                        [
                            {member: 'VALOR', aggregator: 'sum', width: 150, label: 'Sum'},
//                          {member: 'tax', aggregator: 'sum', width: 50, summaryType: "sum", label: 'Sum'}
                        ],
                rowTotals: true,
//                colTotals: true,
            },
            // grid options
                    {
                        width: 700,
                        height: 255,
                        rowNum: 10,
                        pager: "#pager",
                        caption: "Semana 4"
                    });
        }

function ConfigurarGridSemana5() {
//    console.log(datatest);
    jQuery("#tblGridSemana5").jqGrid(
            'jqPivot'
            , datatest5,
            {
                // pivot options 
                xDimension:
                        [
                            {dataName: 'SEMANA', width: 150},
                            {dataName: 'PARAMETRO', width: 450},
                        ],
                yDimension:
                        [
                            //{dataName: 'rh_chips_compra'},
                            {dataName: 'FECHA_HISTORIAL'},
//                            {dataName: 'rh_observacion_ruta'}

                        ],
                aggregates:
                        [
                            {member: 'VALOR', aggregator: 'sum', width: 150, label: 'Sum'},
//                          {member: 'tax', aggregator: 'sum', width: 50, summaryType: "sum", label: 'Sum'}
                        ],
                rowTotals: true,
//                colTotals: true,
            },
            // grid options
                    {
                        width: 700,
                        height: 255,
                        rowNum: 10,
                        pager: "#pager",
                        caption: "Semana 5"
                    });
        }

function GenerarDocumentoReporte(accion) {
    if (true) {
        window.open('/sisven/rptResumenDiarioHistorial/' + accion);
    } else {
        mostrarVentanaMensaje("Ingrese los parámetros necesarios para generar el reporte", 'Alerta');
    }
}   