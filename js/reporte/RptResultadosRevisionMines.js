$(document).ready(function () {
    ConfigurarGrids();

    $("#btnBuscarCargas").click(function () {
        mostrarCargas();
        document.getElementById("btnExportarResultados").disabled = true;
        document.getElementById("btnExportarGestion").disabled = true;

        document.getElementById("btnExportarResultadosxPeriodo").disabled = true;

        $("#tblCargas").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblResultados").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblGestionxAgente").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblTiempoGestionxAgente").jqGrid("clearGridData", true).trigger("reloadGrid");
    });

    $("#btnExportarResultadosxPeriodo").click(function () {
        GenerarDocumentoReporte('GenerarExcelResultadosxPeriodo');
    });
    $("#btnExportarResultados").click(function () {
        GenerarDocumentoReporte('GenerarExcelResultados');
    });

    $("#btnExportarMinesSinGestion").click(function () {
        GenerarDocumentoReporte('GenerarMinesSinGestion');
    });
    $("#btnExportarGestion").click(function () {
        GenerarDocumentoReporte('GenerarExcelGestion');
    });


    $("#btnReasignar").click(function () {
        reasignarMines();
    });
});

function ConfigurarGrids()
{
    jQuery("#tblPeriodosCargas").jqGrid(
            {
                loadonce: true
                , height: 150
//                , width: 520
                , autowidth: true
                , mtype: 'POST'
                , url: 'VerDatosArchivo'
                , datatype: "json"
                , colNames: ['IDMES', 'MES', 'CARGAS', 'REGISTROS']
                , colModel:
                        [
                            {name: 'IDMES', index: 'IDMES', width: 1, frozen: false, sortable: false, resizable: false, align: "center"}
                            , {name: 'MES', index: 'MES', width: 30, frozen: false, sortable: false, resizable: false, align: "center"}
                            , {name: 'CARGAS', index: 'CARGAS', width: 60, frozen: false, sortable: false, resizable: false, align: "center"}
                            , {name: 'REGISTROS', index: 'REGISTROS', width: 50, align: "center", frozen: false, sortable: false, resizable: false, }
                        ]
                , rowNum: 10
                , rowList: [10, 20, 30]
                , pager: '#pagtblPeriodosCargas'
                , sortname: 'id'
                , viewrecords: true
                , sortorder: "desc"
                , multiselect: false
                , caption: "Meses carga"
                , hidegrid: false
                , onSelectRow: function (idFilaSeleccionada) {
//                    document.getElementById("btnExportarResultados").disabled = false;
//                    document.getElementById("btnExportarMinesSinGestion").disabled = false;
//                    document.getElementById("btnExportarGestion").disabled = false;
                    $("#tblResultados").jqGrid("clearGridData", true).trigger("reloadGrid");
                    $("#tblGestionxAgente").jqGrid("clearGridData", true).trigger("reloadGrid");
                    $("#tblTiempoGestionxAgente").jqGrid("clearGridData", true).trigger("reloadGrid");
                    $("#tblReasignacion").jqGrid("clearGridData", true).trigger("reloadGrid");

                    var fila = jQuery("#tblPeriodosCargas").jqGrid('getRowData', idFilaSeleccionada);
                    jQuery("#tblResultados").jqGrid('setCaption', "Detalle resultados cargas " + fila.MES).trigger('reloadGrid');
                    mostrarDetallesCargaxMes(fila.IDMES);
                }});
    jQuery("#tblPeriodosCargas").jqGrid('navGrid', '#pagtblPeriodosCargas',
            {add: false, edit: false, del: false, search: true, refresh: false, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    jQuery("#tblCargas").jqGrid(
            {
                loadonce: true
                , height: 150
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
                    document.getElementById("btnExportarResultados").disabled = false;
                    document.getElementById("btnExportarMinesSinGestion").disabled = false;
                    document.getElementById("btnExportarGestion").disabled = false;

                    var fila = jQuery("#tblCargas").jqGrid('getRowData', idFilaSeleccionada);
                    jQuery("#tblResultados").jqGrid('setCaption', "Detalle resultados carga " + fila.CARGA + " realizada el " + fila.FECHA).trigger('reloadGrid');
                    mostrarDetallesCarga(fila.CARGA);
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
                height: 150
//                , width: 920
                , autowidth: true

                , datatype: "json"
                , colNames: [
//                    'ID',
                    'AGENTE',
                    'FECHA INDICADOR',
                    'MIN',
                    'ICC',
                    'REVISION',
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
                            {name: 'FECHA_INDICADOR', index: 'FECHA_INDICADOR', sortable: false, width: 120, frozen: true, align: "center", },
                            {name: 'MIN', index: 'MIN', sortable: false, width: 80, frozen: true, align: "center", },
                            {name: 'ICC', index: 'ICC', sortable: false, width: 150, frozen: true, align: "center", },
                            {name: 'REVISION', index: 'REVISION', sortable: false, width: 150, frozen: true, align: "center", },
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
                height: 130
//                , width: 920
                , autowidth: true

                , datatype: "json"
                , colNames: [
//                    'ID',
                    'Agente',
                    'Asignacion',
                    'Reasignacion',
                    'Gestion YTD',
                    'Pendientes',
                ]
                , colModel:
                        [
//                            {name: 'IDREVISION', index: 'IDREVISION', sortable: false, width: 20, frozen: true, align: "center", hidden:"true"},
                            {name: 'AGENTE', index: 'AGENTE', resizable: false, sortable: false, width: 130, frozen: true, },
                            {name: 'ASIGNACION', index: 'ASIGNACION', resizable: false, sortable: false, width: 80, frozen: true, align: "center", },
                            {name: 'REASIGNACION', index: 'REASIGNACION', resizable: false, sortable: false, width: 80, frozen: true, align: "center", },
                            {name: 'GESTIONYTD', index: 'GESTIONYTD', resizable: false, sortable: false, width: 80, frozen: true, align: "center", },
                            {name: 'PENDIENTES', index: 'PENDIENTES', resizable: false, sortable: false, width: 80, frozen: true, align: "center", },
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
                height: 150
//                , width: 920
                , autowidth: true

                , datatype: "json"
                , colNames: [
                    'Agente',
                    'Carga',
                    'Ultima Gestion',
                    'Tiempo',
                    'Estado',
                ]
                , colModel:
                        [
                            {name: 'AGENTE', index: 'AGENTE', resizable: false, sortable: false, width: 130, frozen: true, },
                            {name: 'FECHACARGA', index: 'FECHACARGA', resizable: false, sortable: false, width: 90, frozen: true, align: "center", },
                            {name: 'FECHAFIN', index: 'FECHAFIN', resizable: false, sortable: false, width: 90, frozen: true, align: "center", },
                            {name: 'TIEMPO', index: 'TIEMPO', resizable: false, sortable: false, width: 70, frozen: true, align: "center", },
                            {name: 'ESTADO', index: 'ESTADO', resizable: false, sortable: false, width: 70, frozen: true, align: "center", },
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

    jQuery("#tblReasignacion").jqGrid(
            {
                height: 150
//                , width: 920
                , autowidth: true

                , datatype: "json"
                , colNames: [
                    'MIN',
                    'ICC',
                    'VENDEDOR',
                    'CODIGO_ESTADO',
                    'ESTADO',
                    'AGENTE',
                ]
                , colModel:
                        [
                            {name: 'MIN', index: 'MIN', sortable: false, width: 80, frozen: true, align: "center", },
                            {name: 'ICC', index: 'ICC', sortable: false, width: 150, frozen: true, align: "center", },
                            {name: 'VENDEDOR', index: 'VENDEDOR', sortable: false, width: 150, frozen: true, align: "center", },
                            {name: 'CODIGO_ESTADO', index: 'CODIGO_ESTADO', sortable: false, width: 150, frozen: true, align: "center", },
                            {name: 'ESTADO', index: 'ESTADO', sortable: false, width: 150, frozen: true, align: "center", },
                            {name: 'AGENTE_ASIGNADO', index: 'AGENTE_ASIGNADO', sortable: false, width: 150, frozen: true, align: "center", },
                        ]
                , rowNum: 10
                , rowList: [10, 500, 1000]
//                , rowList: [500, 1000, 1500]
                , pager: '#pagTblReasignacion'
                , sortname: 'item'
                , viewrecords: true
                , sortorder: "asc"
                , multiselect: true
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
    jQuery("#tblReasignacion").jqGrid('navGrid', '#pagTblReasignacion',
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
                url: "RptResultadosRevisionMines/CargasxMes",
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
                        $("#tblPeriodosCargas").setGridParam({datatype: 'jsonstring', datastr: datosResult}).trigger('reloadGrid');

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

function mostrarDetallesCargaxMes(mesCarga) {
    $.ajax(
            {
                method: "POST",
                url: "RptResultadosRevisionMines/MostrarCargas",
                data: {
                    mesCarga: mesCarga,
                },
                dataType: 'json',
                type: 'post',
                beforeSend: function ()
                {
                    blockUIOpen();
                },
                success: function (data)
                {
//                    alert(data.toSource());
                    blockUIClose();
                    if (data.Status == 1) {
                        var datosResult = data.Result;
                        $("#tblCargas").setGridParam({datatype: 'jsonstring', datastr: datosResult['cargas']}).trigger('reloadGrid');
                        document.getElementById("btnExportarResultadosxPeriodo").disabled = false;
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

function mostrarDetallesCarga(numeroCarga) {
    $.ajax(
            {
                method: "POST",
                url: "RptResultadosRevisionMines/MostrarDetallesCarga",
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
//alert(datosResult['minessingestion'].toSource());
                        var minesSinGestion = datosResult['minessingestion'].length;
//                        alert(minesSinGestion)
                        if (minesSinGestion > 0) {
                            document.getElementById("agenteReasignar").disabled = false;
                            document.getElementById("btnReasignar").disabled = false;

                        } else {
                            document.getElementById("agenteReasignar").disabled = true;
                            document.getElementById("btnReasignar").disabled = true;
                        }
                        $("#tblResultados").setGridParam({datatype: 'jsonstring', datastr: datosResult['resultados']}).trigger('reloadGrid');
                        $("#tblGestionxAgente").setGridParam({datatype: 'jsonstring', datastr: datosResult['gestionxAgente']}).trigger('reloadGrid');
                        $("#tblTiempoGestionxAgente").setGridParam({datatype: 'jsonstring', datastr: datosResult['tiemposxGestion']}).trigger('reloadGrid');
                        $("#tblReasignacion").setGridParam({datatype: 'jsonstring', datastr: datosResult['minessingestion']}).trigger('reloadGrid');

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

function reasignarMines() {

    var idFilasSeleccionadas;
    idFilasSeleccionadas = jQuery("#tblReasignacion").jqGrid('getGridParam', 'selarrrow');

    var agenteAsignar = document.getElementById("agenteReasignar").value;
    if (agenteAsignar != '') {

        if (idFilasSeleccionadas.length > 0) {
            var minesReasignar = [];
            for (var i = 0; i < idFilasSeleccionadas.length; i += 1) {
                var fila = jQuery("#tblReasignacion").jqGrid('getRowData', idFilasSeleccionadas[i]);
                minesReasignar.push(fila.ICC);
            }

            $.ajax(
                    {
                        method: "POST",
                        url: "RptResultadosRevisionMines/ReasignarMines",
                        data: {
                            minesReasignar: minesReasignar,
                            agenteAsignar: agenteAsignar,
                        },
                        dataType: 'json',
                        type: 'post',
                        beforeSend: function () {
                            blockUIOpen();
                        },
                        success: function (data)
                        {
                            blockUIClose();
                            if (data.Status == 1) {
                                var datosResult = data.Result;
                                $("#tblGestionxAgente").setGridParam({datatype: 'jsonstring', datastr: datosResult['gestionxAgente']}).trigger('reloadGrid');
                                $("#tblReasignacion").setGridParam({datatype: 'jsonstring', datastr: datosResult['minessingestion']}).trigger('reloadGrid');
                                alert("Mines reasignados correctamente");

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
        } else {
            alert('No existen mines para reasignar');
        }
    } else {
        alert('No existen ejecutivos seleccionados para reasignar');
    }
}

function GenerarDocumentoReporte(accion) {
    if (accion != '') {
        window.open('/sisven/RptResultadosRevisionMines/' + accion);
    } else {
        mostrarVentanaMensaje("Error en generar excel", 'Alerta');
    }
}