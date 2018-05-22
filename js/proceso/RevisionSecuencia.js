$(document).ready(function () {
    ConfigDatePickersReporte('.txtfechagestion');

    ConfigurarGrids();
    $("#btnLimpiar").click(function () {
        LimpiarGrids();
    });

    $("#btnExcel").click(function () {
        GenerarDocumentoReporte('GenerateExcel');
    });
    $("#btnExcelNoVisitados").click(function () {
        GenerarDocumentoReporte('GenerateExcelNoVisitados');
    });
    $("#btnExcelResumen").click(function () {
        GenerarDocumentoReporte('GenerateExcelResumen');
    });

    $("#btnExcelTiemposGestion").click(function () {
        GenerarDocumentoReporte('GenerateExcelTiemposGestion');
    });


    $('#RptResumenDiarioHistorialForm_ejecutivo').on('change', function (e) {
        LimpiarGrids();
    });
    $('#RptResumenDiarioHistorialForm_semanaRevision').on('change', function (e) {
        LimpiarGrids();
    });
    $('#RptResumenDiarioHistorialForm_horaInicioGestion').on('change', function (e) {
        LimpiarGrids();
    });
    $('#RptResumenDiarioHistorialForm_horaFinGestion').on('change', function (e) {
        LimpiarGrids();
    });
    $('#RptResumenDiarioHistorialForm_precisionVisitas').on('change', function (e) {
        LimpiarGrids();
    });
    $('#RptResumenDiarioHistorialForm_accionHistorial').on('change', function (e) {
        LimpiarGrids();
    });

});
function LimpiarGrids() {
    $("#d_comentariosSupervision").val('');
    $("#d_comentarioSupervision").val('');

    $("#tblGridDetalle").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblResumenGeneral").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblResumenVisitas").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblResumenVisitasValidasInvalidas").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblPrimeraUltimaVisita").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblResumenVentas").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblResumenTiempos").jqGrid("clearGridData", true).trigger("reloadGrid");
    initMap2();
}

function ConfigurarGrids() {

    jQuery("#tblResumenGeneral").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: ['Parametro', 'Valor'],
        colModel: [
            {name: 'PARAMETRO', index: 'PARAMETRO', width: 200, sortable: false, frozen: true},
            {name: 'VALOR', index: 'VALOR', width: 90, sortable: false, frozen: true, align: 'center'}
        ],
//        pager: '#pagGrid',
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 70,
        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Resumen",
        hidegrid: false,
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el ï¿½ndice del identificador ï¿½nico de la entidad
        }
        ,
        beforeRequest: function () { }
        ,
        loadError: function (xhr, st, err) { }
    }
    );
    jQuery("#tblGridRuta").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'Ruta',
            'Fecha',
            'Codigo',
            'Cliente',
            'Estado',
            'Sec Ruta',
            'Sec Hist',
            'Inicio',
            'Fin',
            'Tiempo',
            'Metros',
            'Venta',
        ],
        colModel: [
            {name: 'RUTA', index: 'RUTA', width:50, frozen: false, sortable: false, resizable: false, align: "center"},
            {name: 'FECHAHISTORIAL', index: 'FECHAHISTORIAL', width: 60, frozen: false, sortable: false, resizable: false, align: "center"},
            {name: 'CODIGOCLIENTE', index: 'CODIGOCLIENTE', width: 80, sortable: false, frozen: true},
            {name: 'CLIENTE', index: 'CLIENTE', width: 150, sortable: false, frozen: true},
            {name: 'ESTADO', index: 'ESTADO', width: 60, sortable: false, align: "right"},
            {name: 'SECUENCIARUTA', index: 'SECUENCIARUTA', width: 60, sortable: false, align: "right"}, //hidden:'true'
            {name: 'SECUENCIAHISTORIAL', index: 'SECUENCIAHISTORIAL', width: 60, sortable: false, align: "right"},
            {name: 'INICIO GESTION', index: 'INICIO GESTION', width: 60, sortable: false, align: "right"},
            {name: 'FINGESTION', index: 'FINGESTION', width: 60, sortable: false, align: "right"},
            {name: 'TIEMPOGESTION', index: 'TIEMPOGESTION', width: 60, sortable: false, align: "right"},
            {name: 'METROSVISITA', index: 'METROSVISITA', width: 60, sortable: false, align: "right"},
            {name: 'VENTA', index: 'VENTA', width: 60, sortable: false, align: "right"},
        ],
        pager: '#pagGridRuta',
        rowNum: 100,
        rowList: 10,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 210,
//        width: 700,
        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        rownumbers: true,
        caption: "Detalle ruta",
        hidegrid: false,
        footerrow: true
        , gridComplete: function () {
            var $grid = $('#tblGridDetalle');
            var colSum = $grid.jqGrid('getCol', 'CHIPSCOMPRADOS', false, 'sum');
            $grid.jqGrid('footerData', 'set', {'ESTADOREVISIONS': 'Total Venta'});
            $grid.jqGrid('footerData', 'set', {'CHIPSCOMPRADOS': colSum});

        },
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

    jQuery("#tblGridRuta").jqGrid('navGrid', '#pagGridRuta',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    jQuery("#tblGridHistorial").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'Fecha Historial',
            'Fecha Revision',
            'Codigo',
            'Cliente',
            'Estado',
            'Responsable',
            'Comentario',
        ],
        colModel: [
            {name: 'FECHAHISTORIAL', index: 'FECHAHISTORIAL', width: 100, frozen: false, sortable: false, resizable: false, align: "center"},
            {name: 'FECHAREVISION', index: 'FECHAREVISION', width: 100, frozen: false, sortable: false, resizable: false, align: "center"},
            {name: 'CODIGOCLIENTE', index: 'CODIGOCLIENTE', width: 80, sortable: false, frozen: true},
            {name: 'CLIENTE', index: 'CLIENTE', width: 150, sortable: false, frozen: true},
            {name: 'ESTADO', index: 'ESTADO', width: 60, sortable: false, formatter: "number", decimalSeparator: ".", thousandsSeparator: "", decimalPlaces: 2, defaultValue: '0.00', summaryType: 'sum', align: "right"},
            {name: 'RESPONSABLE', index: 'RESPONSABLE', width: 60, sortable: false, formatter: "number", decimalSeparator: ".", thousandsSeparator: "", decimalPlaces: 2, defaultValue: '0.00', summaryType: 'sum', align: "right"},
            {name: 'COMENTARIO', index: 'COMENTARIO', width: 60, sortable: false, formatter: "number", decimalSeparator: ".", thousandsSeparator: "", decimalPlaces: 2, defaultValue: '0.00', summaryType: 'sum', align: "right"},
        ],
        pager: '#pagGrid',
        rowNum: 10,
        rowList: 10,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 200,
//        width: 700,
        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
//        rownumbers: true,
        caption: "Detalle historial visitas anteriores",
        hidegrid: false,
        footerrow: true
        , gridComplete: function () {
            var $grid = $('#tblGridDetalle');
            var colSum = $grid.jqGrid('getCol', 'CHIPSCOMPRADOS', false, 'sum');
            $grid.jqGrid('footerData', 'set', {'ESTADOREVISIONS': 'Total Venta'});
            $grid.jqGrid('footerData', 'set', {'CHIPSCOMPRADOS': colSum});

        },
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

}

function GenerarDocumentoReporte(accion) {
    if (true) {
        window.open('/sisven/RptResumenDiarioHistorial/' + accion);
    } else {
        mostrarVentanaMensaje("Ingrese los parámetros necesarios para generar el reporte", 'Alerta');
    }
}