$(document).ready(function () {
    ConfigGridJSON();
//    ConfigDatePickerRangeReport();

    ConfigDatePickersReporte('.txtfechaOrdenesInicio');
    ConfigDatePickersReporte('.txtfechaOrdenesFin');

//    var fechaHoy = new Date();
//    $(".txtFechaConsumo").datepicker("setDate", new Date(fechaHoy.getFullYear(), fechaHoy.getMonth(), 1));


    $("#btnLimpiar").click(function () {
        $("#ReporteOrdenesxFechaForm_fechaOrdenesInicio").val('');
        $("#ReporteOrdenesxFechaForm_fechaOrdenesFin").val('');

//        var maxDate = new Date();
//        $('.txtFechaInicio').datepicker('setStartDate', null);
//        $('.txtFechaFin').datepicker('setEndDate', maxDate);

//        var fechaHoy = new Date();
//        $(".txtFechaConsumo").datepicker("setDate", new Date(fechaHoy.getFullYear(), fechaHoy.getMonth(), 1));
//        $(".txtFechaConsumo").datepicker("setDate", new Date(fechaHoy.getFullYear(), fechaHoy.getMonth(), 1));

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
            'EJECUTIVO',
            'CLIENTE',
            '# CHIPS',
            'PERIODO'
        ],
        colModel: [
            {name: 'EJECUTIVO', index: 'EJECUTIVO', sortable: false, frozen: true},
            {name: 'CLIENTE'
                , index: 'CLIENTE'
                , sortable: false
                , frozen: true
                , summaryType: 'count'
                , summaryTpl: '<b>{0} Orden(es)</b>'
            },
            {name: 'TOTALORDENES'
                , index: 'TOTALORDENES'
                , width: 80
                , align: "right"
                , sorttype: "float"
                , formatter: "number"
                , summaryType: 'sum'
            },
            {name: 'PERIODO'
                , index: 'PERIODO'
                , width: 120
                , sortable: false
                , frozen: false
                , sorttype: "date", formatter: "date"
            }
        ],
        pager: '#pagGrid',
        rowNum: 200, //NroFilas,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 300,
        width: 720,
//        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
//        rownumbers: true,
        grouping: true,
        groupingView: {
            groupField: ['EJECUTIVO']
            , groupSummary: [true]
            , groupColumnShow: [true]
            , groupText: ['<b>{0} - {TOTALORDENES} Chips(s) vendido(s)</b>']//, groupText: ['<b>{0}</b>']
            , groupCollapse: true
            , groupOrder: ['asc']
//            , showSummaryOnHide: true
        },

//        groupingView: {
//            groupField: ['name']
//            , groupColumnShow: [true]
//            , groupText: ['<b>{0} - {1} Item(s)</b>']
//            , groupCollapse: true
//            , groupOrder: ['desc']
//        },

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
    if ($("#ReporteOrdenesxFechaForm_fechaOrdenesInicio").val() != ""
            && $("#ReporteOrdenesxFechaForm_fechaOrdenesFin").val() != "") {
        window.open('/sisven/reporteordenesxfecha/' +accion
                + '?startDate=' + $("#ReporteOrdenesxFechaForm_fechaOrdenesInicio").val()
                + '&endDate=' + $("#ReporteOrdenesxFechaForm_fechaOrdenesFin").val()
                );
    } else {
        mostrarVentanaMensaje("Ingrese los parámetros necesarios para generar el reporte", 'Alerta');
    }
}

