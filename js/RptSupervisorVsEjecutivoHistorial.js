$(document).ready(function () {
    ConfigDatePickersReporte('.txtfechagestion');
//    ConfigDatePickersReporte('.txtFechaGestionEjecutivo');

    ConfigurarGrids();

    $("#btnExcel").click(function () {
        GenerarDocumentoReporte('GenerateExcel');
    });

    $("#btnLimpiar").click(function () {
        $("#RptSupervisorVsEjecutivoHistorialForm _fechagestion").val('');
        $("#RptResumenDiarioHistorialForm_ejecutivo").val('');

//        $("#RptResumenDiarioHistorialForm_horaInicioGestion").val('');
//        $("#RptResumenDiarioHistorialForm_horaFinGestion").val('');
//        
//        $("#RptResumenDiarioHistorialForm_precisionVisitas").val('');
//
//        $("#RptResumenDiarioHistorialForm_comentarioSupervision").val('');
//        $("#RptResumenDiarioHistorialForm_enlaceMapa").val('');


//        $("#d_comentariosSupervision").val('');
//        $("#d_comentarioSupervision").val('');
//        $("#d_enlaceMapa").val('');

        LimpiarGrids();
    });

    $('#RptSupervisorVsEjecutivoHistorialForm_accionHistorial').on('change', function (e) {
//        var optionSelected = $("option:selected", this);
//        var valueSelected = this.value;
        alert('Cambio detectado');
        LimpiarGrids();
    });
    $('#RptSupervisorVsEjecutivoHistorialForm_precisionVisitas').on('change', function (e) {
//        var optionSelected = $("option:selected", this);
//        var valueSelected = this.value;
        alert('Cambio detectado');
        LimpiarGrids();
    });
    $('#RptSupervisorVsEjecutivoHistorialForm_horaInicioGestion').on('change', function (e) {
//        var optionSelected = $("option:selected", this);
//        var valueSelected = this.value;
        alert('Cambio detectado');
        LimpiarGrids();
    });
    $('#RptSupervisorVsEjecutivoHistorialForm_horaFinGestion').on('change', function (e) {
//        var optionSelected = $("option:selected", this);
//        var valueSelected = this.value;
        alert('Cambio detectado');
        LimpiarGrids();
    });
});

function LimpiarGrids() {
    $("#tblGridSupervisores").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblGridRutas").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblGridDetalle").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblVisitasSupervisor").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblCumplimientoSupervisor").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblResumenVisitasValidasInvalidasSupervisor").jqGrid("clearGridData", true).trigger("reloadGrid");

    $("#tblVisitasEjecutivo").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblCumplimientoEjecutivo").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblResumenVisitasValidasInvalidasEjecutivo").jqGrid("clearGridData", true).trigger("reloadGrid");
}
function ConfigurarGrids() {

    jQuery("#tblGridSupervisores").jqGrid(
            {
                loadonce: true
                , height: 100
                , width: 300
                , mtype: 'POST'
                , url: 'VerDatosArchivo'
                , datatype: "json"
                , colNames: ['CODIGO ', 'SUPERVISOR', 'VISITAS']
                , colModel:
                        [
                            {name: 'CODIGOEJECUTIVO', index: 'CODIGOEJECUTIVO', width: 55}
                            , {name: 'SUPERVISOR', index: 'SUPERVISOR', width: 100}
                            , {name: 'VISITAS', index: 'VISITAS', width: 40, align: "center"}
                        ]
                , rowNum: 10
                , rowList: [10, 20, 30]
                , pager: '#pager10'
                , sortname: 'id'
                , viewrecords: true
                , sortorder: "desc"
                , multiselect: false
                , hidegrid: false
                , caption: "Supervisores "
                , footerrow: true
                , gridComplete: function () {
                    var $grid = $('#tblGridSupervisores');
                    var colSum = $grid.jqGrid('getCol', 'VISITAS', false, 'sum');
                    $grid.jqGrid('footerData', 'set', {'SUPERVISOR': 'Total visitas:'});
                    $grid.jqGrid('footerData', 'set', {'VISITAS': colSum});
                }
                , onSelectRow: function (idFilaSeleccionada) {
                    var fila = jQuery("#tblGridSupervisores").jqGrid('getRowData', idFilaSeleccionada);
                    jQuery("#tblGridRutas").jqGrid('setCaption', "Detalle rutas visitadas: " + fila.SUPERVISOR).trigger('reloadGrid');
                    cargarDetalleRutas(fila.CODIGOEJECUTIVO);
                }
            });
    jQuery("#tblGridRutas").jqGrid(
            {
                height: 100
                , width: 300
                , datatype: "json"
                , colNames: [
                    'SUPERVISOR',
                    'EJECUTIVO',
                    'RUTACOMPLETA',
                    'RUTA',
                    'VISITAS'
                ]
                , colModel:
                        [
                            {name: 'CODIGOSUPERVISOR', index: 'CODIGOEJECUTIVO', width: 40, hidden: true, align: "center"}
                            , {name: 'CODIGOEJECUTIVO', index: 'CODIGOEJECUTIVO', width: 40, align: "center"}
                            , {name: 'RUTACOMPLETA', index: 'RUTACOMPLETA', width: 40, hidden: true, align: "center"}
                            , {name: 'RUTA', index: 'RUTA', width: 50, align: "center"}
                            , {name: 'VISITAS', index: 'VISITAS', width: 40, align: "center"}
                        ]
                , rowNum: 1000
                , rowList: [5, 10, 20]
                , pager: '#pager10_d'
                , sortname: 'item'
                , viewrecords: true
                , hidegrid: false
                , sortorder: "asc"
                , footerrow: true
                , gridComplete: function () {
                    var $grid = $('#tblGridRutas');
                    var colSum = $grid.jqGrid('getCol', 'VISITAS', false, 'sum');
                    $grid.jqGrid('footerData', 'set', {'RUTA': 'Visitas supervisor'});
                    $grid.jqGrid('footerData', 'set', {'VISITAS': colSum});

                }
                , onSelectRow: function (idFilaSeleccionada) {
                    var fila = jQuery("#tblGridRutas").jqGrid('getRowData', idFilaSeleccionada);
//                    jQuery("#tblGridDetalle").jqGrid('setCaption', "Detalle rutas visitadas ejecutivo: " + fila.SUPERVISOR).trigger('reloadGrid');
                    cargarInformes(fila.CODIGOSUPERVISOR, fila.CODIGOEJECUTIVO, fila.RUTACOMPLETA, fila.RUTA);
                }
                , caption: "Rutas visitadas"});

    jQuery("#tblGridDetalle").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'FECHA GESTION',
            'CODIGO',
            'CLIENTE',
            'METROS SUV',
            'ESTADO SUV',
            'METROS EJE',
            'ESTADO EJE',
//            'DISTANCIA_SC',
//            'DISTANCIA_EC',
            'DISTANCIA_SE',
            'LATITUD_CLIENTE',
            'LONGITID_CLIENTE',
            'LATITUD_SUPERVISOR',
            'LONGITID_SUPERVISOR',
            'LATITUD_EJECUTIVO',
            'LONGITID_EJECUTIVO'
        ],
        colModel: [
            {name: 'FECHAGESTION', index: 'FECHAGESTION', hidden: true, width: 80, sortable: false, frozen: true},
            {name: 'CODIGOCLIENTE', index: 'CODIGOCLIENTE', width: 80, sortable: false, frozen: true},
            {name: 'CLIENTE', index: 'CLIENTE', width: 230, sortable: false, frozen: true},
            {name: 'METROSS', index: 'METROSS', width: 95, sortable: false, frozen: true, align: "center"},
            {name: 'ESTADOS', index: 'ESTADOS', width: 100, sortable: false, frozen: true, align: "center"},
            {name: 'METROSE', index: 'METROSE', width: 95, sortable: false, frozen: true, align: "center"},
            {name: 'ESTADOE', index: 'ESTADOE', width: 100, sortable: false, frozen: true, align: "center"},
//            {name: 'DISTANCIA_SC', index: 'DISTANCIA_SC', hidden: true, width: 20, sortable: false, frozen: true, align: "center"},
//            {name: 'DISTANCIA_EC', index: 'DISTANCIA_EC', hidden: true, width: 20, sortable: false, frozen: true, align: "center"},
            {name: 'DISTANCIA_SE', index: 'DISTANCIA_SE', hidden: true, width: 20, sortable: false, frozen: true, align: "center"},
            {name: 'LATITUD_CLIENTE', index: 'LATITUD_CLIENTE', hidden: true, width: 20, sortable: false, frozen: true, align: "center"},
            {name: 'LONGITUD_CLIENTE', index: 'LONGITUD_CLIENTE', hidden: true, width: 20, sortable: false, frozen: true, align: "center"},
            {name: 'LATITUD_SUPERVISOR', index: 'LATITUD_SUPERVISOR', hidden: true, width: 20, sortable: false, frozen: true, align: "center"},
            {name: 'LONGITUD_SUPERVISOR', index: 'LONGITUD_SUPERVISOR', hidden: true, width: 20, sortable: false, frozen: true, align: "center"},
            {name: 'LATITUD_EJECUTIVO', index: 'LATITUD_EJECUTIVO', hidden: true, width: 20, sortable: false, frozen: true, align: "center"},
            {name: 'LONGITUD_EJECUTIVO', index: 'LONGITUD_EJECUTIVO', hidden: true, width: 20, sortable: false, frozen: true, align: "center"},
        ],
        pager: '#pagGrid',
        rowNum: 6000,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 360,
        width: 1000,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Detalle revision historial",
        hidegrid: false,
        footerrow: true,
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
    jQuery("#tblGridDetalle").jqGrid('navGrid', '#pagGrid',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );

    jQuery("#tblVisitasSupervisor").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: ['PARAMETRO', 'VALOR'],
        colModel: [
            {name: 'PARAMETRO', index: 'PARAMETRO', width: 150, sortable: false, frozen: true},
            {name: 'VALOR', index: 'VALOR', width: 60, sortable: false, frozen: true, align: 'center'}
        ],
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 120,
        width: 220,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Visitas supervisor",
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
    jQuery("#tblCumplimientoSupervisor").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: ['Parametro', 'Valor'],
        colModel: [
            {name: 'PARAMETRO', index: 'PARAMETRO', width: 150, sortable: false, frozen: true},
            {name: 'VALOR', index: 'VALOR', width: 60, sortable: false, frozen: true, align: 'center'}
        ],
//        pager: '#pagGrid',
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 120,
        width: 220,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Cumplimiento",
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
    jQuery("#tblResumenVisitasValidasInvalidasSupervisor").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: ['Visita', 'Cantidad'],
        colModel: [
            {name: 'VISITA', index: 'VISITA', width: 100, sortable: false, frozen: true},
            {name: 'CANTIDAD', index: 'CANTIDAD', width: 90, sortable: false, frozen: true, align: 'center'}
        ],
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 46,
        width: 200,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        footerrow: true,
        caption: "Validas-invalidas",
        hidegrid: false,
        gridComplete: function () {
            var $grid = $('#tblResumenVisitasValidasInvalidasSupervisor');
            var colSum = $grid.jqGrid('getCol', 'CANTIDAD', false, 'sum');
            $grid.jqGrid('footerData', 'set', {'VISITA': 'Total Visitas'});
            $grid.jqGrid('footerData', 'set', {'CANTIDAD': colSum});

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

    jQuery("#tblVisitasEjecutivo").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: ['PARAMETRO', 'VALOR'],
        colModel: [
            {name: 'PARAMETRO', index: 'PARAMETRO', width: 150, sortable: false, frozen: true},
            {name: 'VALOR', index: 'VALOR', width: 60, sortable: false, frozen: true, align: 'center'}
        ],
//        pager: '#pagGrid',
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 120,
        width: 220,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Visitas Ejecutivo",
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
    jQuery("#tblCumplimientoEjecutivo").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: ['Parametro', 'Valor'],
        colModel: [
            {name: 'PARAMETRO', index: 'PARAMETRO', width: 150, sortable: false, frozen: true},
            {name: 'VALOR', index: 'VALOR', width: 60, sortable: false, frozen: true, align: 'center'}
        ],
//        pager: '#pagGrid',
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 120,
        width: 220,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        caption: "Cumplimiento",
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
    jQuery("#tblResumenVisitasValidasInvalidasEjecutivo").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: ['Visita', 'Cantidad'],
        colModel: [
            {name: 'VISITA', index: 'VISITA', width: 100, sortable: false, frozen: true},
            {name: 'CANTIDAD', index: 'CANTIDAD', width: 90, sortable: false, frozen: true, align: 'center'}
        ],
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 46,
        width: 200,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        footerrow: true,
        caption: "Validas-invalidas",
        hidegrid: false,
        gridComplete: function () {
            var $grid = $('#tblResumenVisitasValidasInvalidasEjecutivo');
            var colSum = $grid.jqGrid('getCol', 'CANTIDAD', false, 'sum');
            $grid.jqGrid('footerData', 'set', {'VISITA': 'Total Visitas'});
            $grid.jqGrid('footerData', 'set', {'CANTIDAD': colSum});

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
}

function cargarDetalleRutas(codigoEjecutivoFila) {
    $.ajax(
            {
                method: "POST",
                url: "RptSupervisorVsEjecutivoHistorial/CargarGridDetalleRuta",
                data: {
                    ejecutivo: codigoEjecutivoFila,
                    fechaGestion: $("#RptSupervisorVsEjecutivoHistorialForm_fechagestion").val(),
                    accionHistorial: $("#RptSupervisorVsEjecutivoHistorialForm_accionHistorial").val(),
                    horaInicio: $("#RptSupervisorVsEjecutivoHistorialForm_horaInicioGestion").val(),
                    horaFin: $("#RptSupervisorVsEjecutivoHistorialForm_horaFinGestion").val()
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
                        $("#tblGridRutas").setGridParam({datatype: 'jsonstring', datastr: datosResult}).trigger('reloadGrid');

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

function cargarInformes(codigoSupervisor, codigoEjecutivo, ruta, diaRuta) {
    $.ajax(
            {
                method: "POST",
                url: "RptSupervisorVsEjecutivoHistorial/CargarInformes",
                data: {
                    supervisor: codigoSupervisor,
                    ejecutivo: codigoEjecutivo,
                    rutaEjecutivo: ruta,
                    diaRuta: diaRuta,
                    fechaGestion: $("#RptSupervisorVsEjecutivoHistorialForm_fechagestion").val(),
                    accionHistorial: $("#RptSupervisorVsEjecutivoHistorialForm_accionHistorial").val(),
                    horaInicio: $("#RptSupervisorVsEjecutivoHistorialForm_horaInicioGestion").val(),
                    horaFin: $("#RptSupervisorVsEjecutivoHistorialForm_horaFinGestion").val(),
                    precision: $("#RptSupervisorVsEjecutivoHistorialForm_precisionVisitas").val()
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
//                        alert(datosResult.toSource());
//                        $("#tblGridDetalle").setGridParam({datatype: 'jsonstring', datastr: datosResult}).trigger('reloadGrid');

                        $("#tblCumplimientoSupervisor").setGridParam({datatype: 'jsonstring', datastr: datosResult['gridCumplimientoSupervisor']}).trigger('reloadGrid');
                        $("#tblVisitasSupervisor").setGridParam({datatype: 'jsonstring', datastr: datosResult['gridVisitasSupervisor']}).trigger('reloadGrid');
                        $("#tblResumenVisitasValidasInvalidasSupervisor").setGridParam({datatype: 'jsonstring', datastr: datosResult['resumenVisitasValidasInvalidasSupervisor']}).trigger('reloadGrid');

                        $("#tblCumplimientoEjecutivo").setGridParam({datatype: 'jsonstring', datastr: datosResult['gridCumplimientoEjecutivo']}).trigger('reloadGrid');
                        $("#tblVisitasEjecutivo").setGridParam({datatype: 'jsonstring', datastr: datosResult['gridVisitasEjecutivo']}).trigger('reloadGrid');
                        $("#tblResumenVisitasValidasInvalidasEjecutivo").setGridParam({datatype: 'jsonstring', datastr: datosResult['resumenVisitasValidasInvalidasEjecutivo']}).trigger('reloadGrid');

                        $("#tblGridDetalle").setGridParam({datatype: 'jsonstring', datastr: datosResult['gridDetalleSupervisorEjecutivo']}).trigger('reloadGrid');

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
//    if (true) {
    window.open('/sisven_2/RptSupervisorVsEjecutivoHistorial/' + accion);
//    } else {
//        mostrarVentanaMensaje("Ingrese los parámetros necesarios para generar el reporte", 'Alerta');
//    }
}