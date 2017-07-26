$(document).ready(function () {
    ConfigGridJSON();
//    ConfigDatePickerRangeReport();

    ConfigDatePickersReporte('.txtfechaInicioFinJornadaInicio');
//    ConfigDatePickersReporte('.txtfechaInicioFinJornadaFin');

//    var fechaHoy = new Date();
//    $(".txtFechaConsumo").datepicker("setDate", new Date(fechaHoy.getFullYear(), fechaHoy.getMonth(), 1));


    $("#btnLimpiar").click(function () {
        $("#ReporteInicioFinJornadaxFechaForm_fechaInicioFinJornadaInicio").val('');

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
            'I PRIMERA VISITA',
            'F ULTIMA VISITA',
            'TIEMPO GESTION'
        ],
        colModel: [
            {name: 'EJECUTIVO', index: 'EJECUTIVO', sortable: false, frozen: true},
            {name: 'INICIOPRIMERAVISITA', index: 'INICIOPRIMERAVISITA', sortable: false, frozen: true},
            {name: 'FINALULTIMAVISITA', index: 'FINALULTIMAVISITA', sortable: false, frozen: true},
            {name: 'TIEMPOGESTION', index: 'TIEMPOGESTION', sortable: false, frozen: true},
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
//        grouping: true,
//        groupingView: {
//            groupField: ['EJECUTIVO']
//            , groupSummary: [true]
//            , groupColumnShow: [true]
//            , groupText: ['<b>{0} - {TOTALORDENES} Chips(s) vendido(s)</b>']//, groupText: ['<b>{0}</b>']
//            , groupCollapse: true
//            , groupOrder: ['asc']
////            , showSummaryOnHide: true
//        },

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
    if ($("#ReporteInicioFinJornadaxFechaForm_fechaInicioFinJornadaInicio").val() != "") {
        window.open('/sisven/reporteiniciofinjornadaxfecha/' + accion
                + '?startDate=' + $("#ReporteInicioFinJornadaxFechaForm_fechaInicioFinJornadaInicio").val()
                );
    } else {
        mostrarVentanaMensaje("Ingrese los parámetros necesarios para generar el reporte", 'Alerta');
    }
}

