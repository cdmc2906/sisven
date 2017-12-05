$(document).ready(function () {
    ConfigDatePickersReporte('.txtFechaInicioGestion', '.txtFechaFinGestion');
    ConfigurarGrid();
    $("#btnLimpiar").click(function () {
        $("#RptResumenHistorialPorFechaForm_fechaInicioGestion").val('');
        $("#RptResumenHistorialPorFechaForm_fechaFinGestion").val('');
        $("#RptResumenHistorialPorFechaForm_ejecutivo").val('');
    });
    $("#btnExcel").click(function () {
        $.ajax(
                {
                    method: "POST",
                    url: "RptResumenHistorialPorFecha/RevisarHabilitarExportarExcel",
//                data: {
//                    nombreEjecutivo: nombreEjecutivo,
//                    ejecutivo: codigoEjecutivoFila,
//                    fechaGestion: $("#RptSupervisorVsEjecutivoHistorialForm_fechagestion").val(),
//                    accionHistorial: $("#RptSupervisorVsEjecutivoHistorialForm_accionHistorial").val(),
//                    horaInicio: $("#RptSupervisorVsEjecutivoHistorialForm_horaInicioGestion").val(),
//                    horaFin: $("#RptSupervisorVsEjecutivoHistorialForm_horaFinGestion").val()
//                },
                    dataType: 'json',
                    type: 'post',
                    beforeSend: function ()
                    {
                        blockUIOpen();
                    },
                    success: function (data)
                    {
                        blockUIClose();
//                    alert(data.Result);
                        if (data.Result == 1) {
                            GenerarDocumentoReporte('GenerateExcel');
                        } else {
                            alert("Genere el reporte primero");
                        }
                    },
                    error: function (xhr, st, err)
                    {
                        blockUIClose();
                        alert(err);
                    }
                }
        );

    });
    $("#btnGenerate").click(function () {
        document.getElementById("btnExcel").disabled = false;
    });
    $('#RptResumenHistorialPorFechaForm_horaInicioGestion').on('change', function (e) {
//        $("#RptResumenHistorialPorFechaForm_fechaInicioGestion").val('');
//        $("#RptResumenHistorialPorFechaForm_fechaFinGestion").val('');
//        $("#RptResumenHistorialPorFechaForm_ejecutivo").val('');
        document.getElementById("btnExcel").disabled = true;
    });
    $('#RptResumenHistorialPorFechaForm_horaFinGestion').on('change', function (e) {
//        $("#RptResumenHistorialPorFechaForm_fechaInicioGestion").val('');
//        $("#RptResumenHistorialPorFechaForm_fechaFinGestion").val('');
//        $("#RptResumenHistorialPorFechaForm_ejecutivo").val('');
        document.getElementById("btnExcel").disabled = true;
    });
    $('#RptResumenHistorialPorFechaForm_precisionVisita').on('change', function (e) {
//        $("#RptResumenHistorialPorFechaForm_fechaInicioGestion").val('');
//        $("#RptResumenHistorialPorFechaForm_fechaFinGestion").val('');
//        $("#RptResumenHistorialPorFechaForm_ejecutivo").val('');
        document.getElementById("btnExcel").disabled = true;
    });
    $('#RptResumenHistorialPorFechaForm_accionHistorial').on('change', function (e) {
//        $("#RptResumenHistorialPorFechaForm_fechaInicioGestion").val('');
//        $("#RptResumenHistorialPorFechaForm_fechaFinGestion").val('');
//        $("#RptResumenHistorialPorFechaForm_ejecutivo").val('');
        document.getElementById("btnExcel").disabled = true;
    });
});
function ConfigurarGrid() {
    jQuery("#tblGrid").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'FECHA REVISION',
            'FECHA RUTA',
            'EJECUTIVO',
            'CLIENTE',
            'RUTA C',
            'SECUENCIA C',
            'RUTA H',
            'SECUENCIA H',
            'ESTADO',
            'CHIPS',
        ],
        colModel: [
            {name: 'FECHAREVISION', index: 'FECHAREVISION', width: 100, sortable: false, frozen: true},
            {name: 'FECHARUTA', index: 'FECHARUTA', width: 90, frozen: false, sortable: false, resizable: false, align: "center"},
            {name: 'EJECUTIVO', index: 'EJECUTIVO', width: 100, sortable: false, frozen: true},
            {name: 'CODIGOCLIENTE', index: 'CODIGOCLIENTE', width: 120, sortable: false, frozen: true},
            {name: 'RUTACLIENTE', index: 'RUTACLIENTE', width: 50, sortable: false, frozen: true},
            {name: 'SECUENCIARUTA', index: 'SECUENCIARUTA', width: 50, sortable: false, frozen: true},
            {name: 'RUTAUSADA', index: 'RUTAUSADA', width: 80, sortable: false, frozen: true},
            {name: 'SECUENCIAVISITA', index: 'SECUENCIAVISITA', width: 80, sortable: false, frozen: true},
            {name: 'ESTADOREVISION', index: 'ESTADOREVISION', width: 70, sortable: false, frozen: true},
            {name: 'CHIPSCOMPRADOS', index: 'CHIPSCOMPRADOS', width: 50, sortable: false, frozen: true},
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
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
        rownumbers: true,
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el �ndice del identificador �nico de la entidad
        },
        beforeRequest: function () {
//            blockUIOpen();
        },
        loadError: function (xhr, st, err) {
//            blockUIClose();
            // RedirigirError(xhr.status);
        }
    });
    jQuery("#tblGrid").jqGrid('navGrid', '#pagGrid',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
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
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
        rownumbers: true,
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el �ndice del identificador �nico de la entidad
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
        window.open('/sisven_2/RptResumenHistorialPorFecha/' + accion);
    }
}