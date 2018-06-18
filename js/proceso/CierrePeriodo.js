$(document).ready(function () {
    ConfigDatePickersReporte('.txtFechaGestion');
    ConfigurarGrid();

    $('#CierrePeriodoForm_tipoFecha').on('change', function (e) {
        var e = document.getElementById("CierrePeriodoForm_tipoFecha");
        var strUser = e.selectedIndex;
//        alert(strUser)
        if (strUser == 1)//Seleccionar Fecha
        {
            document.getElementById("divFechaGestion").style.display = "block";
            document.getElementById("CierrePeriodoForm_fechaGestion").value = "";

        } else {//Automatico
            document.getElementById("divFechaGestion").style.display = "none";
        }
    });

    $("#btnBuscarPeriodos").click(function () {
        mostrarPeriodos();
        document.getElementById("btnReversarCierre").disabled = true;
        document.getElementById("btnExportarResumen").disabled = true;
        $("#tblGestionesPeriodo").jqGrid("clearGridData", true).trigger("reloadGrid");
    });

    $("#btnExcel").click(function () {
        GenerarDocumentoReporte('GenerateExcel');
    });

    $("#btnReversarCierre").click(function () {
        ReversarCierre();
    });
    $("#btnExportarResumen").click(function () {
        exportarResumen();
    });


});
function ConfigurarGrid() {
    jQuery("#tblPeriodos").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'Año',
            'Mes',
            'Codigo',
            'Periodo',
            'Inicio',
            'Fin',
            'Estado',
        ],
        colModel: [
            {name: 'ANIO', index: 'ANIO', width: 50, sortable: false, frozen: true, align: "center"},
            {name: 'MES', index: 'MES', width: 50, sortable: false, frozen: true, align: "center"},
            {name: 'ID', index: 'ID', width: 50, sortable: false, frozen: true, align: "center"},
            {name: 'PERIODO', index: 'PERIODO', width: 200, sortable: false, frozen: true},
            {name: 'INICIO', index: 'INICIO', width: 80, frozen: false, sortable: false, resizable: false, align: "center"},
            {name: 'FIN', index: 'FIN', width: 80, frozen: true, sortable: false, resizable: false, align: "center"},
            {name: 'ESTADO', index: 'ESTADO', width: 80, sortable: false, frozen: true, align: "center"},
        ],
        pager: '#pagtblPeriodos',
        rowNum: NroFilas,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 200,
//        width: 200,
        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        rownumbers: true,
        grouping: true,
//        toolbar: [true, "top"],
        groupingView: {
            groupField: ['ANIO', 'MES']
            , groupColumnShow: [false, false]
            , groupText: ['<b>{0}</b>']
            , groupCollapse: false
            , groupOrder: ['dsc', 'dsc']
                    // , groupSummary: [true, true]
        },
        onSelectRow: function (idFilaSeleccionada) {
            $("#tblGestionesPeriodo").jqGrid("clearGridData", true).trigger("reloadGrid");

            var fila = jQuery("#tblPeriodos").jqGrid('getRowData', idFilaSeleccionada);
            jQuery("#tblGestionesPeriodo").jqGrid('setCaption', "Detalle " + fila.PERIODO).trigger('reloadGrid');
            mostrarDetallesPeriodo(fila.ID);
        }
    }
    );
    jQuery("#tblPeriodos").jqGrid('navGrid', '#pagtblPeriodos',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    jQuery("#tblGestionesPeriodo").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'Ejecutivo',
            'Fecha',
            'Parametro',
            'Valor',
        ],
        colModel: [
            {name: 'EJECUTIVO', index: 'EJECUTIVO', width: 150, sortable: false, frozen: true, align: "center"},
            {name: 'FECHA', index: 'FECHA', width: 100, sortable: false, frozen: true, align: "center"},
            {name: 'PARAMETRO', index: 'PARAMETRO', width: 200, frozen: false, sortable: false, resizable: false, align: "left"},
            {name: 'VALOR', index: 'VALOR', width: 100, sortable: false, frozen: true, align: "center"},
        ],
        pager: '#pagtblGestionesPeriodo',
        rowNum: 100000,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 200,
//        width: 200,
        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        rownumbers: true,
        grouping: true,
//        toolbar: [true, "top"],
        groupingView: {
            groupField: ['EJECUTIVO', 'FECHA']
            , groupColumnShow: [false, false]
            , groupText: ['<b>{0}</b>']
            , groupCollapse: true
            , groupOrder: ['asc', 'asc']
                    // , groupSummary: [true, true]
        }

    }
    );

    jQuery("#tblGestionesPeriodo").jqGrid('navGrid', '#pagtblGestionesPeriodo',
            {add: false, edit: false, del: false, search: false, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );


}

function mostrarPeriodos() {
    $.ajax(
            {
                method: "POST",
                url: "CierrePeriodo/BuscaPeriodos",
                data: {
//                    ejecutivo: codigoEjecutivoFila,
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
                        $("#tblPeriodos").setGridParam({datatype: 'jsonstring', datastr: datosResult}).trigger('reloadGrid');
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

function mostrarDetallesPeriodo(idPeriodo) {
    $.ajax(
            {
                method: "POST",
                url: "CierrePeriodo/MostrarDetallePeriodo",
                data: {
                    idPeriodo: idPeriodo,
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
                        var gestiones = datosResult['resumenesPeriodo'].length;
//                      
                        if (gestiones > 0)
                        {
                            document.getElementById("btnReversarCierre").disabled = false;
                            document.getElementById("btnExportarResumen").disabled = false;
                        } else {
//                            alert("El periodo seleccionado se encuentra abierto");
                            document.getElementById("btnReversarCierre").disabled = true;
                            document.getElementById("btnExportarResumen").disabled = true;
                        }
                        $("#tblGestionesPeriodo").setGridParam({datatype: 'jsonstring', datastr: datosResult['resumenesPeriodo']}).trigger('reloadGrid');


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
    if (true) {
        window.open('/sisven/CierrePeriodo/' + accion);
    }
}

function CerrarPeriodo() {
    if (confirm("Esta seguro de cerrar el periodo?")) {
        $.ajax(
                {
                    method: "POST",
                    url: "CierrePeriodo/CerrarPeriodoSemanal",
                    data: {
//                        idPeriodo: fila.ID,
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
//                            alert(datosResult);
                            $("#tblPeriodos").jqGrid("clearGridData", true).trigger("reloadGrid");
                            $("#tblGestionesPeriodo").jqGrid("clearGridData", true).trigger("reloadGrid");
                            alert("Periodo cerrado exitosamente");
                            location.reload();
//                            $("#tblGestionesPeriodo").setGridParam({datatype: 'jsonstring', datastr: datosResult}).trigger('reloadGrid');
//                        document.getElementById("btnExportarResultadosxPeriodo").disabled = false;
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
}
function ReversarCierre() {
    if (confirm("Esta seguro de reversar el periodo seleccionado?")) {
        $.ajax(
                {
                    method: "POST",
                    url: "CierrePeriodo/ReversarPeriodo",
                    data: {
//                        idPeriodo: fila.ID,
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
//                            alert(datosResult);
                            $("#tblPeriodos").jqGrid("clearGridData", true).trigger("reloadGrid");
                            $("#tblGestionesPeriodo").jqGrid("clearGridData", true).trigger("reloadGrid");
                            alert("Periodo reversado exitosamente");
                            location.reload();
//                            $("#tblGestionesPeriodo").setGridParam({datatype: 'jsonstring', datastr: datosResult}).trigger('reloadGrid');
//                        document.getElementById("btnExportarResultadosxPeriodo").disabled = false;
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
}

function exportarResumen() {
    window.open('/sisven_dev/CierrePeriodo/ExportarResumen');
}
