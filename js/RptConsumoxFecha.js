$(document).ready(function () {
    ConfigGridJSON();
//    ConfigDatePickerRangeReport();

    ConfigDatePickersReporte('.txtFechaConsumo');

    var fechaHoy = new Date();
    $(".txtFechaConsumo").datepicker("setDate", new Date(fechaHoy.getFullYear(), fechaHoy.getMonth(), 1));


    $("#btnLimpiar").click(function () {
        $("#ReporteTotalPlanForm_fechaConsumo").val('');

        var maxDate = new Date();
        $('.txtFechaConsumo').datepicker('setStartDate', null);
        $('.txtFechaConsumo').datepicker('setEndDate', maxDate);

        var fechaHoy = new Date();
        $(".txtFechaConsumo").datepicker("setDate", new Date(fechaHoy.getFullYear(), fechaHoy.getMonth(), 1));

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
        url: 'VerDatosArchivo',
        colNames: [
            'PLAN',
            'MIN',
            'CONTRATO',
            'CODIGO VENDEDOR',
            'VENDEDOR',
            'FECHA CONSUMO',
            'PAGO',            
            'FECHA INGRESO',
            'OBSERVACION',
            'SUBIDO POR'
        ],
        colModel: [
            {name: 'PLAN', index: 'PLAN', sortable: false, frozen: true},
            {name: 'MIN', index: 'MIN', width: 100, sortable: false, frozen: true, align: "center"},
            {name: 'CONTRATO', index: 'CONTRATO', width: 100, frozen: false, sortable: false, resizable: false},
            {name: 'CODIGO_VENDEDOR', index: 'CODIGO_VENDEDOR', width: 120, sortable: false, frozen: false},
            {name: 'VENDEDOR', index: 'VENDEDOR', width: 90, resizable: false, sortable: false, frozen: false},
            {name: 'FECHA_CONSUMO', index: 'FECHA_CONSUMO', width: 120, sortable: false, frozen: false},
            {name: 'VALOR_PAGO', index: 'VALOR_PAGO', width: 60, sortable: false, frozen: false},
            {name: 'FECHA_INGRESO', index: 'FECHA_INGRESO', width: 120, sortable: false, frozen: false},
            {name: 'OBSERVACION', index: 'OBSERVACION', width: 100, resizable: false, align: "left", sortable: false, frozen: false},
            {name: 'SUBIDO_POR', index: 'SUBIDO_POR', width: 100, sortable: false, frozen: false},
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

    jQuery("#tblGrid").jqGrid('navGrid', '#pagGrid',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
    {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
}

function GenerarDocumentoReporte(accion) {
    if ($("#ReporteTotalPlanForm_fechaConsumoInicio").val() != ""
            && $("#ReporteTotalPlanForm_fechaConsumo").val() != "") {
        window.open(accion + '?startDate=' + $("#ReporteTotalPlanForm_fechaConsumo").val());
    }    else {
        mostrarVentanaMensaje("Ingrese los parámetros necesarios para generar el reporte", 'Alerta');
    }
}

