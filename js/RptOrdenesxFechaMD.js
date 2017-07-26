$(document).ready(function () {
    configurarMaestroDetalle();

    ConfigDatePickersReporte('.txtfechaOrdenesInicio');
    ConfigDatePickersReporte('.txtfechaOrdenesFin');

    $("#btnLimpiar").click(function () {
        $("#ReporteOrdenesxFechaForm_fechaOrdenesInicio").val('');
        $("#ReporteOrdenesxFechaForm_fechaOrdenesFin").val('');

    });

    $("#btnExcel").click(function () {
        GenerarDocumentoReporte('GenerateExcel');
    });
    $("#btnEditarFila").click(function () {
        var idFilaSeleccionada = jQuery("#tblGridDetalle").jqGrid('getGridParam', 'selrow');
        if (idFilaSeleccionada != null)
        {
            var idFilaSeleccionada = jQuery("#tblGridDetalle").jqGrid('getGridParam', 'selrow');
            var fila = jQuery("#tblGridDetalle").jqGrid('getRowData', idFilaSeleccionada);

            jQuery("#tblGridDetalle").jqGrid(
                    'editGridRow',
                    idFilaSeleccionada,
                    {
                        drag: false,
                        url: "reporteordenesxfecha/ActualizarPedido",
                        height: 200,
                        modal: true,
                        editCaption: 'Actualizar Venta',
                        bSubmit: "Actualizar",
                        bCancel: "Cancelar",
                        closeAfterEdit: true,
                        checkOnSubmit: false,
                        clearAfterAdd: false,
                        saveData: 'Desea guardar los cambios',
                        reloadAfterSubmit: true
                    }
            );
        } else
            alert("Por favor seleccione una fila");
    });
});

function configurarMaestroDetalle()
{
    jQuery("#tblGridMaestro").jqGrid(
            {
                loadonce: true
                , height: 200
                , width: 520
                , mtype: 'POST'
                , url: 'VerDatosArchivo'
                , datatype: "json"
                , colNames: ['Codigo ', 'Ejecutivo', 'Venta']
                , colModel:
                        [
                            {name: 'CODIGOEJECUTIVO', index: 'CODIGOEJECUTIVO', width: 55}
                            , {name: 'EJECUTIVO', index: 'EJECUTIVO', width: 100}
                            , {name: 'TOTALPEDIDOS', index: 'TOTALPEDIDOS', width: 30, align: "center"}
                        ]
                , rowNum: 10
                , rowList: [10, 20, 30]
                , pager: '#pager10'
                , sortname: 'id'
                , viewrecords: true
                , sortorder: "desc"
                , multiselect: false
                , caption: "Pedidos "
                , footerrow: true
                , gridComplete: function () {
                    var $grid = $('#tblGridMaestro');
                    var colSum = $grid.jqGrid('getCol', 'TOTALPEDIDOS', false, 'sum');
                    $grid.jqGrid('footerData', 'set', {'TOTALPEDIDOS': colSum});
                    $grid.jqGrid('footerData', 'set', {'EJECUTIVO': 'Total'});
                }
                , onSelectRow: function (idFilaSeleccionada) {
                    var fila = jQuery("#tblGridMaestro").jqGrid('getRowData', idFilaSeleccionada);
                    jQuery("#tblGridDetalle").jqGrid('setCaption', "Detalle Pedidos Ejecutivo: " + fila.EJECUTIVO).trigger('reloadGrid');
                    cargarDetalle(fila.CODIGOEJECUTIVO);
                }});
    jQuery("#tblGridMaestro").jqGrid('navGrid', '#pager10', {add: false, edit: false, del: false});
    jQuery("#tblGridDetalle").jqGrid(
            {
                height: 200
                , width: 720
                , datatype: "json"
                , colNames: [
//                    'Ejecutivo',
                    'Id',
                    'Orden',
                    'Cod Cliente',
                    'Cliente',
                    '# Chips',
                    'Periodo'
                ]
                , colModel:
                        [
//                            {name: 'EJECUTIVO', hidden: true, index: 'EJECUTIVO', sortable: false, frozen: true},
                            {name: 'CODIGOORDEN',
//                                hidden: true,
                                index: 'CODIGOORDEN',
                                sortable: false,
                                width: 80,
                                frozen: true,
                                editable: true,
                                align: "center",
                                editoptions: {readonly: true, size: 10}
                            },
                            {name: 'ORDEN',
                                index: 'CODORDEN',
                                sortable: false,
                                frozen: true,
                                editable: true,
                                editoptions: {readonly: true, size: 20}
                            },
                            {name: 'COD_CLIENTE'
                                , index: 'COD_CLIENTE'
                                , sortable: false
                                , frozen: true
                                , width: 100
                                , editable: true,
                                editoptions: {readonly: true, size: 15}

//                                , summaryType: 'count'
//                                , summaryTpl: '<b>{0} Orden(es)</b>'
                            },
                            {name: 'NOM_CLIENTE'
                                , index: 'NOM_CLIENTE'
                                , sortable: false
                                , width: 350
                                , frozen: true
                                , editable: false, editoptions: {readonly: true, size: 50}
//                                , summaryType: 'count'
//                                , summaryTpl: '<b>{0} Orden(es)</b>'
                            },
                            {name: 'TOTALORDENES'
                                , index: 'TOTALORDENES'
                                , width: 80
                                , align: "right"
                                , sorttype: "float"
                                , align: "center"
                                , formatter: "integer"
                                , summaryType: 'sum'
                                , summaryTpl: '<b> Total: {0}</b>'
                                , editable: true, editoptions: {size: 10}
                            },
                            {name: 'PERIODO'
                                , index: 'PERIODO'
                                , width: 120
                                , sortable: false
                                , frozen: false
                                , sorttype: "date", formatter: "date"
                            }
                        ]
                , rowNum: 1000
                , rowList: [5, 10, 20]
                , pager: '#pager10_d'
                , sortname: 'item'
                , viewrecords: true
                , sortorder: "asc"
                , footerrow: true
                , gridComplete: function () {
                    var $grid = $('#tblGridDetalle');
                    var colSum = $grid.jqGrid('getCol', 'TOTALORDENES', false, 'sum');
                    $grid.jqGrid('footerData', 'set', {'TOTALORDENES': colSum});
                    $grid.jqGrid('footerData', 'set', {'NOM_CLIENTE': 'Total'});
                }
                , caption: "Detalle Pedidos"}
    ).navGrid('#pager10_d', {add: false, edit: false, del: false}
    );


}

function cargarDetalle(codigoEjecutivoFila) {
    $.ajax(
            {
                method: "POST",
                url: "reporteordenesxfecha/CargarGridDetalle",
                data: {ejecutivo: codigoEjecutivoFila,
                    fechaInicio: $("#ReporteOrdenesxFechaForm_fechaOrdenesInicio").val(),
                    fechaFin: $("#ReporteOrdenesxFechaForm_fechaOrdenesFin").val()},
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
                        $("#tblGridDetalle").setGridParam({datatype: 'jsonstring', datastr: datosResult}).trigger('reloadGrid');

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
        mostrarVentanaMensaje("Ingrese los parámetros necesarios para generar el reporte", 'Alerta');
    }
}