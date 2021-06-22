$(document).ready(function () {
    ConfigDatePickersReporte('.txtfechagestion');
    ConfigDatePickersReporteMismoMes('.txtfechaInicioJornada', '.txtfechaFinJornada');

    ConfigurarGrids();
    mostrarPeriodos();

    $("#tblAltasFZPorTipoBodega").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblAltasFZPorBodega").jqGrid("clearGridData", true).trigger("reloadGrid");

    $("#btnEnviarMail").click(function () {
        EnviarMail();
    });

    $("#btnEstadoEnviarMail").click(function () {
        var e = document.getElementById("RptResumenDiarioHistorialForm_tipoUsuarioPeriodo");
        var strUser = e.value;
//        alert(strUser)
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


    $("#btnLimpiarRevisionHistorial").click(function () {
        LimpiarGrids();
    });

    $("#btnLimpiarCapilaridadSellIn").click(function () {
        $("#tblCapilaridadMovistar").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblCapilaridadDelta").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblSellInMovistar").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblSellInVentas").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#gridPivotVentasPeriodo").html("<table id=\"tblVentaPeriodo\" class=\"table table-condensed\"></table><div id=\"pagtblVentaPeriodo\"> </div>");
    });

    $("#btnLimpiarAltas").click(function () {

        document.getElementById("RptResumenDiarioHistorialForm_anioFiltro").value = "";
        document.getElementById("periodos").value = "";

        $("#tblAltasSinVenta").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblAltasDiaProyeccion").jqGrid("clearGridData", true).trigger("reloadGrid");

        $("#gridPivotAltasCiudad").html("<table id=\"tblAltasCiudad\" class=\"table table-condensed\"></table><div id=\"pagtblAltasCiudad\"> </div>");
        $("#gridPivotAltasCiudadEjecutivo").html("<table id=\"tblAltasCiudadEjecutivo\" class=\"table table-condensed\"></table><div id=\"pagtblAltasCiudadEjecutivo\"></div>");
    });

    $("#btnLimpiarRevisionJornada").click(function () {

        document.getElementById("RptResumenDiarioHistorialForm_fechaInicioFinJornada").value = "";
        document.getElementById("RptResumenDiarioHistorialForm_tipoUsuarioJornada").value = "T";
        document.getElementById("RptResumenDiarioHistorialForm_horaInicioGestionJornada").value = "08:00";
        document.getElementById("RptResumenDiarioHistorialForm_horaFinGestionJornada").value = "23:59";

        $("#tblGridResumenJornada").jqGrid("clearGridData", true).trigger("reloadGrid");
    });

    $('#RptResumenDiarioHistorialForm_tipoUsuarioJornada').on('change', function (e) {
        $("#gridPivotGestionMes").html("<table id=\"tblGestionMes\" class=\"table table-condensed\"></table><div id=\"pagtblGestionMes\"> </div>");
        var e = document.getElementById("RptResumenDiarioHistorialForm_tipoUsuarioJornada");
        var strUser = e.selectedIndex;
//        alert(strUser)
        if (strUser == 1)//selecciona opcion seleccion ejecutivo
        {
            document.getElementById("grilla_sel_ejecutivos").style.display = "block";
            cargarEjecutivos();
        } else {
            document.getElementById("grilla_sel_ejecutivos").style.display = "none";
        }
    });

    $('#RptResumenDiarioHistorialForm_tipoFechaJornadaPeriodo').on('change', function (e) {
        $("#gridPivotGestionMes").html("<table id=\"tblGestionMes\" class=\"table table-condensed\"></table><div id=\"pagtblGestionMes\"> </div>");
        document.getElementById("RptResumenDiarioHistorialForm_fechaInicioJornadaPeriodo").value = '';
        document.getElementById("RptResumenDiarioHistorialForm_fechaFinJornadaPeriodo").value = '';


        var e = document.getElementById("RptResumenDiarioHistorialForm_tipoFechaJornadaPeriodo");
        var strUser = e.selectedIndex;
//        alert(strUser)
        if (strUser == 0)//Periodo
        {
            document.getElementById("grilla_periodos_mensuales").style.display = "block";
            document.getElementById("grilla_fecha_inicio_fin").style.display = "none";
        } else if (strUser == 1) {//rangoFechas
            document.getElementById("grilla_periodos_mensuales").style.display = "none";
            document.getElementById("grilla_fecha_inicio_fin").style.display = "block";
        }
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
            'USR',
            'INICIO_VISITA',
            'FIN_VISITA',
            'TIEMPO_GESTION',
            'TIEMPO_TRASLADO',
            'TOTAL_GESTION',
            'TOTAL_GESTION_TEXTO',
            'TIEMPO_PROMEDIO_X_CLIENTE',
            'CLIENTES_RUTA',
            
            'GESTION_CAMPO',
            'GESTION_TELEFONICA',
            
            'RUTA',
            'CLIENTES_NUEVOS',
            'VISITAS',
            'VISITAS_REPETIDAS',
            'TOTAL_VISITAS',
            'CLIENTES_CERRADOS',
            'CLIENTES_PROPIOS',
            'CLIENTE_TEMPORAL',
            'CLIENTES_DESCONOCIDOS',
            'SEMANA(S)',
            'EFECTIVOS',
            'ENCUESTAS',
            'VENTA'
        ],
        colModel: [
//            , exportcol: true, hidden: true //opciones para que sea exportable y escondido
            {name: 'FECHA', index: 'FECHA', sortable: false, width: 80, frozen: false},
            {name: 'EJECUTIVO', index: 'EJECUTIVO', sortable: false, width: 250, frozen: false},
            {name: 'USR', index: 'USR', sortable: false, width: 50, frozen: false},
            {name: 'INICIOPRIMERAVISITA', index: 'INICIOPRIMERAVISITA', sortable: false, width: 70, align: "center", },
            {name: 'FINALULTIMAVISITA', index: 'FINALULTIMAVISITA', sortable: false, width: 70, align: "center", },
            {name: 'TIEMPOGESTION', index: 'TIEMPOGESTION', sortable: false, width: 120, align: "center", },
            {name: 'TIEMPOTRASLADO', index: 'TIEMPOTRASLADO', sortable: false, width: 120, align: "center", },
            {name: 'TOTALTIEMPO', index: 'TOTALTIEMPO', sortable: false, width: 120, align: "center", },
            {name: 'TOTALTIEMPOTEXTO', index: 'TOTALTIEMPOTEXTO', sortable: false, width: 150, align: "center", },
            {name: 'PROMEDIOXCLIENTE', index: 'PROMEDIOXCLIENTE', width: 200, align: "center"},
            {name: 'ENRUTA', index: 'ENRUTA', width: 120, align: "center"},
            
            {name: 'GESTION_CAMPO', index: 'GESTION_CAMPO', width: 120, align: "center"},
            {name: 'GESTION_TELEFONICA', index: 'GESTION_TELEFONICA', width: 120, align: "center"},
            
            {name: 'RUTA', index: 'ENRUTA', width: 80, align: "center"},
            {name: 'NUEVOS', index: 'NUEVOS', width: 120, align: "center"},
            {name: 'VISITAS', index: 'VISITAS', width: 60, align: "center"},
            {name: 'REPETIDAS', index: 'REPETIDAS', width: 80, align: "center"},
            {name: 'TOTAL', index: 'TOTAL', width: 60, align: "center"},
            {name: 'CERRADOS', index: 'CERRADOS', width: 100, align: "center"},
            {name: 'PROPIOS', index: 'PROPIOS', width: 80, align: "center", hide: "true"},
            {name: 'TEMPORAL', index: 'TEMPORAL', width: 80, align: "center"},
            {name: 'DESCONOCIDO', index: 'DESCONOCIDO', width: 100, align: "center"},
            {name: 'SEMANAS', index: 'SEMANAS', width: 80, align: "center"},
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

            var colSumaEnRuta = $grid.jqGrid('getCol', 'ENRUTA', false, 'sum');
            var colSumaPropios = $grid.jqGrid('getCol', 'PROPIOS', false, 'sum');
            var colSumaTemporal = $grid.jqGrid('getCol', 'TEMPORAL', false, 'sum');
            var colSumaDesconocido = $grid.jqGrid('getCol', 'DESCONOCIDO', false, 'sum');
            var colSumaTotalVisitas = $grid.jqGrid('getCol', 'TOTAL', false, 'sum');
            var colSumaClientesNuevos = $grid.jqGrid('getCol', 'NUEVOS', false, 'sum');
            var colSumaClientesCerrados = $grid.jqGrid('getCol', 'CERRADOS', false, 'sum');
            var colSumaClientesEfectivos = $grid.jqGrid('getCol', 'EFECTIVOS', false, 'sum');
            var colSumaEncuestas = $grid.jqGrid('getCol', 'ENCUESTAS', false, 'sum');
            var colSumaVenta = $grid.jqGrid('getCol', 'VENTA', false, 'sum');
            
            var colSumaEnCampo = $grid.jqGrid('getCol', 'GESTION_CAMPO', false, 'sum');
            var colSumaEnTelefono = $grid.jqGrid('getCol', 'GESTION_TELEFONICA', false, 'sum');
            var colSumaOtros = $grid.jqGrid('getCol', 'GESTION_OTROS', false, 'sum');

            $grid.jqGrid('footerData', 'set', {'PROMEDIOXCLIENTE': 'Totales'});
            $grid.jqGrid('footerData', 'set', {'ENRUTA': colSumaEnRuta});
            $grid.jqGrid('footerData', 'set', {'VISITAS': colSumaVisitas});
            $grid.jqGrid('footerData', 'set', {'REPETIDAS': colSumaVisitasRepetidas});

            $grid.jqGrid('footerData', 'set', {'GESTION_CAMPO': colSumaEnCampo});
            $grid.jqGrid('footerData', 'set', {'GESTION_TELEFONICA': colSumaEnTelefono});
            $grid.jqGrid('footerData', 'set', {'GESTION_OTROS': colSumaOtros});


            $grid.jqGrid('footerData', 'set', {'PROPIOS': colSumaPropios});
            $grid.jqGrid('footerData', 'set', {'TEMPORAL': colSumaTemporal});
            $grid.jqGrid('footerData', 'set', {'DESCONOCIDO': colSumaDesconocido});

            $grid.jqGrid('footerData', 'set', {'TOTAL': colSumaTotalVisitas});
            $grid.jqGrid('footerData', 'set', {'NUEVOS': colSumaClientesNuevos});
            $grid.jqGrid('footerData', 'set', {'CERRADOS': colSumaClientesCerrados});
            $grid.jqGrid('footerData', 'set', {'EFECTIVOS': colSumaClientesEfectivos});
            $grid.jqGrid('footerData', 'set', {'ENCUESTAS': colSumaEncuestas});
            $grid.jqGrid('footerData', 'set', {'VENTA': colSumaVenta});
        },
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el ï¿½ndice del identificador ï¿½nico de la entidad
        },
        beforeRequest: function () {},
        loadError: function (xhr, st, err) {}
    });
    jQuery("#tblGridResumenJornada").jqGrid('setFrozenColumns');
    jQuery("#tblGridResumenJornada").jqGrid('navGrid', '#pagGridResumenJornada',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false},
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}
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

    //PESTAÑA REVISION HISTORIAL
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
        width: 1000,
//        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
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
            id: "id" //representa el ï¿½ndice del identificador ï¿½nico de la entidad
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
            {add: false, edit: false, del: false, search: true, refresh: true, view: false},
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}
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
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 46,
        width: 300,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Cumplimiento / ventas",
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
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Resumen visitas",
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
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
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
            id: "id" //representa el ï¿½ndice del identificador ï¿½nico de la entidad
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
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Primera Ultima visitas",
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
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Detalle ventas",
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
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
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
            id: "id" //representa el ï¿½ndice del identificador ï¿½nico de la entidad
        }
        ,
        beforeRequest: function () { }
        ,
        loadError: function (xhr, st, err) { }
    }
    );

    //PESTAÑA CAPILARIDAD Y SELL IN
    //CAPILARIDAD MOVISTAR
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
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Capilaridad Movistar",
        hidegrid: false,
        pager: '#pagCapilaridadMovistar',
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el ï¿½ndice del identificador ï¿½nico de la entidad
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
            {add: false, edit: false, del: false, search: true, refresh: true, view: false},
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

    //CAPILARIDAD DELTA
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
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Capilaridad Indicadores",
        hidegrid: false,
        pager: '#pagCapilaridadDelta',
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el ï¿½ndice del identificador ï¿½nico de la entidad
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
            {add: false, edit: false, del: false, search: true, refresh: true, view: false},
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}
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

    //SELLIN MOVISTAR
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
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Sell-In Movistar",
        hidegrid: false,
        pager: '#pagSellInMovistar',
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el ï¿½ndice del identificador ï¿½nico de la entidad
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
            {add: false, edit: false, del: false, search: true, refresh: true, view: false},
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}
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

    //SELLIN DELTA
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
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Sell-In Indicadores",
        hidegrid: false,
        pager: '#pagSellInVentas',
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el ï¿½ndice del identificador ï¿½nico de la entidad
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
            $grid.jqGrid('footerData', 'set', {'PCUMPLIMIENTO': PCumplimiento.toFixed(2).concat('%')});
            $grid.jqGrid('footerData', 'set', {'BODEGA': 'Totales'});
            $grid.jqGrid('footerData', 'set', {'PRESUPUESTO': sumaPresupuestos});
            $grid.jqGrid('footerData', 'set', {'CUMPLIMIENTO': sumaCumplimiento});
            $grid.jqGrid('footerData', 'set', {'VENTA': sumaVentas});
        }
    }
    );
    jQuery("#tblSellInVentas").jqGrid('navGrid', '#pagSellInVentas',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false},
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}
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

    jQuery("#tblAltasCiudadDetalle").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'MIN',
            'PLAN',
            'FECHA ALTA',
            'CODIGO VENDEDOR',
            'CIUDAD',
            'ICC',
            'MES ALTA',
            'MES VENTA',
            'BODEGA',
            'VENDEDOR',
            'CODIGO CLIENTE',
            'CLIENTE',
            'TIPO CLIENTE',
            'TRANSFERIDO A',
            'FECHA TX',
        ],
        colModel: [
            {name: 'MIN', index: 'MIN', width: 100, sortable: false, frozen: true, align: 'center'},
            {name: 'PLAN', index: 'PLAN', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'FECHA_ALTA', index: 'FECHA_ALTA', width: 80, sortable: false, frozen: true, align: 'center'},
            {name: 'CODIGO_VENDEDOR', index: 'CODIGO_VENDEDOR', width: 80, sortable: false, frozen: true, align: 'left'},
            {name: 'CIUDAD', index: 'CIUDAD', width: 50, sortable: false, frozen: true, align: 'left'},
            {name: 'ICC', index: 'ICC', width: 150, sortable: false, frozen: true, align: 'left'},
            {name: 'MES_ALTA', index: 'MES_ALTA', width: 70, sortable: false, frozen: true, align: 'center'},
            {name: 'MES_VENTA', index: 'MES_VENTA', width: 70, sortable: false, frozen: true, align: 'center'},
            {name: 'BODEGA', index: 'BODEGA', width: 150, sortable: false, frozen: true, align: 'left'},
            {name: 'VENDEDOR', index: 'VENDEDOR', width: 200, sortable: false, frozen: true, align: 'left'},
            {name: 'CODIGO_CLIENTE', index: 'CODIGO_CLIENTE', width: 120, sortable: false, frozen: true, align: 'left'},
            {name: 'CLIENTE', index: 'CLIENTE', width: 220, sortable: false, frozen: true, align: 'left'},
            {name: 'TIPO_CLIENTE', index: 'TIPO_CLIENTE', width: 120, sortable: false, frozen: true, align: 'left'},
            {name: 'TRANSFERIDO_A', index: 'TRANSFERIDO_A', width: 200, sortable: false, frozen: true, align: 'left'},
            {name: 'FECHA_TRANSFERENCIA', index: 'FECHA_TRANSFERENCIA', width: 120, sortable: false, frozen: true, align: 'center'},
        ],
//        pager: '#pagGrid',
        rowNum: 10000,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 200,
        width: 1000,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Detalle Altas Ventas Transferencias",
        hidegrid: false,
        pager: '#pagtblAltasCiudadDetalle',
        jsonReader: {root: "Result", repeatitems: false, id: "id"}
        , beforeRequest: function () { }
        , loadError: function (xhr, st, err) { }
    }
    );
    jQuery("#tblAltasCiudadDetalle").jqGrid('navGrid', '#pagtblAltasCiudadDetalle',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false},
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}
    );
    jQuery("#tblAltasCiudadDetalle").jqGrid('navButtonAdd', '#pagtblAltasCiudadDetalle',
            {
                caption: "Exportar",
                title: "Exportar Reporte Detalle vs Tx Movistar",
                onClickButton: function () {
                    var options = {
                        includeLabels: true,
                        includeGroupHeader: true,
                        includeFooter: true,
                        fileName: "detalle_altas_ventas_transferencia.xlsx",
                        mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                        maxlength: 40,
                        onBeforeExport: null,
                        replaceStr: null
                    }
                    $("#tblAltasCiudadDetalle").jqGrid('exportToExcel', options);
                }
            }
    );

    jQuery("#tblAltasSinVenta").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'A_CIUDAD'
                    , 'A_MIN'
                    , 'A_ICC'
                    , 'TX_MIN'
                    , 'TX_ORIGEN'
                    , 'TX_DESTINO'
                    , 'TX_FECHA'
                    , 'VM_MIN'
                    , 'VM_ORIGEN'
                    , 'VM_DESTINO'
                    , 'VM_FECHA'
        ],
        colModel: [
            {name: 'A_CIUDAD', index: 'A_CIUDAD', width: 100, sortable: false, frozen: true, align: 'center'},
            {name: 'A_MIN', index: 'A_MIN', width: 100, sortable: false, frozen: true, align: 'center'},
            {name: 'A_ICC', index: 'A_ICC', width: 150, sortable: false, frozen: true, align: 'center'},
            {name: 'TX_MIN', index: 'TX_MIN', width: 120, sortable: false, frozen: true, align: 'center'},
            {name: 'TX_ORIGEN', index: 'TX_ORIGEN', width: 120, sortable: false, frozen: true, align: 'left'},
            {name: 'TX_DESTINO', index: 'TX_DESTINO', width: 120, sortable: false, frozen: true, align: 'left'},
            {name: 'TX_FECHA', index: 'TX_FECHA', width: 120, sortable: false, frozen: true, align: 'center'},
            {name: 'VM_MIN', index: 'VM_MIN', width: 80, sortable: false, frozen: true, align: 'center'},
            {name: 'VM_ORIGEN', index: 'VM_ORIGEN', width: 80, sortable: false, frozen: true, align: 'left'},
            {name: 'VM_DESTINO', index: 'VM_DESTINO', width: 100, sortable: false, frozen: true, align: 'left'},
            {name: 'VM_FECHA', index: 'VM_FECHA', width: 80, sortable: false, frozen: true, align: 'center'},
        ],
//        pager: '#pagGrid',
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 200,
        width: 1000,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Altas sin venta",
        hidegrid: false,
        pager: '#pagtblAltasSinVenta',
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el ï¿½ndice del identificador ï¿½nico de la entidad
        }
        , beforeRequest: function () { }
        , loadError: function (xhr, st, err) { }
    }
    );
    jQuery("#tblAltasSinVenta").jqGrid('navGrid', '#pagtblAltasSinVenta',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    jQuery("#tblAltasSinVenta").jqGrid('navButtonAdd', '#pagtblAltasSinVenta', {
        caption: "Exportar",
        title: "Exportar Reporte Altas sin venta. Indica la bodega de transferencia en Movistar",
        onClickButton: function () {
            var options = {
                includeLabels: true,
                includeGroupHeader: true,
                includeFooter: true,
                fileName: "altas_sin_venta.xlsx",
                mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                maxlength: 40,
                onBeforeExport: null,
                replaceStr: null
            }
            $("#tblAltasSinVenta").jqGrid('exportToExcel', options);
        }
    }
    );

    //proeyccion
    jQuery("#tblAltasDiaProyeccion").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'TIPO'
                    , 'DIAS'
                    , 'XDIA'
                    , 'PROY'
        ],
        colModel: [
            {name: 'TIPO', index: 'TIPO', width: 120, sortable: false, frozen: true},
            {name: 'DIAS', index: 'DIAS', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'ALTADIA', index: 'ALTADIA', width: 50, sortable: false, frozen: true, align: 'center'},
            {name: 'PROYECCION', index: 'PROYECCION', width: 50, sortable: false, frozen: true, align: 'center'},
        ],
//        pager: '#pagGrid',
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 200,
        width: 300,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Altas dia y proyeccion",
        hidegrid: false,
        pager: '#pagtblAltasDiaProyeccion',
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el ï¿½ndice del identificador ï¿½nico de la entidad
        }
        , beforeRequest: function () { }
        , loadError: function (xhr, st, err) { }
    }
    );
    jQuery("#tblAltasDiaProyeccion").jqGrid('navGrid', '#pagtblAltasDiaProyeccion',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    jQuery("#tblAltasDiaProyeccion").jqGrid('navButtonAdd', '#pagtblAltasDiaProyeccion', {
        caption: "Exportar",
        title: "Exportar Reporte Altas diarias y proyeccion",
        onClickButton: function () {
            var options = {
                includeLabels: true,
                includeGroupHeader: true,
                includeFooter: true,
                fileName: "altas_dia_proyeccion.xlsx",
                mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                maxlength: 40,
                onBeforeExport: null,
                replaceStr: null
            }
            $("#tblAltasDiaProyeccion").jqGrid('exportToExcel', options);
        }
    }
    );

    //Tab Altas fuera de zona 
    jQuery("#tblPeriodos").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'ANIO'
                    , 'MES'
                    , 'INICIO'
                    , 'FIN'
        ],
        colModel: [
            {name: 'ANIO', index: 'ANIO', width: 50, sortable: false, frozen: true},
            {name: 'MES', index: 'MES', width: 120, sortable: false, frozen: true, align: 'center'},
            {name: 'INICIO', index: 'INICIO', width: 80, sortable: false, frozen: true, align: 'center'},
            {name: 'FIN', index: 'FIN', width: 80, sortable: false, frozen: true, align: 'center'},
        ],
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 150,
        width: 350,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Periodos",
        hidegrid: false,
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el ï¿½ndice del identificador ï¿½nico de la entidad
        }
        , beforeRequest: function () { }
        , loadError: function (xhr, st, err) { }
        , onSelectRow: function (idFilaSeleccionada) {
            var fila = jQuery("#tblPeriodos").jqGrid('getRowData', idFilaSeleccionada);
            jQuery("#tblAltasFZPorTipoBodega").jqGrid('setCaption', "Tipos Bodega periodo " + fila.ANIO + " - " + fila.MES).trigger('reloadGrid');
            $("#tblAltasFZPorTipoBodega").jqGrid("clearGridData", true).trigger("reloadGrid");
            $("#tblAltasFZPorBodega").jqGrid("clearGridData", true).trigger("reloadGrid");
            mostrarDetallesXPeriodo(fila.INICIO, fila.FIN, fila.ANIO, fila.MES);
        }
    }
    );

    jQuery("#tblAltasFZPorTipoBodega").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'TIPO BODEGA',
            'CIUDADES',
            'ALTAS'
        ],
        colModel: [
            {name: 'TIPO', index: 'TIPO', width: 120, sortable: true, frozen: true},
            {name: 'CIUDADES', index: 'CIUDADES', width: 70, sortable: true, frozen: true, align: 'center'},
            {name: 'ALTAS', index: 'ALTAS', width: 60, sortable: true, frozen: true, align: 'center'},
        ],
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 150,
        width: 280,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Tipos Bodega periodo",
        hidegrid: false,
        pager: '#pagtblAltasFZPorTipoBodega',
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el ï¿½ndice del identificador ï¿½nico de la entidad
        }
        , beforeRequest: function () { }
        , loadError: function (xhr, st, err) { }
        , onSelectRow: function (idFilaSeleccionada) {
            var fila = jQuery("#tblAltasFZPorTipoBodega").jqGrid('getRowData', idFilaSeleccionada);
            jQuery("#tblAltasFZPorBodega").jqGrid('setCaption', "Altas por Bodega tipo " + fila.TIPO).trigger('reloadGrid');
            $("#tblAltasFZPorBodega").jqGrid("clearGridData", true).trigger("reloadGrid");
            mostrarDetallesTipoBodega(fila.TIPO);
        },
        footerrow: true,
        gridComplete: function () {
            var $grid = $('#tblAltasFZPorTipoBodega');
            var sumaAltas = $grid.jqGrid('getCol', 'ALTAS', false, 'sum');
            $grid.jqGrid('footerData', 'set', {'TIPO': 'TOTAL :'});
            $grid.jqGrid('footerData', 'set', {'ALTAS': sumaAltas});
        }
    }
    );
    jQuery("#tblAltasFZPorTipoBodega").jqGrid('navGrid', '#pagtblAltasFZPorTipoBodega',
            {add: false, edit: false, del: false, search: false, refresh: false, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    jQuery("#tblAltasFZPorTipoBodega").jqGrid('navButtonAdd', '#pagtblAltasFZPorTipoBodega', {
        caption: "Exportar",
        title: "Exportar Reporte Altas diarias y proyeccion",
        onClickButton: function () {
            var options = {
                includeLabels: true,
                includeGroupHeader: true,
                includeFooter: true,
                fileName: "altas_dia_proyeccion.xlsx",
                mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                maxlength: 40,
                onBeforeExport: null,
                replaceStr: null
            }
            $("#tblAltasFZPorTipoBodega").jqGrid('exportToExcel', options);
        }
    }
    );

    jQuery("#tblAltasFZPorBodega").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'NUMBODEGA',
            'BODEGA',
            'CIUDADES',
            'ALTAS'
        ],
        colModel: [
            {name: 'NUMBODEGA', index: 'NUMBODEGA', width: 220, sortable: true, frozen: true, hidden: true},
            {name: 'BODEGA', index: 'BODEGA', width: 220, sortable: true, frozen: true},
            {name: 'CIUDADES', index: 'CIUDADES', width: 70, sortable: true, frozen: true, align: 'center'},
            {name: 'ALTAS', index: 'ALTAS', width: 60, sortable: true, frozen: true, align: 'center'},
        ],
//        pager: '#pagGrid',
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 150,
        width: 410,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Altas por Bodega",
        hidegrid: false,
        pager: '#pagtblAltasFZPorBodega',
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el ï¿½ndice del identificador ï¿½nico de la entidad
        }
        , beforeRequest: function () { }
        , loadError: function (xhr, st, err) { }
        , onSelectRow: function (idFilaSeleccionada) {
            var fila = jQuery("#tblAltasFZPorBodega").jqGrid('getRowData', idFilaSeleccionada);
            mostrarDetallesXBodega(fila.BODEGA, fila.NUMBODEGA);
        }
        , footerrow: true,
        gridComplete: function () {
            var $grid = $('#tblAltasFZPorBodega');
            var sumaAltas = $grid.jqGrid('getCol', 'ALTAS', false, 'sum');
            $grid.jqGrid('footerData', 'set', {'BODEGA': 'TOTAL :'});
            $grid.jqGrid('footerData', 'set', {'ALTAS': sumaAltas});
        }
    }
    );
    jQuery("#tblAltasFZPorBodega").jqGrid('navGrid', '#pagtblAltasFZPorBodega',
            {add: false, edit: false, del: false, search: true, refresh: false, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    jQuery("#tblAltasFZPorBodega").jqGrid('navButtonAdd', '#pagtblAltasFZPorBodega', {
        caption: "Exportar",
        title: "Exportar Reporte Altas diarias y proyeccion",
        onClickButton: function () {
            var options = {
                includeLabels: true,
                includeGroupHeader: true,
                includeFooter: true,
                fileName: "altas_dia_proyeccion.xlsx",
                mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                maxlength: 40,
                onBeforeExport: null,
                replaceStr: null
            }
            $("#tblAltasFZPorBodega").jqGrid('exportToExcel', options);
        }
    }
    );

    jQuery("#tblGridPeriodosMensuales").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'ANIO'
                    , 'MES'
                    , 'INICIO'
                    , 'FIN'
        ],
        colModel: [
            {name: 'ANIO', index: 'ANIO', width: 50, sortable: false, frozen: true},
            {name: 'MES', index: 'MES', width: 120, sortable: false, frozen: true, align: 'center'},
            {name: 'INICIO', index: 'INICIO', width: 80, sortable: false, frozen: true, align: 'center'},
            {name: 'FIN', index: 'FIN', width: 80, sortable: false, frozen: true, align: 'center'},
        ],
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 150,
        width: 350,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Periodos",
        hidegrid: false,
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el ï¿½ndice del identificador ï¿½nico de la entidad
        }
        , beforeRequest: function () { }
        , loadError: function (xhr, st, err) { }
        , onSelectRow: function (idFilaSeleccionada) {
            var fila = jQuery("#tblGridPeriodosMensuales").jqGrid('getRowData', idFilaSeleccionada);
            $("#gridPivotGestionMes").html("<table id=\"tblGestionMes\" class=\"table table-condensed\"></table><div id=\"pagtblGestionMes\"> </div>");

            var c = document.getElementById("RptResumenDiarioHistorialForm_tipoFechaJornadaPeriodo");
            var strTipoFecha = c.value;

            var e = document.getElementById("RptResumenDiarioHistorialForm_horaInicioJornadaPeriodo");
            var strHoraInicio = e.value;

            var d = document.getElementById("RptResumenDiarioHistorialForm_horaFinJornadaPeriodo");
            var strHoraFin = d.value;

            var f = document.getElementById("RptResumenDiarioHistorialForm_tipoUsuarioPeriodo");
            var strTipoUsuario = f.value;

            if (strTipoUsuario != 1)//opcion 1 es cuando selecciona un ejecutivo del cuadro de ejecutivos
                mostrarTiemposGestionXPeriodo(fila.INICIO, fila.FIN, fila.ANIO, fila.MES, strHoraInicio, strHoraFin, strTipoUsuario, strTipoFecha);
        }
    }
    );

    jQuery("#tblEjecutivosPeriodo").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'VerDatosArchivo',
        colNames: [
            'ID',
            'TIPO',
            'CODIGO',
            'NOMBRE',
        ],
        colModel: [
//            , exportcol: true, hidden: true //opciones para que sea exportable y escondido
            {name: 'IDEJECUTIVO', index: 'IDEJECUTIVO', sortable: false, width: 80, align: "center", hidden: true},
            {name: 'TIPO', index: 'TIPO', sortable: true, width: 170, },
            {name: 'CODIGO', index: 'CODIGO', sortable: true, width: 80, align: "center", },
            {name: 'NOMBRE', index: 'NOMBRE', sortable: true, width: 270, },
        ],
        pager: '#pagtEjecutivosPeriodo',
        rowNum: 200, //NroFilas,
        rowList: ElementosPagina,
        caption: 'Seleccione el ejecutivo',
        hidegrid: false,
        sortorder: 'ASC',
        viewrecords: true,
        height: 150,
        width: 550,
        gridview: true,
        shrinkToFit: false,
        grouping: true,
        groupingView: {
            groupField: ['TIPO'],
            groupCollapse: true,
            groupColumnShow: [false],
        },
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el ï¿½ndice del identificador ï¿½nico de la entidad
        },
        beforeRequest: function () {},
        loadError: function (xhr, st, err) {},
        onSelectRow: function (idFilaSeleccionada) {
            var fila = jQuery("#tblEjecutivosPeriodo").jqGrid('getRowData', idFilaSeleccionada);
//            alert(fila.CODIGO)
//            alert(fila.CODIGO.concat(' Seleccionado'));
            setearEjecutivoSeleccionadoJornada(fila.CODIGO);

//            mostrarTiemposGestionXPeriodo(fila.INICIO, fila.FIN, fila.ANIO, fila.MES, strHoraInicio, strHoraFin, strTipoUsuario, strTipoFecha);
        }
    });
    jQuery("#tblEjecutivosPeriodo").jqGrid('navGrid', '#pagtEjecutivosPeriodo',
            {add: false, edit: false, del: false, search: false, refresh: false, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
}

function GenerarDocumentoReporte(accion) {
    window.open('/sisven_dev/RptResumenDiarioHistorial/' + accion);
}

function EstadoEnviarMail() {
//    window.open('/sisven_dev/RptResumenDiarioHistorial/' + accion);
    $.ajax({
        method: 'POST',
        url: 'RptResumenDiarioHistorial/EstadoEnviarMailAltasFueraZona',
        data: {},
        dataType: 'json',
        type: 'post',
        beforeSend: function () {
            blockUIOpen();
        },
        success: function (data) {
            blockUIClose();
            var datosResult = data.Result;
            alert(datosResult)
        },
        error: function (xhr, st, err) {
            blockUIClose();
            alert(err);
        }
    });
}

function EnviarMail() {
//    window.open('/sisven_dev/RptResumenDiarioHistorial/' + accion);
    $.ajax({
        method: 'POST',
        url: 'RptResumenDiarioHistorial/EnviarMailAltasFueraZona',
        data: {},
        dataType: 'json',
        type: 'post',
        beforeSend: function ()
        {
            blockUIOpen();
        },
        success: function (data) {

            blockUIClose();
            var datosResult = data.Result;
            alert(datosResult)
        },
        error: function (xhr, st, err) {
            blockUIClose();
            alert(err);
        }
    });
}
function setearEjecutivoSeleccionadoJornada(codigoUsuarioSeleccionado) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        cache: false,
        traditional: true,
        url: 'RptResumenDiarioHistorial/SetearEjecutivoSeleccionadoJornada',
        data: {
            codigoUsuarioSeleccionado: codigoUsuarioSeleccionado
        },
        beforeSend: function ()
        {
        },
        success: function (data)
        {
        },
        error: function (xhr, st, err)
        {
            blockUIClose();
            alert(err);
        }
    });
}

function cargarPeriodosPorAnio(anio, destino) {
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
                $("#" + destino + "").html(jsonResponse);
            }
        },
        error: function (xhr, st, err) {
        }
    });
}

function GeneralPivotCiudad(datosResult) {
    $("#gridPivotAltasCiudad").html("<table id=\"tblAltasCiudad\" class=\"table table-condensed\"></table><div id=\"pagtblAltasCiudad\"> </div>");
    jQuery("#tblAltasCiudad").jqGrid('jqPivot', datosResult['altasPorPeriodo'],
            {
                xDimension:
                        [
                            {
                                dataName: 'TIPO_CLIENTE',
                            },
                            {
                                dataName: 'CIUDAD',
                            },
                        ],
                yDimension:
                        [
                            {dataName: 'FECHA_VARCHAR'},
                        ],
                aggregates:
                        [
                            {
                                member: 'MIN',
                                aggregator: 'count',
                                width: 180,
                                label: 'Conteo',
                                formatter: 'integer',
                                formatoptions: {
                                    thousandsSeparator: "",
                                },

                                align: 'right',
                                summaryType: 'count'
                            }
                        ],
                groupSummaryPos: 'footer',
                rowTotals: true,
                colTotals: true,
                frozenStaticCols: true,
            },
            {
                rowNum: 100,
                rowList: ["100000:Todo", "10:10 Filas", "20:20 Filas", "30:30 Filas"],
                width: 600,
                shrinkToFit: false,
                height: 200,
                groupingView: {
                    groupSummary: [false],
                    groupCollapse: true,
//                    groupOrder :['asc']
                },
                pager: "#pagtblAltasCiudad",
                hidegrid: false,
                caption: "Cantidad Altas en Periodo por Tipo Bodega",
            }

    );
    $("#tblAltasCiudad").jqGrid('navGrid', '#pagtblAltasCiudad',
            {add: false, edit: false, del: false, search: true},
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}

    );
    jQuery("#tblAltasCiudad").jqGrid('navButtonAdd', '#pagtblAltasCiudad',
            {
                caption: "Exportar",
                title: "Exportar Reporte",
                onClickButton: function () {
                    var options = {
                        includeLabels: true,
                        includeGroupHeader: true,
                        includeFooter: true,
                        fileName: "altas_por_tipo_bodega.xlsx",
                        mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                        maxlength: 40,
                        onBeforeExport: null,
                        replaceStr: null
                    }
                    $("#tblAltasCiudad").jqGrid('exportToExcel', options);
                }
            }
    );

}

function GeneralPivotCiudadEjecutivo(datosResult) {
    $("#gridPivotAltasCiudadEjecutivo").html("<table id=\"tblAltasCiudadEjecutivo\" class=\"table table-condensed\"></table><div id=\"pagtblAltasCiudadEjecutivo\"></div>");
    jQuery("#tblAltasCiudadEjecutivo").jqGrid('jqPivot', datosResult['altasFueraZona'],
            {
                xDimension:
                        [
                            {
                                dataName: 'TIPO_CLIENTE',
                            },
                            {
                                dataName: 'VENDEDOR',
                            },
                            {
                                dataName: 'CIUDAD',
                            },
                            {
                                dataName: 'CODIGO_CLIENTE',
                            },
                        ],
                yDimension:
                        [
                            {dataName: 'MES_VENTA'},
                        ],
                aggregates:
                        [
                            {
                                member: 'MIN',
                                aggregator: 'count',
                                width: 180,
                                label: 'Conteo',
                                formatter: 'integer',
                                formatoptions: {
                                    thousandsSeparator: "",
                                },

                                align: 'right',
                                summaryType: 'count'
                            }
                        ],
//                groupSummaryPos: 'footer',
                rowTotals: true,
                colTotals: true,
//                frozenStaticCols: true,
            },
            {
                rowNum: 10000,
                rowList: ["100000:Todo", "10:10 Filas", "20:20 Filas", "30:30 Filas"],
                width: 1000,
                shrinkToFit: false,
                height: 200,
                groupingView: {
                    groupSummary: [false],
                    groupCollapse: true,
//                    groupOrder :['asc']
                },
                pager: "#pagtblAltasCiudadEjecutivo",
                hidegrid: false,
                caption: "Cantidad altas fuera zona",
            }

    );
    $("#tblAltasCiudadEjecutivo").jqGrid('navGrid', '#pagtblAltasCiudadEjecutivo', {add: false, edit: false, del: false, search: true});
    jQuery("#tblAltasCiudadEjecutivo").jqGrid('navButtonAdd', '#pagtblAltasCiudadEjecutivo',
            {
                caption: "Exportar",
                title: "Exportar Reporte",
                onClickButton: function () {
                    var options = {
                        includeLabels: true,
                        includeGroupHeader: true,
                        includeFooter: true,
                        fileName: "altas_fuera_provincia_por_tipo_bodega.xlsx",
                        mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                        maxlength: 40,
                        onBeforeExport: null,
                        replaceStr: null
                    }
                    $("#tblAltasCiudadEjecutivo").jqGrid('exportToExcel', options);
                }
            }
    );
}

function GenerarPivotCiudadClientexBodega(datosResult) {
    jQuery("#tblDetalleAltasFZPorBodega").
            jqGrid('jqPivot', datosResult['altasFueraZona'],
                    {
                        xDimension:
                                [
                                    {
                                        dataName: 'CIUDAD',
                                    },
                                    {
                                        dataName: 'CODIGO_CLIENTE',
                                    },
                                ],
                        yDimension:
                                [
                                    {dataName: 'MES_VENTA'},
                                ],
                        aggregates:
                                [
                                    {
                                        member: 'MIN',
                                        aggregator: 'count',
                                        width: 180,
                                        label: 'Conteo',
                                        formatter: 'integer',
                                        formatoptions: {
                                            thousandsSeparator: "",
                                        },

                                        align: 'right',
                                        summaryType: 'count'
                                    }
                                ],
//                groupSummaryPos: 'footer',
                        rowTotals: true,
                        colTotals: true,
//                frozenStaticCols: true,
                    },
                    {
                        rowNum: 10000,
                        rowList: ["100000:Todo", "10:10 Filas", "20:20 Filas", "30:30 Filas"],
                        width: 1000,
                        shrinkToFit: false,
                        height: 200,
                        groupingView: {
                            groupSummary: [false],
                            groupCollapse: true,
//                    groupOrder :['asc']
                        },
                        pager: "#pagtblDetalleAltasFZPorBodega",
                        hidegrid: false,
                        caption: "Detalle altas fuera zona",
                    }

            );
    $("#tblDetalleAltasFZPorBodega").jqGrid('navGrid', '#pagtblDetalleAltasFZPorBodega', {add: false, edit: false, del: false, search: true});
    jQuery("#tblDetalleAltasFZPorBodega").jqGrid('navButtonAdd', '#pagtblDetalleAltasFZPorBodega',
            {
                caption: "Exportar",
                title: "Exportar Reporte",
                onClickButton: function () {
                    var options = {
                        includeLabels: true,
                        includeGroupHeader: true,
                        includeFooter: true,
                        fileName: "altas_fuera_provincia_por_tipo_bodega.xlsx",
                        mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                        maxlength: 40,
                        onBeforeExport: null,
                        replaceStr: null
                    }
                    $("#tblDetalleAltasFZPorBodega").jqGrid('exportToExcel', options);
                }
            }
    );
}

function mostrarPeriodos() {
    $.ajax(
            {
                method: "POST",
                url: "RptResumenDiarioHistorial/BuscaPeriodos",
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
                        $("#tblAltasFZPorTipoBodega").jqGrid("clearGridData", true).trigger("reloadGrid");
                        $("#tblAltasFZPorBodega").jqGrid("clearGridData", true).trigger("reloadGrid");
                        $("#gridPivotDetalleAltasFZPorBodega").html("<table id=\"tblDetalleAltasFZPorBodega\" class=\"table table-condensed\"></table><div id=\"pagtblDetalleAltasFZPorBodega\"> </div>");

                        $("#tblPeriodos").setGridParam({datatype: 'jsonstring', datastr: datosResult}).trigger('reloadGrid');

                        $("#tblGridPeriodosMensuales").setGridParam({datatype: 'jsonstring', datastr: datosResult}).trigger('reloadGrid');
                        $("#gridPivotGestionMes").html("<table id=\"tblGestionMes\" class=\"table table-condensed\"></table><div id=\"pagtblGestionMes\"> </div>");


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

function mostrarDetallesXPeriodo(inicio, fin, anio, mes) {
    $.ajax(
            {
                method: "POST",
                url: "RptResumenDiarioHistorial/MostrarDetalleTipoBodegaXPeriodo",
                data: {
                    inicioPeriodoFZ: inicio,
                    finPeriodoFZ: fin,
                    anioPeriodoFZ: anio,
                    mesPeriodoFZ: mes,
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
                        $("#tblAltasFZPorTipoBodega").setGridParam({datatype: 'jsonstring', datastr: datosResult['detallePeriodo']}).trigger('reloadGrid');
                        $("#gridPivotDetalleAltasFZPorBodega").html("<table id=\"tblDetalleAltasFZPorBodega\" class=\"table table-condensed\"></table><div id=\"pagtblDetalleAltasFZPorBodega\"> </div>");
//                        document.getElementById("btnEstadoEnviarMail").disabled = true;

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

function mostrarDetallesTipoBodega(tipoBodega) {
    $.ajax(
            {
                method: "POST",
                url: "RptResumenDiarioHistorial/MostrarDetalleTipoBodega",
                data: {
                    tipoBodega: tipoBodega,
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
                        $("#tblAltasFZPorBodega").setGridParam({datatype: 'jsonstring', datastr: datosResult['detallePeriodoTipoBodega']}).trigger('reloadGrid');
                        $("#gridPivotDetalleAltasFZPorBodega").html("<table id=\"tblDetalleAltasFZPorBodega\" class=\"table table-condensed\"></table><div id=\"pagtblDetalleAltasFZPorBodega\"> </div>");
//                        document.getElementById("btnEstadoEnviarMail").disabled = true;


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

function mostrarDetallesXBodega(bodega, numbodega) {
    $.ajax(
            {
                method: "POST",
                url: "RptResumenDiarioHistorial/MostrarDetalleXBodega",
                data: {
                    bodegaSeleccionada: bodega,
                    numBodegaSeleccionada: numbodega,
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
                        $("#gridPivotDetalleAltasFZPorBodega").html("<table id=\"tblDetalleAltasFZPorBodega\" class=\"table table-condensed\"></table><div id=\"pagtblDetalleAltasFZPorBodega\"> </div>");
                        if (datosResult['activarEnviarMail'])
//                            document.getElementById("btnEstadoEnviarMail").disabled = false;

                            jQuery("#tblDetalleAltasFZPorBodega").jqGrid('jqPivot', datosResult['detallePorBodega'],
                                    {
                                        xDimension:
                                                [
                                                    {
                                                        dataName: 'CIUDAD',
                                                        width: 100
                                                    },
                                                    {
                                                        dataName: 'CLIENTE',
                                                        width: 250
                                                    },
                                                ],
                                        yDimension:
                                                [
                                                    {dataName: 'MES_VENTA'},
                                                ],
                                        aggregates:
                                                [
                                                    {
                                                        member: 'MIN',
                                                        aggregator: 'count',
                                                        width: 180,
                                                        label: 'Conteo',
                                                        formatter: 'integer',
                                                        formatoptions: {
                                                            thousandsSeparator: "",
                                                        },

                                                        align: 'right',
                                                        summaryType: 'count'
                                                    }
                                                ],
                                        groupSummaryPos: 'footer',
                                        rowTotals: true,
                                        colTotals: true,
                                        frozenStaticCols: true,
                                    },
                                    {
                                        rowNum: 10000,
                                        rowList: ["100000:Todo", "10:10 Filas", "20:20 Filas", "30:30 Filas"],
                                        autowidth: true,
                                        shrinkToFit: false,
                                        height: 200,
                                        groupingView: {
                                            groupSummary: [false],
                                            groupCollapse: false,
//                    groupOrder :['asc']
                                        },
                                        pager: "#pagtblDetalleAltasFZPorBodega",
                                        hidegrid: false,
                                        caption: "Altas fuera zona (CIUDAD-CLIENTE-MES_VENTA) bodega " + bodega,
                                    }

                            );
                        $("#tblDetalleAltasFZPorBodega").jqGrid('navGrid', '#pagtblDetalleAltasFZPorBodega', {add: false, edit: false, del: false, search: true});
                        jQuery("#tblDetalleAltasFZPorBodega").jqGrid('navButtonAdd', '#pagtblDetalleAltasFZPorBodega',
                                {
                                    caption: "Exportar",
                                    title: "Exportar Reporte",
                                    onClickButton: function () {
                                        var options = {
                                            includeLabels: true,
                                            includeGroupHeader: true,
                                            includeFooter: true,
                                            fileName: "altas_fuera_provincia_por_bodega.xlsx",
                                            mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
//                                            maxlength: 40,
                                            onBeforeExport: null,
                                            replaceStr: null
                                        }
                                        $("#tblDetalleAltasFZPorBodega").jqGrid('exportToExcel', options);
                                    }
                                }
                        );

                        jQuery("#tblDetalleAltasFZPorBodega").jqGrid('navButtonAdd', '#pagtblDetalleAltasFZPorBodega',
                                {
                                    caption: "Enviar Mail",
                                    title: "Envia un detalle al ejecutivo para la gestion",
                                    onClickButton: EnviarMail
                                }
                        );


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

function mostrarTiemposGestionXPeriodo(inicioPeriodo, finPeriodo, anioPeriodo, mesPeriodo, horaInicioPeriodo, horaFinPeriodo, tipoUsuarioPeriodo, tipoFecha) {
    $.ajax(
            {
                method: "POST",
                url: "RptResumenDiarioHistorial/MostrarTiemposGestionXPeriodo",
                data: {
                    inicioPeriodo: inicioPeriodo,
                    finPeriodo: finPeriodo,
                    anioPeriodo: anioPeriodo,
                    mesPeriodo: mesPeriodo,
                    horaInicioPeriodo: horaInicioPeriodo,
                    horaFinPeriodo: horaFinPeriodo,
                    tipoUsuarioPeriodo: tipoUsuarioPeriodo,
                    tipoFecha: tipoFecha,
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
                        $("#gridPivotGestionMes").html("<table id=\"tblGestionMes\" class=\"table table-condensed\"></table><div id=\"pagtblGestionMes\"> </div>");
                        if (datosResult['activarEnviarMail'])
//                            document.getElementById("btnEstadoEnviarMail").disabled = false;
                            alert(datosResult.toSource())
                        jQuery("#tblGestionMes").jqGrid('jqPivot', datosResult,
                                {
                                    xDimension:
                                            [
                                                {
                                                    dataName: 'EJECUTIVO',
                                                    width: 100
                                                },
                                                {
                                                    dataName: 'ACCION',
                                                    width: 250
                                                },
                                            ],
                                    yDimension:
                                            [
                                                {dataName: 'FECHA'},
                                            ],
                                    aggregates:
                                            [
                                                {
                                                    member: 'VALOR_ACCION',
                                                    aggregator: 'sum',
                                                    width: 180,
                                                    label: 'Suma',
                                                    formatter: 'string',
//                                                        formatoptions: {
//                                                            thousandsSeparator: "",
//                                                        },

                                                    align: 'right',
                                                    summaryType: 'sum'
                                                }
                                            ],
                                    groupSummaryPos: 'footer',
                                    rowTotals: true,
                                    colTotals: false,
                                    frozenStaticCols: true,
                                },
                                {
                                    rowNum: 10000,
                                    rowList: ["100000:Todo", "10:10 Filas", "20:20 Filas", "30:30 Filas"],
                                    autowidth: true,
                                    shrinkToFit: false,
                                    height: 200,
                                    groupingView: {
                                        groupSummary: [false],
                                        groupCollapse: false,
//                    groupOrder :['asc']
                                    },
                                    pager: "#pagtblGestionMes",
                                    hidegrid: false,
                                    caption: "Gestion Periodo",
                                }

                        );
                        $("#tblGestionMes").jqGrid('navGrid', '#pagtblGestionMes', {add: false, edit: false, del: false, search: true});
                        jQuery("#tblGestionMes").jqGrid('navButtonAdd', '#pagtblGestionMes',
                                {
                                    caption: "Exportar",
                                    title: "Exportar Reporte",
                                    onClickButton: function () {
                                        var options = {
                                            includeLabels: true,
                                            includeGroupHeader: true,
                                            includeFooter: true,
                                            fileName: "resumen_gestion_usuarios_periodo.xlsx",
                                            mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
//                                            maxlength: 40,
                                            onBeforeExport: null,
                                            replaceStr: null
                                        }
                                        $("#tblGestionMes").jqGrid('exportToExcel', options);
                                    }
                                }
                        );

//                        jQuery("#tblDetalleAltasFZPorBodega").jqGrid('navButtonAdd', '#pagtblDetalleAltasFZPorBodega',
//                                {
//                                    caption: "Enviar Mail",
//                                    title: "Envia un detalle al ejecutivo para la gestion",
//                                    onClickButton: EnviarMail
//                                }
//                        );


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

function mostrarTiemposGestionXPeriodoXEjecutivo(inicioPeriodo, finPeriodo, anioPeriodo, mesPeriodo, horaInicioPeriodo, horaFinPeriodo, tipoUsuarioPeriodo, ejecutivo, tipoFecha) {
    $("#gridPivotGestionMes").html("<table id=\"tblGestionMes\" class=\"table table-condensed\"></table><div id=\"pagtblGestionMes\"> </div>");
    $.ajax(
            {
                method: "POST",
                url: "RptResumenDiarioHistorial/MostrarTiemposGestionXPeriodoXEjecutivo",
                data: {
                    inicioPeriodo: inicioPeriodo,
                    finPeriodo: finPeriodo,
                    anioPeriodo: anioPeriodo,
                    mesPeriodo: mesPeriodo,
                    horaInicioPeriodo: horaInicioPeriodo,
                    horaFinPeriodo: horaFinPeriodo,
                    tipoUsuarioPeriodo: tipoUsuarioPeriodo,
                    ejecutivoSeleccionadoPeriodo: ejecutivo,
                    tipoFecha: tipoFecha,
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
                        $("#gridPivotGestionMes").html("<table id=\"tblGestionMes\" class=\"table table-condensed\"></table><div id=\"pagtblGestionMes\"> </div>");
                        if (datosResult['activarEnviarMail'])
//                            document.getElementById("btnEstadoEnviarMail").disabled = false;
                            alert(datosResult.toSource())
                        jQuery("#tblGestionMes").jqGrid('jqPivot', datosResult,
                                {
                                    xDimension:
                                            [
                                                {
                                                    dataName: 'EJECUTIVO',
                                                    width: 100
                                                },
                                                {
                                                    dataName: 'ACCION',
                                                    width: 250
                                                },
                                            ],
                                    yDimension:
                                            [
                                                {dataName: 'FECHA'},
                                            ],
                                    aggregates:
                                            [
                                                {
                                                    member: 'VALOR_ACCION',
                                                    aggregator: 'sum',
                                                    width: 180,
                                                    label: 'Suma',
                                                    formatter: 'integer',
//                                                        formatoptions: {
//                                                            thousandsSeparator: "",
//                                                        },

                                                    align: 'right',
                                                    summaryType: 'sum'
                                                }
                                            ],
                                    groupSummaryPos: 'footer',
                                    rowTotals: true,
                                    colTotals: false,
                                    frozenStaticCols: true,
                                },
                                {
                                    rowNum: 10000,
                                    rowList: ["100000:Todo", "10:10 Filas", "20:20 Filas", "30:30 Filas"],
                                    autowidth: true,
                                    shrinkToFit: false,
                                    height: 200,
                                    groupingView: {
                                        groupSummary: [false],
                                        groupCollapse: false,
//                    groupOrder :['asc']
                                    },
                                    pager: "#pagtblGestionMes",
                                    hidegrid: false,
                                    caption: "Gestion Periodo",
                                }

                        );
                        $("#tblGestionMes").jqGrid('navGrid', '#pagtblGestionMes', {add: false, edit: false, del: false, search: true});
                        jQuery("#tblGestionMes").jqGrid('navButtonAdd', '#pagtblGestionMes',
                                {
                                    caption: "Exportar",
                                    title: "Exportar Reporte",
                                    onClickButton: function () {
                                        var options = {
                                            includeLabels: true,
                                            includeGroupHeader: true,
                                            includeFooter: true,
                                            fileName: "resumen_gestion_usuarios_periodo.xlsx",
                                            mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
//                                            maxlength: 40,
                                            onBeforeExport: null,
                                            replaceStr: null
                                        }
                                        $("#tblGestionMes").jqGrid('exportToExcel', options);
                                    }
                                }
                        );

//                        jQuery("#tblDetalleAltasFZPorBodega").jqGrid('navButtonAdd', '#pagtblDetalleAltasFZPorBodega',
//                                {
//                                    caption: "Enviar Mail",
//                                    title: "Envia un detalle al ejecutivo para la gestion",
//                                    onClickButton: EnviarMail
//                                }
//                        );


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

function cargarEjecutivos() {
    $.ajax(
            {
                method: "POST",
                url: "RptResumenDiarioHistorial/CargarEjecutivos",
                data: {
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
                        $("#tblEjecutivosPeriodo").setGridParam({datatype: 'jsonstring', datastr: datosResult}).trigger('reloadGrid');

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