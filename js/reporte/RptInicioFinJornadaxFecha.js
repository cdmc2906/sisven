$(document).ready(function () {
    ConfigGridJSON();
    ConfigDatePickersReporte('.txtfechaInicioFinJornadaInicio');

    $("#btnLimpiar").click(function () {
        $("#ReporteInicioFinJornadaxFechaForm_fechaInicioFinJornadaInicio").val('');
    });
    $("#btnExcelJornada").click(function () {
        GenerarDocumentoReporte('GenerateExcel');
    });
});


function ConfigGridJSON() {
    var filaSeleccionada;
    jQuery("#tblGrid").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'VerDatosArchivo',
        colNames: [
            'FECHA',
            'EJECUTIVO',
//            'CUMPLIMIENTO',
            'PRIMERA VISITA',
            'ULTIMA VISITA',
            'TOTAL GESTION',
            'GESTION',
            'TRASLADO',
            'SEMANAS',
            'VISITAS',
            'CLIENTES NUEVOS',
            'EFECTIVOS',
            'ENCUESTAS',
            'VENTA'
        ],
        colModel: [
            {name: 'FECHA', index: 'FECHA', sortable: false, frozen: true, width: 150, hidden: true, },
            {name: 'EJECUTIVO', index: 'EJECUTIVO', sortable: false, frozen: true, width: 150, },
            {name: 'INICIOPRIMERAVISITA', index: 'INICIOPRIMERAVISITA', sortable: false, frozen: true, width: 100, align: "center", },
            {name: 'FINALULTIMAVISITA', index: 'FINALULTIMAVISITA', sortable: false, frozen: true, width: 100, align: "center", },
            {name: 'TOTALTIEMPO', index: 'TOTALTIEMPO', sortable: false, frozen: true, width: 100, align: "center", },
            {name: 'TIEMPOGESTION', index: 'TIEMPOGESTION', sortable: false, frozen: true, width: 100, align: "center", },
            {name: 'TIEMPOTRASLADO', index: 'TIEMPOTRASLADO', sortable: false, frozen: true, width: 100, align: "center", },
            {name: 'SEMANAS', index: 'SEMANAS', width: 80, align: "left"},
            {name: 'VISITAS', index: 'VISITAS', width: 80, align: "left"},
            {name: 'NUEVOS', index: 'NUEVOS', width: 80, align: "left"},
            {name: 'EFECTIVOS', index: 'EFECTIVOS', width: 80, align: "left"},
            {name: 'ENCUESTAS', index: 'ENCUESTAS', width: 80, align: "left"},
            {name: 'VENTA', index: 'VENTA', width: 80, align: "left"},
        ],
        pager: '#pagGrid',
        rowNum: 200, //NroFilas,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        caption: 'Gestion dia',
        hidegrid: false,
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 270,
        width: 900,
//        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
//        onSelectRow: function (id) {
//            if (id && id !== filaSeleccionada) {
//                jQuery('#tblGrid').jqGrid('restoreRow', filaSeleccionada);
//                jQuery('#tblGrid').jqGrid('editRow', id, true);
//                filaSeleccionada = id;
//            }
//        },
//        editurl: "/sisven_2/ReporteInicioFinJornadaxFecha/GuardarRevision?datosFila=" + filaSeleccionada,
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

    jQuery("#tblGridDetalle").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'VerDatosArchivo',
        colNames: [
            'EJECUTIVO',
            'VISITAS',
            'DUPLICADAS',
            'TOTAL VISITAS',
        ],
        colModel: [
            {name: 'EJECUTIVO', index: 'EJECUTIVO', sortable: false, frozen: true, width: 200,
                editable: true, editoptions: {readonly: true, size: 25}, },
            {name: 'VISITAS', index: 'VISITAS', sortable: false, frozen: true, width: 100, align: "center",
                editable: true, editoptions: {readonly: true, size: 10}, },
            {name: 'VISITASDUPLICADAS', index: 'VISITASDUPLICADAS', sortable: false, frozen: true, width: 120, align: "center",
                editable: true, editoptions: {readonly: true, size: 10}, },
            {name: 'TOTALVISITAS', index: 'TOTALVISITAS', sortable: false, frozen: true, width: 100, align: "center",
                editable: true, editoptions: {readonly: true, size: 10}, },
        ],
        pager: '#pagGridDetalle',
        rowNum: 200, //NroFilas,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 220,
        width: 550,
        caption: 'Detalle Gestion',
        hidegrid: false,

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

    jQuery("#tblGridDetalle").jqGrid('navGrid', '#pagGridDetalle',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
}


function GenerarDocumentoReporte(accion) {
    if ($("#ReporteInicioFinJornadaxFechaForm_fechaInicioFinJornadaInicio").val() != "") {
        window.open('/sisven_dev/rptiniciofinjornadaxfecha/' + accion
                + '?startDate=' + $("#ReporteInicioFinJornadaxFechaForm_fechaInicioFinJornadaInicio").val()
                );
    } else {
        mostrarVentanaMensaje("Ingrese los parámetros necesarios para generar el reporte", 'Alerta');
    }
}