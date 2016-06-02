$(document).ready(function () {
    ConfigGridJSON();
//    ConfigDatePickerRangeReport();

    ConfigDatePickersReporte('.txtFechaInicio', '.txtFechaFin');

    var fechaHoy = new Date();
    $(".txtFechaInicio").datepicker("setDate", new Date(fechaHoy.getFullYear(), fechaHoy.getMonth(), 1));


    $("#btnLimpiar").click(function () {
        $("#ReporteTotalPlanForm_fechaConsumoInicio").val('');
        $("#ReporteTotalPlanForm_fechaConsumoFin").val('');
//        $("#gview_tblGrid").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblGrid").jqGrid("clearGridData", true).trigger("reloadGrid");

        var maxDate = new Date();
        $('.txtFechaFin').datepicker('setStartDate', null);
        $('.txtFechaInicio').datepicker('setEndDate', maxDate);
        $('.txtFechaFin').datepicker('setEndDate', maxDate);

        var fechaHoy = new Date();
        $(".txtFechaInicio").datepicker("setDate", new Date(fechaHoy.getFullYear(), fechaHoy.getMonth(), 1));

    });

    $("#btnExcel").click(function () {
        GenerarDocumentoReporte('GenerateExcel');
    });
});


function ConfigGridJSON() {
    jQuery("#tblGrid").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        colNames: [
            'PLAN',
            'TOTAL MIN',
            'TOTAL PAGO'
        ],
        colModel: [
            {name: 'nombre_plan', index: 'nombre_plan', width: 140, resizable: true, sortable: true, frozen: false},
            {name: 'total_min', index: 'total_min', width: 160, resizable: false, sortable: false, frozen: false},
            {name: 'total_pago', index: 'total_pago', width: 160, resizable: false, sortable: false, frozen: false},
        ],
        pager: '#pagGrid',
        rowNum: NroFilas,
        rowList: ElementosPagina,
        sortname: 'nombre_plan',
        sortorder: 'ASC',
        viewrecords: true,
        caption: 'Resumen',
        height: 200,
        autowidth: true,
        gridview: true, //Hace mas rï¿½pido la carga de la grilla 
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        rownumbers: true,
        beforeRequest: function () {
            blockUIOpen();
        },
        loadComplete: function (jsonResponse) {
            blockUIClose();
            if (!$.isEmptyObject(jsonResponse))
            {
                if (jsonResponse.Status == Error) {
                    setMensaje('error', jsonResponse.Message);
                }
            }
        },
        loadError: function (xhr, st, err) {
            blockUIClose();
//            alert(err);
        }
    });

    jQuery("#tblGrid").jqGrid('navGrid', '#pagGrid',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
    {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
//    jQuery("#tblGrid").jqGrid('setFrozenColumns');//Fija las columnas 
}

function GenerarDocumentoReporte(accion) {
    if ($("#ReporteTotalPlanForm_fechaConsumoInicio").val() != ""
            && $("#ReporteTotalPlanForm_fechaConsumoFin").val() != "") {
        window.open('/sisven/reportetotalplan/' + accion + '?startDate=' + $("#ReporteTotalPlanForm_fechaConsumoInicio").val() +
                '&endDate=' + $("#ReporteTotalPlanForm_fechaConsumoFin").val());
    }
    else {
        mostrarVentanaMensaje("Ingrese los parámetros necesarios para generar el reporte", 'Alerta');
    }
}

