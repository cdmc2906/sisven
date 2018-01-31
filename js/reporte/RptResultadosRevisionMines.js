$(document).ready(function () {
    ConfigurarGrids();
    ConfigDatePickersReporte('.txtfechaOrdenesInicio', '.txtfechaOrdenesFin');

    $("#btnBuscarCargas").click(function () {
        mostrarCargas();
    });
});

function ConfigurarGrids()
{
    jQuery("#tblCargas").jqGrid(
            {
                loadonce: true
                , height: 250
//                , width: 520
                , autowidth: true
                , mtype: 'POST'
                , url: 'VerDatosArchivo'
                , datatype: "json"
                , colNames: ['CARGA', 'FECHA', 'REGISTROS', 'ESTADO']
                , colModel:
                        [
                            {name: 'CARGA', index: 'CARGA', width: 30, frozen: false, sortable: false, resizable: false, align: "center"}
                            , {name: 'FECHA', index: 'FECHA', width: 60, frozen: false, sortable: false, resizable: false, align: "center"}
                            , {name: 'REGISTROS', index: 'REGISTROS', width: 50, align: "center", frozen: false, sortable: false, resizable: false, }
                            , {name: 'ESTADO', index: 'ESTADO', width: 50, align: "center", frozen: false, sortable: false, resizable: false, }
                        ]
                , rowNum: 10
                , rowList: [10, 20, 30]
                , pager: '#pagTblCargas'
                , sortname: 'id'
                , viewrecords: true
                , sortorder: "desc"
                , multiselect: false
                , caption: "Cargas mines validacions"
                , hidegrid: false
                , onSelectRow: function (idFilaSeleccionada) {
                    var fila = jQuery("#tblCargas").jqGrid('getRowData', idFilaSeleccionada);
                    jQuery("#tblResultados").jqGrid('setCaption', "Detalle resultados carga " + fila.CARGA + " realizada el " + fila.FECHA).trigger('reloadGrid');
                    cargarDetalle(fila.CARGA);
                }});
    jQuery("#tblCargas").jqGrid('navGrid', '#pagTblCargas',
            {add: false, edit: false, del: false, search: true, refresh: false, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );

    jQuery("#tblResultados").jqGrid(
            {
                height: 250
//                , width: 920
                , autowidth: true

                , datatype: "json"
                , colNames: [
//                    'ID',
                    'AGENTE',
                    'MIN',
                    'ICC',
                    'VENDEDOR',
                    'GESTION',
                    'RESULTADO',
                    'MOTIVO',
                    'OPERADORA',
                    'LUGAR COMPRA',
                    'PRECIO',
                    'ESTADO',
                    'DIA',
                    'HORA',
                ]
                , colModel:
                        [
//                            {name: 'IDREVISION', index: 'IDREVISION', sortable: false, width: 20, frozen: true, align: "center", hidden:"true"},
                            {name: 'AGENTE', index: 'AGENTE', sortable: false, width: 100, frozen: true, align: "center", },
                            {name: 'MIN', index: 'MIN', sortable: false, width: 80, frozen: true, align: "center", },
                            {name: 'ICC', index: 'ICC', sortable: false, width: 150, frozen: true, align: "center", },
                            {name: 'VENDEDOR', index: 'VENDEDOR', sortable: false, width: 200, frozen: true, align: "center", },
                            {name: 'FECHAGESTION', index: 'FECHAGESTION', sortable: false, width: 170, frozen: true, align: "center", },
                            {name: 'RESULTADO', index: 'RESULTADO', sortable: false, width: 100, frozen: true, align: "center", },
                            {name: 'MOTIVONC', index: 'MOTIVONC', sortable: false, width: 100, frozen: true, align: "center", },
                            {name: 'OPERADORA', index: 'OPERADORA', sortable: false, width: 100, frozen: true, align: "center", },
                            {name: 'LUGARCOMPRA', index: 'LUGARCOMPRA', sortable: false, width: 100, frozen: true, align: "center", },
                            {name: 'PRECIO', index: 'PRECIO', sortable: false, width: 80, frozen: true, align: "center", },
                            {name: 'ESTADO', index: 'ESTADO', sortable: false, width: 80, frozen: true, align: "center", },
                            {name: 'DIA', index: 'DIA', sortable: false, width: 50, frozen: true, align: "center", },
                            {name: 'HORA', index: 'HORA', sortable: false, width: 50, frozen: true, align: "center", },
                        ]
                , rowNum: 10
                , rowList: [5, 10, 20]
                , pager: '#pagTblResultados'
                , sortname: 'item'
                , viewrecords: true
                , sortorder: "asc"
//                , footerrow: true
//                , grouping: true
//                , groupingView: {
//                    groupField: ['AGENTE']
//                    , groupColumnShow: [false]
//                    , groupCollapse: true
//                    , groupText: ['<b>{0} - {1} Gestionados(s)</b>']
//                }
                , rownumbers: true
                , shrinkToFit: false //permite mantener la dimensi�n personalizada de las celdas,
                , hidegrid: false
                , caption: "Detalle Resultados"}
    )
    jQuery("#tblResultados").jqGrid('navGrid', '#pagTblResultados',
            {add: false, edit: false, del: false, search: true, refresh: false, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );

    jQuery("#tblGestionxAgente").jqGrid(
            {
                height: 200
//                , width: 920
                , autowidth: true

                , datatype: "json"
                , colNames: [
//                    'ID',
                    'AGENTE',
                    'ASIGNACION',
                    'REASIGNACION',
                    'GESTION YTD',
                    'PENDIENTES',
                ]
                , colModel:
                        [
//                            {name: 'IDREVISION', index: 'IDREVISION', sortable: false, width: 20, frozen: true, align: "center", hidden:"true"},
                            {name: 'AGENTE', index: 'AGENTE', resizable: false, sortable: false, width: 150, frozen: true, align: "center", },
                            {name: 'ASIGNACION', index: 'ASIGNACION', resizable: false, sortable: false, width: 100, frozen: true, align: "center", },
                            {name: 'REASIGNACION', index: 'REASIGNACION', resizable: false, sortable: false, width: 100, frozen: true, align: "center", },
                            {name: 'GESTIONYTD', index: 'GESTIONYTD', resizable: false, sortable: false, width: 100, frozen: true, align: "center", },
                            {name: 'PENDIENTES', index: 'PENDIENTES', resizable: false, sortable: false, width: 100, frozen: true, align: "center", },
                        ]
                , rowNum: 10
                , rowList: [5, 10, 20]
                , pager: '#pagtblGestionxAgente'
                , sortname: 'item'
                , viewrecords: true
                , sortorder: "asc"
                , footerrow: true
                , gridComplete: function () {
                    var $grid = $('#tblGestionxAgente');
                    var colSum = $grid.jqGrid('getCol', 'ASIGNACION', false, 'sum');
                    $grid.jqGrid('footerData', 'set', {'ASIGNACION': colSum});

//                    var colSum1 = $grid.jqGrid('getCol', 'REASIGNACION', false, 'sum');
//                    $grid.jqGrid('footerData', 'set', {'REASIGNACION': colSum1});

                    var colSum2 = $grid.jqGrid('getCol', 'GESTIONYTD', false, 'sum');
                    $grid.jqGrid('footerData', 'set', {'GESTIONYTD': colSum2});

                    var colSum3 = $grid.jqGrid('getCol', 'PENDIENTES', false, 'sum');
                    $grid.jqGrid('footerData', 'set', {'PENDIENTES': colSum3});
                    $grid.jqGrid('footerData', 'set', {'AGENTE': 'Totales'});
                }
                , rownumbers: true
                , shrinkToFit: false //permite mantener la dimensi�n personalizada de las celdas,
                , hidegrid: false
                , caption: "Detalle Gestion por agente"}
    )
    jQuery("#tblGestionxAgente").jqGrid('navGrid', '#pagtblGestionxAgente',
            {add: false, edit: false, del: false, search: false, refresh: false, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
//            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
            );


    jQuery("#tblTiempoGestionxAgente").jqGrid(
            {
                height: 200
//                , width: 920
                , autowidth: true

                , datatype: "json"
                , colNames: [
                    'AGENTE',
                    'FECHA CARGA',
                    'FECHA FIN',
                    'TIEMPO',
                    'ESTADO',
                ]
                , colModel:
                        [
                            {name: 'AGENTE', index: 'AGENTE', resizable: false, sortable: false, width: 150, frozen: true, align: "center", },
                            {name: 'FECHACARGA', index: 'FECHACARGA', resizable: false, sortable: false, width: 100, frozen: true, align: "center", },
                            {name: 'FECHAFIN', index: 'FECHAFIN', resizable: false, sortable: false, width: 100, frozen: true, align: "center", },
                            {name: 'TIEMPO', index: 'TIEMPO', resizable: false, sortable: false, width: 100, frozen: true, align: "center", },
                            {name: 'ESTADO', index: 'ESTADO', resizable: false, sortable: false, width: 100, frozen: true, align: "center", },
                        ]
                , rowNum: 10
                , rowList: [5, 10, 20]
                , pager: '#pagtblTiempoGestionxAgente'
                , sortname: 'item'
                , viewrecords: true
                , sortorder: "asc"
//                , footerrow: true
                , rownumbers: true
                , shrinkToFit: false //permite mantener la dimensi�n personalizada de las celdas,
                , hidegrid: false
                , caption: "Detalle Tiempos por agente"}
    )
    jQuery("#tblTiempoGestionxAgente").jqGrid('navGrid', '#pagtblTiempoGestionxAgente',
            {add: false, edit: false, del: false, search: true, refresh: false, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
}

function mostrarCargas() {
    $.ajax(
            {
                method: "POST",
                url: "RptResultadosRevisionMines/MostrarCargas",
                data: {
//                    ejecutivo: codigoEjecutivoFila,
//                    fechaInicio: $("#ReporteOrdenesxFechaForm_fechaOrdenesInicio").val(),
//                    fechaFin: $("#ReporteOrdenesxFechaForm_fechaOrdenesFin").val()
                },
                dataType: 'json',
                type: 'post',
                beforeSend: function ()
                {
                    blockUIOpen();
                },
                success: function (data)
                {
                    blockUIClose();
                    if (data.Status == 1) {
                        var datosResult = data.Result;
                        $("#tblCargas").setGridParam({datatype: 'jsonstring', datastr: datosResult}).trigger('reloadGrid');

                    } else {
                        //to do
                    }
                },
                error: function (xhr, st, err)
                {
                    blockUIClose();
                    alert(err);
                }
            }
    );
}

function cargarDetalle(numeroCarga) {
    $.ajax(
            {
                method: "POST",
                url: "RptResultadosRevisionMines/MostrarResultadosCarga",
                data: {
                    numeroCarga: numeroCarga,
                },
                dataType: 'json',
                type: 'post',
                beforeSend: function ()
                {
                    blockUIOpen();
                },
                success: function (data)
                {
//                    alert(data);
                    blockUIClose();
                    if (data.Status == 1) {
                        var datosResult = data.Result;
//                        alert(datosResult);
                        $("#tblResultados").setGridParam({datatype: 'jsonstring', datastr: datosResult['resultados']}).trigger('reloadGrid');
                        $("#tblGestionxAgente").setGridParam({datatype: 'jsonstring', datastr: datosResult['gestionxAgente']}).trigger('reloadGrid');
                        $("#tblTiempoGestionxAgente").setGridParam({datatype: 'jsonstring', datastr: datosResult['tiemposxGestion']}).trigger('reloadGrid');

                    } else {
                        //to do
                    }
                },
                error: function (xhr, st, err)
                {
                    blockUIClose();
                    alert(err);
                }
            }
    );
}
function GenerarDocumentoReporte(accion) {
    if ($("#ReporteOrdenesxFechaForm_fechaOrdenesInicio").val() != ""
            && $("#ReporteOrdenesxFechaForm_fechaOrdenesFin").val() != "") {
        window.open('/sisven/reporteordenesxfecha/' + accion
                + '?startDate=' + $("#ReporteOrdenesxFechaForm_fechaOrdenesInicio").val()
                + '&endDate=' + $("#ReporteOrdenesxFechaForm_fechaOrdenesFin").val()
                );
    } else {
        mostrarVentanaMensaje("Ingrese los par�metros necesarios para generar el reporte", 'Alerta');
    }
}