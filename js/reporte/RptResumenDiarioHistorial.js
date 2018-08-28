$(document).ready(function () {
    ConfigDatePickersReporte('.txtfechagestion');
    ConfigDatePickersReporte('.txtfechaInicioFinJornadaInicio');

    ConfigurarGrids();
    $("#btnLimpiar").click(function () {
        LimpiarGrids();
    });

    $("#btnLimpiarCapilaridadSellIn").click(function () {
//        $("#ReporteInicioFinJornadaxFechaForm_fechaInicioFinJornadaInicio").val('');
        $("#tblCapilaridadMovistar").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblCapilaridadDelta").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblSellInMovistar").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblSellInVentas").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblVentaPeriodo").jqGrid("clearGridData", true).trigger("reloadGrid");
    });


    $("#btnExcelCapilaridadMovistar").click(function () {
        var options = {
            includeLabels: true,
            includeGroupHeader: true,
            includeFooter: true,
            fileName: "detalle_capilaridad_movistar.xlsx",
            mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            maxlength: 40,
            onBeforeExport: null,
            replaceStr: null
        }
        $("#tblCapilaridadMovistar").jqGrid('exportToExcel', options);
    });

    $("#btnExcelCapilaridadDelta").click(function () {
        var options = {
            includeLabels: true,
            includeGroupHeader: true,
            includeFooter: true,
            fileName: "detalle_capilaridad_delta.xlsx",
            mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            maxlength: 40,
            onBeforeExport: null,
            replaceStr: null
        }
        $("#tblCapilaridadDelta").jqGrid('exportToExcel', options);
    });

    $("#btnExcelNoVisitados").click(function () {
        GenerarDocumentoReporte('GenerateExcelNoVisitados');
    });
    $("#btnExcelDetalle").click(function () {
        GenerarDocumentoReporte('GenerateExcel');
    });
    $("#btnExcelEstadoRuta").click(function () {
        GenerarDocumentoReporte('GenerateExcelEstadoRuta');
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
    jQuery("#tblGridResumenJornada").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'VerDatosArchivo',
        colNames: [
            'FECHA',
            'EJECUTIVO',
            '1_VISITA',
            'U_VISITA',
            'GESTION',
            'TRASLADO',
            'TOTAL',
            'Semanas',
            'VISITAS',
            'REPETIDAS',
            'TOTAL',
            'NUEVOS',
            'EFECTIVOS',
            'ENCUESTAS',
            'VENTA'
        ],
        colModel: [
            {name: 'FECHA', index: 'FECHA', sortable: false, width: 150, hidden: true, frozen: true},
            {name: 'EJECUTIVO', index: 'EJECUTIVO', sortable: false, width: 110, frozen: true},
            {name: 'INICIOPRIMERAVISITA', index: 'INICIOPRIMERAVISITA', sortable: false, width: 70, align: "center", },
            {name: 'FINALULTIMAVISITA', index: 'FINALULTIMAVISITA', sortable: false, width: 70, align: "center", },
            {name: 'TIEMPOGESTION', index: 'TIEMPOGESTION', sortable: false, width: 80, align: "center", },
            {name: 'TIEMPOTRASLADO', index: 'TIEMPOTRASLADO', sortable: false, width: 80, align: "center", },
            {name: 'TOTALTIEMPO', index: 'TOTALTIEMPO', sortable: false, width: 80, align: "center", },
            {name: 'SEMANAS', index: 'SEMANAS', width: 60, align: "center"},
            {name: 'VISITAS', index: 'VISITAS', width: 60, align: "center"},
            {name: 'REPETIDAS', index: 'REPETIDAS', width: 80, align: "center"},
            {name: 'TOTAL', index: 'TOTAL', width: 60, align: "center"},
            {name: 'NUEVOS', index: 'NUEVOS', width: 80, align: "center"},
            {name: 'EFECTIVOS', index: 'EFECTIVOS', width: 80, align: "center"},
            {name: 'ENCUESTAS', index: 'ENCUESTAS', width: 85, align: "center"},
            {name: 'VENTA', index: 'VENTA', width: 80, align: "center"},
        ],
        pager: '#pagGridResumenJornada',
        rowNum: 200, //NroFilas,
        rowList: ElementosPagina,
        caption: 'Gestion dia',
        hidegrid: false,
        sortorder: 'ASC',
        viewrecords: true,
        height: 350,
        autowidth: true,
        gridview: true,
        shrinkToFit: false,
        footerrow: true,
        gridComplete: function () {
            var $grid = $('#tblGridResumenJornada');
            var colSumaVisitas = $grid.jqGrid('getCol', 'VISITAS', false, 'sum');
            var colSumaVisitasRepetidas = $grid.jqGrid('getCol', 'REPETIDAS', false, 'sum');
            var colSumaTotalVisitas = $grid.jqGrid('getCol', 'TOTAL', false, 'sum');
            var colSumaClientesNuevos = $grid.jqGrid('getCol', 'NUEVOS', false, 'sum');
            var colSumaClientesEfectivos = $grid.jqGrid('getCol', 'EFECTIVOS', false, 'sum');
            var colSumaEncuestas = $grid.jqGrid('getCol', 'ENCUESTAS', false, 'sum');
            var colSumaVenta = $grid.jqGrid('getCol', 'VENTA', false, 'sum');

            $grid.jqGrid('footerData', 'set', {'SEMANAS': 'Totales'});
            $grid.jqGrid('footerData', 'set', {'VISITAS': colSumaVisitas});
            $grid.jqGrid('footerData', 'set', {'REPETIDAS': colSumaVisitasRepetidas});
            $grid.jqGrid('footerData', 'set', {'TOTAL': colSumaTotalVisitas});
            $grid.jqGrid('footerData', 'set', {'NUEVOS': colSumaClientesNuevos});
            $grid.jqGrid('footerData', 'set', {'EFECTIVOS': colSumaClientesEfectivos});
            $grid.jqGrid('footerData', 'set', {'ENCUESTAS': colSumaEncuestas});
            $grid.jqGrid('footerData', 'set', {'VENTA': colSumaVenta});

        },
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el �ndice del identificador �nico de la entidad
        },

        beforeRequest: function () {},
        loadError: function (xhr, st, err) {}
    });
    jQuery("#tblGridResumenJornada").jqGrid('setFrozenColumns');

    jQuery("#tblGridResumenJornada").jqGrid('navGrid', '#pagGridResumenJornada',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );

    jQuery("#tblGridResumenJornada").jqGrid('navButtonAdd', '#pagGridResumenJornada', {
        caption: "Exportar",
        title: "Exportar reporte con detalle de la Jornada",
        onClickButton: function () {
            var options = {
                includeLabels: true,
                includeGroupHeader: true,
                includeFooter: true,
                fileName: "detalle_jornada.xlsx",
                mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                maxlength: 40,
                onBeforeExport: null,
                replaceStr: null
            }
            $("#tblGridResumenJornada").jqGrid('exportToExcel', options);
        }
    });

    jQuery("#tblGridDetalle").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
//            'FECHA REVISION',
            'FECHA RUTA',
//            'CODIGO USR',
//            'EJECUTIVO',
            'CODIGO',
            'CLIENTE',
            'RUTA H',
            '#H',
            'RUTA C',
            '#C',
            'ESTADO RUTA',
//            'ESTADO SEC',
            'CHIPS',
            'METROS',
            'VALIDACION'
        ],
        colModel: [
//            {name: 'FECHAREVISION', index: 'FECHAREVISION', width: 100, sortable: false, frozen: true},
            {name: 'FECHARUTA', index: 'FECHARUTA', width: 100, frozen: false, sortable: false, resizable: false, align: "center"},
//            {name: 'CODEJECUTIVO', index: 'CODEJECUTIVO', width: 100, sortable: false, frozen: true},
//            {name: 'EJECUTIVO', index: 'EJECUTIVO', width: 100, sortable: false, frozen: true},
            {name: 'CODIGOCLIENTE', index: 'CODIGOCLIENTE', width: 80, sortable: false, frozen: true},
            {name: 'CLIENTE', index: 'CLIENTE', width: 215, sortable: false, frozen: true},
            {name: 'RUTAUSADA', index: 'RUTAUSADA', width: 50, sortable: false, frozen: true, align: "center"},
            {name: 'SECUENCIAVISITA', index: 'SECUENCIAVISITA', width: 20, sortable: false, frozen: true, align: "center"},
            {name: 'RUTACLIENTE', index: 'RUTACLIENTE', width: 50, sortable: false, frozen: true, align: "center"},
            {name: 'SECUENCIARUTA', index: 'SECUENCIARUTA', width: 20, sortable: false, frozen: true, align: "center"},
            {name: 'ESTADOREVISIONR', index: 'ESTADOREVISIONR', width: 100, sortable: false, frozen: true, align: "center"},
//            {name: 'ESTADOREVISIONS', index: 'ESTADOREVISIONS', width: 95, sortable: false, frozen: true, align: "center"},
            {name: 'CHIPSCOMPRADOS', index: 'CHIPSCOMPRADOS', width: 40, sortable: false, formatter: "integer", summaryType: 'sum', align: "center"},
            {name: 'METROS', index: 'METROS', width: 60, sortable: false, formatter: "number", decimalSeparator: ".", thousandsSeparator: "", decimalPlaces: 2, defaultValue: '0.00', summaryType: 'sum', align: "right"},
            {name: 'VALIDACION', index: 'VALIDACION', width: 80, sortable: false, align: "center"},
        ],
        pager: '#pagGrid',
        rowNum: 6000,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 360,
//        width: 700,
        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
//        rownumbers: true,
        caption: "Detalle revision historial",
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
            id: "id" //representa el �ndice del identificador �nico de la entidad
        },
        beforeRequest: function () {
//            blockUIOpen();
        },
        loadError: function (xhr, st, err) {
//            blockUIClose();
            // RedirigirError(xhr.status);
        },
        loadComplete: function () {
            $("tr.jqgrow:odd").css("background", "#b7d2ff");
        },
    });
    jQuery("#tblGridDetalle").jqGrid('navGrid', '#pagGrid',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );

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
        height: 46,
        width: 300,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
        caption: "Cumplimiento / ventas",
        hidegrid: false,
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el �ndice del identificador �nico de la entidad
        }
        ,
        beforeRequest: function () { }
        ,
        loadError: function (xhr, st, err) { }
    }
    );
    jQuery("#tblResumenVisitas").jqGrid({
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
        height: 115,
        width: 300,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
        caption: "Resumen visitas",
        hidegrid: false,
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el �ndice del identificador �nico de la entidad
        }
        ,
        beforeRequest: function () { }
        ,
        loadError: function (xhr, st, err) { }
    }
    );
    jQuery("#tblResumenVisitasValidasInvalidas").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: ['Visita', 'Cantidad'],
        colModel: [
            {name: 'PARAMETRO', index: 'PARAMETRO', width: 110, sortable: false, frozen: true},
            {name: 'VALOR', index: 'VALOR', width: 90, sortable: false, frozen: true, align: 'center'}
        ],
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 46,
        width: 205,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
        caption: "Validacion Geoposicion",
        hidegrid: false,
        footerrow: true,
        gridComplete: function () {
            var $grid = $('#tblResumenVisitasValidasInvalidas');
            var colSum = $grid.jqGrid('getCol', 'VALOR', false, 'sum');
            $grid.jqGrid('footerData', 'set', {'PARAMETRO': 'Total Visitas'});
            $grid.jqGrid('footerData', 'set', {'VALOR': colSum});

        }
        , jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el �ndice del identificador �nico de la entidad
        }
        ,
        beforeRequest: function () { }
        ,
        loadError: function (xhr, st, err) { }
    }
    );
    jQuery("#tblPrimeraUltimaVisita").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: ['Parametro', 'Valor'],
        colModel: [
            {name: 'PARAMETRO', index: 'PARAMETRO', width: 100, sortable: false, frozen: true},
            {name: 'VALOR', index: 'VALOR', width: 90, sortable: false, frozen: true, align: 'center'}
        ],
//        pager: '#pagGrid',
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 46,
        width: 195,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
        caption: "Primera Ultima visitas",
        hidegrid: false,
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el �ndice del identificador �nico de la entidad
        }
        ,
        beforeRequest: function () { }
        ,
        loadError: function (xhr, st, err) { }
    }
    );

    jQuery("#tblResumenVentas").jqGrid({
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
        width: 300,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
        caption: "Detalle ventas",
        hidegrid: false,
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el �ndice del identificador �nico de la entidad
        }
        ,
        beforeRequest: function () { }
        ,
        loadError: function (xhr, st, err) { }
    }
    );
    jQuery("#tblResumenTiempos").jqGrid({
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
        width: 300,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
//        footerrow: true,
        caption: "Detalle tiempos",
        hidegrid: false,
//        gridComplete: function () {
//            var $grid = $('#tblResumenTiempos');
//            var colSum = $grid.jqGrid('getCol', 'VALOR', false, 'sum');
//            $grid.jqGrid('footerData', 'set', {'PARAMETRO': 'Total '});
//            $grid.jqGrid('footerData', 'set', {'VALOR': colSum});
//
//        },
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el �ndice del identificador �nico de la entidad
        }
        ,
        beforeRequest: function () { }
        ,
        loadError: function (xhr, st, err) { }
    }
    );

    jQuery("#tblCapilaridadMovistar").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'BODEGA'
                    , 'PRESP.'
                    , 'CUMPL.'
                    , 'X'
                    , '% CUMPL.'
                    , 'FALT.'
                    , '% FALT.'
                    , 'ULTIMA VENTA'
                    , 'CANT. VEND.'

        ],
        colModel: [
            {name: 'BODEGA', index: 'BODEGA', width: 100, sortable: false, frozen: true},
            {name: 'PRESUPUESTO', index: 'PRESUPUESTO', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'CUMPLIMIENTO', index: 'CUMPLIMIENTO', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'DESCARTAR', index: 'DESCARTAR', width: 30, sortable: false, frozen: true, align: 'center'},
            {name: 'PCUMPLIMIENTO', index: 'PCUMPLIMIENTO', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'FALTANTE', index: 'FALTANTE', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'PFALTANTE', index: 'PFALTANTE', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'UVENTA', index: 'UVENTA', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'VENTA', index: 'VENTA', width: 50, sortable: false, frozen: true, align: 'center'},
        ],
//        pager: '#pagGrid',
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 200,
        width: 500,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
        caption: "Capilaridad Movistar",
        hidegrid: false,
        pager: '#pagCapilaridadMovistar',
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el �ndice del identificador �nico de la entidad
        }
        , footerrow: true,
        gridComplete: function () {
            var $grid = $('#tblCapilaridadMovistar');
            var sumaPresupuestos = $grid.jqGrid('getCol', 'PRESUPUESTO', false, 'sum');
            var sumaCumplimiento = $grid.jqGrid('getCol', 'CUMPLIMIENTO', false, 'sum');
            var sumaDescartados = $grid.jqGrid('getCol', 'DESCARTAR', false, 'sum');
            var PCumplimiento = (sumaCumplimiento / sumaPresupuestos) * 100;
            var sumaVentas = $grid.jqGrid('getCol', 'VENTA', false, 'sum');
            $grid.jqGrid('footerData', 'set', {'BODEGA': 'Totales'});
            $grid.jqGrid('footerData', 'set', {'PRESUPUESTO': sumaPresupuestos});
            $grid.jqGrid('footerData', 'set', {'CUMPLIMIENTO': sumaCumplimiento});
            $grid.jqGrid('footerData', 'set', {'DESCARTAR': sumaDescartados});
            $grid.jqGrid('footerData', 'set', {'PCUMPLIMIENTO': PCumplimiento.toFixed(0).concat('%')});
            $grid.jqGrid('footerData', 'set', {'VENTA': sumaVentas});
        }
        , beforeRequest: function () { }
        , loadError: function (xhr, st, err) { }
        , loadComplete: function () {
            $("tr.jqgrow:odd").css("background", "#b7d2ff");
        },
    }
    );
    jQuery("#tblCapilaridadMovistar").jqGrid('navGrid', '#pagCapilaridadMovistar',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    jQuery("#tblCapilaridadMovistar").jqGrid('navButtonAdd', '#pagCapilaridadMovistar',
            {
                caption: "Reporte 1",
                title: "Exportar Reporte Detalle Capilaridad Movistar",
                onClickButton: function () {
                    var options = {
                        includeLabels: true,
                        includeGroupHeader: true,
                        includeFooter: true,
                        fileName: "detalle_capilaridad_movistar.xlsx",
                        mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                        maxlength: 40,
                        onBeforeExport: null,
                        replaceStr: null
                    }
                    $("#tblCapilaridadMovistar").jqGrid('exportToExcel', options);
                }});

    jQuery("#tblCapilaridadMovistar").jqGrid('navButtonAdd', '#pagCapilaridadMovistar',
            {
                caption: "Reporte 2",
                title: "Exportar Reporte Capilaridad Delta y Movistar",
                onClickButton: function () {
                    GenerarDocumentoReporte('GenerateExcelResumenCapilaridad');
                }
            }
    );

    jQuery("#tblCapilaridadDelta").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'BODEGA'
                    , 'PRESP.'
                    , 'CUMPL.'
                    , 'X'
                    , '% CUMPL.'
                    , 'FALT.'
                    , '% FALT.'
                    , 'ULTIMA VENTA'
                    , 'CANT. VEND.'

        ],
        colModel: [
            {name: 'D_BODEGA', index: 'D_BODEGA', width: 100, sortable: false, frozen: true},
            {name: 'D_PRESUPUESTO', index: 'D_PRESUPUESTO', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'D_CUMPLIMIENTO', index: 'D_CUMPLIMIENTO', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'D_DESCARTAR', index: 'D_DESCARTAR', width: 30, sortable: false, frozen: true, align: 'center'},
            {name: 'D_PCUMPLIMIENTO', index: 'D_PCUMPLIMIENTO', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'D_FALTANTE', index: 'D_FALTANTE', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'D_PFALTANTE', index: 'D_PFALTANTE', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'UVENTA', index: 'UVENTA', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'D_VENTA', index: 'D_VENTA', width: 50, sortable: false, frozen: true, align: 'center'},
        ],
//        pager: '#pagGrid',
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 200,
        width: 500,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
        caption: "Capilaridad Indicadores",
        hidegrid: false,
        pager: '#pagCapilaridadDelta',
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el �ndice del identificador �nico de la entidad
        }
        , footerrow: true,
        gridComplete: function () {
            var $grid = $('#tblCapilaridadDelta');
            var sumaPresupuestosD = $grid.jqGrid('getCol', 'D_PRESUPUESTO', false, 'sum');
            var sumaCumplimientoD = $grid.jqGrid('getCol', 'D_CUMPLIMIENTO', false, 'sum');
            var sumaVentasD = $grid.jqGrid('getCol', 'D_VENTA', false, 'sum');
            var PCumplimiento = (sumaCumplimientoD / sumaPresupuestosD) * 100;
            var sumaDescartados = $grid.jqGrid('getCol', 'D_DESCARTAR', false, 'sum');

            $grid.jqGrid('footerData', 'set', {'D_DESCARTAR': sumaDescartados});
            $grid.jqGrid('footerData', 'set', {'D_PCUMPLIMIENTO': PCumplimiento.toFixed(0).concat('%')});
            $grid.jqGrid('footerData', 'set', {'D_BODEGA': 'Totales'});
            $grid.jqGrid('footerData', 'set', {'D_PRESUPUESTO': sumaPresupuestosD});
            $grid.jqGrid('footerData', 'set', {'D_CUMPLIMIENTO': sumaCumplimientoD});
            $grid.jqGrid('footerData', 'set', {'D_VENTA': sumaVentasD});
        }
        , beforeRequest: function () { }
        , loadError: function (xhr, st, err) { }
        , loadComplete: function () {
            $("tr.jqgrow:odd").css("background", "#b7d2ff");
        },
    }
    );
    jQuery("#tblCapilaridadDelta").jqGrid('navGrid', '#pagCapilaridadDelta',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    jQuery("#tblCapilaridadDelta").jqGrid('navButtonAdd', '#pagCapilaridadDelta',
            {
                caption: "Reporte 1",
                title: "Exportar Reporte Detalle Capilaridad Delta",
                onClickButton: function () {
                    var options = {
                        includeLabels: true,
                        includeGroupHeader: true,
                        includeFooter: true,
                        fileName: "detalle_capilaridad_delta.xlsx",
                        mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                        maxlength: 40,
                        onBeforeExport: null,
                        replaceStr: null
                    }
                    $("#tblCapilaridadDelta").jqGrid('exportToExcel', options);
                }
            }
    );

    jQuery("#tblSellInMovistar").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'BODEGA'
                    , 'PRESP.'
                    , 'CUMPL.'
                    , '% CUMPL.'
                    , 'FALT.'
                    , '% FALT.'
                    , 'CANT. VEND.'

        ],
        colModel: [
            {name: 'BODEGA', index: 'BODEGA', width: 150, sortable: false, frozen: true},
            {name: 'PRESUPUESTO', index: 'PRESUPUESTO', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'CUMPLIMIENTO', index: 'CUMPLIMIENTO', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'PCUMPLIMIENTO', index: 'PCUMPLIMIENTO', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'FALTANTE', index: 'FALTANTE', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'PFALTANTE', index: 'PFALTANTE', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'VENTA', index: 'VENTA', width: 70, sortable: false, frozen: true, align: 'center'},
        ],
//        pager: '#pagGrid',
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 200,
        width: 500,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
        caption: "Sell-In Movistar",
        hidegrid: false,
        pager: '#pagSellInMovistar',
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el �ndice del identificador �nico de la entidad
        }
        , beforeRequest: function () { }
        , loadError: function (xhr, st, err) { }
        , loadComplete: function () {
            $("tr.jqgrow:odd").css("background", "#edfff6");
        }
        , footerrow: true,
        gridComplete: function () {
            var $grid = $('#tblSellInMovistar');
            var sumaPresupuestos = $grid.jqGrid('getCol', 'PRESUPUESTO', false, 'sum');
            var sumaCumplimiento = $grid.jqGrid('getCol', 'CUMPLIMIENTO', false, 'sum');
            var sumaVentas = $grid.jqGrid('getCol', 'VENTA', false, 'sum');
            var PCumplimiento = (sumaCumplimiento / sumaPresupuestos) * 100;

            $grid.jqGrid('footerData', 'set', {'PCUMPLIMIENTO': PCumplimiento.toFixed(0).concat('%')});
            $grid.jqGrid('footerData', 'set', {'BODEGA': 'Totales'});
            $grid.jqGrid('footerData', 'set', {'PRESUPUESTO': sumaPresupuestos});
            $grid.jqGrid('footerData', 'set', {'CUMPLIMIENTO': sumaCumplimiento});
            $grid.jqGrid('footerData', 'set', {'VENTA': sumaVentas});
        }
    }
    );
    jQuery("#tblSellInMovistar").jqGrid('navGrid', '#pagSellInMovistar',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    jQuery("#tblSellInMovistar").jqGrid('navButtonAdd', '#pagSellInMovistar',
            {
                caption: "Reporte 1",
                title: "Exportar Reporte Sell-In Movistar",
                onClickButton: function () {
                    var options = {
                        includeLabels: true,
                        includeGroupHeader: true,
                        includeFooter: true,
                        fileName: "detalle_capilaridad_delta.xlsx",
                        mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                        maxlength: 40,
                        onBeforeExport: null,
                        replaceStr: null
                    }
                    $("#tblSellInMovistar").jqGrid('exportToExcel', options);
                }
            }
    );
    jQuery("#tblSellInMovistar").jqGrid('navButtonAdd', '#pagSellInMovistar',
            {
                caption: "Reporte 2",
                title: "Exportar Reporte Sell-In Movistar y Delta",
                onClickButton: function () {
                    GenerarDocumentoReporte('GenerateExcelResumenSellIn');
                }
            }
    );

    jQuery("#tblSellInVentas").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'BODEGA'
                    , 'PRESP.'
                    , 'CUMPL.'
                    , '% CUMPL.'
                    , 'FALT.'
                    , '% FALT.'
                    , 'CANT. VEND.'

        ],
        colModel: [
            {name: 'BODEGA', index: 'BODEGA', width: 150, sortable: false, frozen: true},
            {name: 'PRESUPUESTO', index: 'PRESUPUESTO', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'CUMPLIMIENTO', index: 'CUMPLIMIENTO', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'PCUMPLIMIENTO', index: 'PCUMPLIMIENTO', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'FALTANTE', index: 'FALTANTE', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'PFALTANTE', index: 'PFALTANTE', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'VENTA', index: 'VENTA', width: 70, sortable: false, frozen: true, align: 'center'},
        ],
//        pager: '#pagGrid',
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 200,
        width: 500,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
        caption: "Sell-In Indicadores",
        hidegrid: false,
        pager: '#pagSellInVentas',
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el �ndice del identificador �nico de la entidad
        }
        , beforeRequest: function () { }
        , loadError: function (xhr, st, err) { }
        , loadComplete: function () {
            $("tr.jqgrow:odd").css("background", "#edfff6");
        }
        , footerrow: true,
        gridComplete: function () {
            var $grid = $('#tblSellInVentas');
            var sumaPresupuestos = $grid.jqGrid('getCol', 'PRESUPUESTO', false, 'sum');
            var sumaCumplimiento = $grid.jqGrid('getCol', 'CUMPLIMIENTO', false, 'sum');
            var sumaVentas = $grid.jqGrid('getCol', 'VENTA', false, 'sum');
            var PCumplimiento = (sumaCumplimiento / sumaPresupuestos) * 100;
            $grid.jqGrid('footerData', 'set', {'PCUMPLIMIENTO': PCumplimiento.toFixed(0).concat('%')});
            $grid.jqGrid('footerData', 'set', {'BODEGA': 'Totales'});
            $grid.jqGrid('footerData', 'set', {'PRESUPUESTO': sumaPresupuestos});
            $grid.jqGrid('footerData', 'set', {'CUMPLIMIENTO': sumaCumplimiento});
            $grid.jqGrid('footerData', 'set', {'VENTA': sumaVentas});
        }
    }
    );
    jQuery("#tblSellInVentas").jqGrid('navGrid', '#pagSellInVentas',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    jQuery("#tblSellInVentas").jqGrid('navButtonAdd', '#pagSellInVentas', {
        caption: "Reporte 1",
        title: "Exportar Reporte Sell-In Delta",
        onClickButton: function () {
            var options = {
                includeLabels: true,
                includeGroupHeader: true,
                includeFooter: true,
                fileName: "detalle_sell-in_delta.xlsx",
                mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                maxlength: 40,
                onBeforeExport: null,
                replaceStr: null
            }
            $("#tblSellInVentas").jqGrid('exportToExcel', options);
        }
    }
    );
}

function GenerarDocumentoReporte(accion) {
    window.open('/sisven_dev/RptResumenDiarioHistorial/' + accion);
}

function cargarPeriodosPorAnio(anio) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        cache: false,
        traditional: true,
        url: 'RptResumenDiarioHistorial/CargarPeriodosAnio',
        data: {anio: anio},
        success: function (jsonResponse) {
            if (!$.isEmptyObject(jsonResponse))
            {
                $("#divp").html(jsonResponse);
            }
        },
        error: function (xhr, st, err) {
        }
    });
}