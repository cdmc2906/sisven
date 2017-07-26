$(document).ready(function () {
    ConfigDatePickersReporte('.txtfechagestion');
    ConfigurarGrid();
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
                "rh_codigo_vendedor": "QU25",
                "rh_observacion_ruta": "Ruta ok",
                "rh_fecha_item": "01-Jun",
                "rh_chips_compra": "0"
            },
            {
                "rh_codigo_vendedor": "QU25",
                "rh_observacion_ruta": "Ruta ok",
                "rh_fecha_item": "01-Jun",
                "rh_chips_compra": "0"
            },
            {
                "rh_codigo_vendedor": "QU25",
                "rh_observacion_ruta": "Ruta ok",
                "rh_fecha_item": "01-Jun",
                "rh_chips_compra": "0"
            },
            {
                "rh_codigo_vendedor": "QU25",
                "rh_observacion_ruta": "Otra ruta",
                "rh_fecha_item": "01-Jun",
                "rh_chips_compra": "0"
            },
            {
                "rh_codigo_vendedor": "QU25",
                "rh_observacion_ruta": "Ruta ok",
                "rh_fecha_item": "01-Jun",
                "rh_chips_compra": "0"
            },
            {
                "rh_codigo_vendedor": "QU25",
                "rh_observacion_ruta": "Ruta ok",
                "rh_fecha_item": "01-Jun",
                "rh_chips_compra": "0"
            },
            {
                "rh_codigo_vendedor": "QU25",
                "rh_observacion_ruta": "Ruta ok",
                "rh_fecha_item": "01-Jun",
                "rh_chips_compra": "0"
            },
            {
                "rh_codigo_vendedor": "QU25",
                "rh_observacion_ruta": "Ruta ok",
                "rh_fecha_item": "01-Jun",
                "rh_chips_compra": "3"
            },
            {
                "rh_codigo_vendedor": "QU25",
                "rh_observacion_ruta": "Ruta ok",
                "rh_fecha_item": "01-Jun",
                "rh_chips_compra": "0"
            }
        ]

        ;
function ConfigurarGrid() {
//    console.log(datatest);
    jQuery("#tblGrid").jqGrid(
            'jqPivot'
            , datatest,
            {
                // pivot options 
                xDimension:
                        [
                            {dataName: 'rh_codigo_vendedor', width: 90},
                            {dataName: 'rh_observacion_ruta', width: 100},
                        ],
                yDimension:
                        [
                            //{dataName: 'rh_chips_compra'},
                            {dataName: 'rh_fecha_item'},
//                            {dataName: 'rh_observacion_ruta'}

                        ],
                aggregates:
                        [
                            {member: 'rh_chips_compra', aggregator: 'sum', width: 50, summaryType: "sum", label: 'Sum'},
//                          {member: 'tax', aggregator: 'sum', width: 50, summaryType: "sum", label: 'Sum'}
                        ],
                rowTotals: true,
                colTotals: true,
            },
            // grid options
                    {
                        width: 700,
                        rowNum: 10,
                        pager: "#pager",
                        caption: "Amounts and quantity by category and product"
                    });
        }

function ConfigurarGridMayoristas() {
    jQuery("#tblGridMayoristas").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGridMayoristas',
        colNames: [
            'ID_VENDEDOR',
            'VENDEDOR',
            'CHIPS VENDIDOS',
            'CONSUMO MES',
            'PORCENTAJE',
            'COMISION',
        ],
        colModel: [
            {name: 'ID_VENDEDOR', index: 'ID_VENDEDOR', width: 50, sortable: false, frozen: true},
            {name: 'NOMBRE_VENDEDOR', index: 'NOMBRE_VENDEDOR', width: 250, sortable: false, frozen: true},
            {name: 'CHIPS_VENDIDOS', index: 'CHIPS_VENDIDOS', width: 100, frozen: false, sortable: false, resizable: false, align: "center"},
            {name: 'TOTAL_CONSUMOS', index: 'TOTAL_CONSUMOS', width: 100, frozen: false, sortable: false, resizable: false, align: "center", formatter: 'currency', formatoptions: {prefix: "$", thousandsSeparator: '.', decimalPlaces: 2}},
            {name: 'PORCENTAJE', index: 'PORCENTAJE', width: 100, sortable: false, frozen: false, align: "center"},
            {name: 'COMISION', index: 'COMISION', width: 100, resizable: false, sortable: false, frozen: false, align: "center", formatter: 'currency', formatoptions: {prefix: "$", thousandsSeparator: '.', decimalPlaces: 2}},
        ],
        pager: '#pagGrid',
        rowNum: NroFilas,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 360,
//        width: 200,
        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        rownumbers: true,
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el ï¿½ndice del identificador ï¿½nico de la entidad
        },
        beforeRequest: function () {
//            blockUIOpen();
        },
        loadError: function (xhr, st, err) {
//            blockUIClose();
            // RedirigirError(xhr.status);
        }
    });
    jQuery("#tblGridMayoristas").jqGrid('navGrid', '#pagGrid',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
}

function GenerarDocumentoReporte(accion) {
    if (true) {
        window.open('/sisven/rptResumenDiarioHistorial/' + accion);
    } else {
        mostrarVentanaMensaje("Ingrese los parámetros necesarios para generar el reporte", 'Alerta');
    }
}   