$(document).ready(function () {
    ConfigDatePickersReporte('.txtfechagestion');
//    ConfigDatePickersReporte('.txtFechaGestionEjecutivo');

    ConfigurarGrids();

    $("#btnExcelResumen").click(function () {
        GenerarDocumentoReporte('GenerateExcelResumen');
    });
    $("#btnExcelDetalle").click(function () {
        GenerarDocumentoReporte('GenerateExcelDetalle');
    });
    $("#btnExcelNoVisitados").click(function () {
        GenerarDocumentoReporte('GenerateExcelNoVisitados');
    });

    $("#btnLimpiar").click(function () {
        $("#RptReemplazoRutaForm _fechagestion").val('');
        $("#RptReemplazoRutaForm_ejecutivo").val('');

        LimpiarGrids();
    });

    $('#RptReemplazoRutaForm_fechagestion').on('change', function (e) {
//        alert('Cambio detectado');
        LimpiarGrids();
    });
    $('#RptReemplazoRutaForm_accionHistorial').on('change', function (e) {
        alert('Cambio detectado');
        LimpiarGrids();
    });
    $('#RptReemplazoRutaForm_precisionVisitas').on('change', function (e) {
        alert('Cambio detectado');
        LimpiarGrids();
    });
    $('#RptReemplazoRutaForm_horaInicioGestion').on('change', function (e) {
        alert('Cambio detectado');
        LimpiarGrids();
    });
    $('#RptReemplazoRutaForm_horaFinGestion').on('change', function (e) {
        alert('Cambio detectado');
        LimpiarGrids();
    });
});

function LimpiarGrids() {
    $("#tblGridSupervisores").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblGridRutas").jqGrid("clearGridData", true).trigger("reloadGrid");

    $("#tblGridDetalle").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblResumenGeneral").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblResumenVisitas").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblResumenVisitasValidasInvalidas").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblPrimeraUltimaVisita").jqGrid("clearGridData", true).trigger("reloadGrid");
    $("#tblResumenVentas").jqGrid("clearGridData", true).trigger("reloadGrid");


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
                    'RUTA',
                    'VISITAS'
                ]
                , colModel:
                        [
                            {name: 'CODIGOSUPERVISOR', index: 'CODIGOEJECUTIVO', width: 40, hidden: true, align: "center"}
                            , {name: 'CODIGOEJECUTIVO', index: 'CODIGOEJECUTIVO', width: 40, align: "center"}
                            , {name: 'RUTACOMPLETA', index: 'RUTACOMPLETA', width: 40, hidden: true, align: "center"}
                            , {name: 'RUTAEJECUTIVO', index: 'RUTAEJECUTIVO', width: 40, align: "center"}
                            , {name: 'RUTA', index: 'RUTA', width: 40, hidden: true, align: "center"}
//                            , {name: 'RUTA', index: 'RUTA', width: 50, align: "center"}
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
                    cargarInformes(fila.CODIGOSUPERVISOR, fila.CODIGOEJECUTIVO, fila.RUTACOMPLETA, fila.RUTA);
                }
                , caption: "Rutas visitadas"});

    //    console.log(datosResult);
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
            'ESTADO SEC',
            'CHIPS',
            'METROS',
            'VALIDACION',
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
            {name: 'ESTADOREVISIONS', index: 'ESTADOREVISIONS', width: 95, sortable: false, frozen: true, align: "center"},
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
        }
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
            {name: 'VISITA', index: 'VISITA', width: 100, sortable: false, frozen: true},
            {name: 'CANTIDAD', index: '', width: 90, sortable: false, frozen: true, align: 'center'}
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
        caption: "Visitas validas / invalidas",
        hidegrid: false,
        gridComplete: function () {
            var $grid = $('#tblResumenVisitasValidasInvalidas');
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
    jQuery("#tblPrimeraUltimaVisita").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: ['Parametro', 'Valor'],
        colModel: [
            {name: 'VISITA', index: 'VISITA', width: 100, sortable: false, frozen: true},
            {name: 'CANTIDAD', index: 'CANTIDAD', width: 90, sortable: false, frozen: true, align: 'center'}
        ],
//        pager: '#pagGrid',
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 46,
        width: 200,
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
}//FIN CONFIGURAR GRIDS
function cargarDetalleRutas(codigoEjecutivoFila) {
    $.ajax(
            {
                method: "POST",
                url: "RptReemplazoRuta/CargarGridDetalleRuta",
                data: {
                    ejecutivo: codigoEjecutivoFila,
                    fechaGestion: $("#RptReemplazoRutaForm_fechagestion").val(),
                    accionHistorial: $("#RptReemplazoRutaForm_accionHistorial").val(),
                    horaInicio: $("#RptReemplazoRutaForm_horaInicioGestion").val(),
                    horaFin: $("#RptReemplazoRutaForm_horaFinGestion").val()
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
                url: "RptReemplazoRuta/CargarInformes",
                data: {
                    supervisor: codigoSupervisor,
                    ejecutivo: codigoEjecutivo,
                    rutaEjecutivo: ruta,
                    diaRuta: diaRuta,
                    fechaGestion: $("#RptReemplazoRutaForm_fechagestion").val(),
                    accionHistorial: $("#RptReemplazoRutaForm_accionHistorial").val(),
                    horaInicio: $("#RptReemplazoRutaForm_horaInicioGestion").val(),
                    horaFin: $("#RptReemplazoRutaForm_horaFinGestion").val(),
                    precision: $("#RptReemplazoRutaForm_precisionVisitas").val()
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
                        $("#tblGridDetalle").setGridParam({datatype: 'jsonstring', datastr: datosResult['detalle']}).trigger('reloadGrid');
                        $("#tblResumenGeneral").setGridParam({datatype: 'jsonstring', datastr: datosResult['resumenGeneral']}).trigger('reloadGrid');
                        $("#tblResumenVisitas").setGridParam({datatype: 'jsonstring', datastr: datosResult['resumenVisitas']}).trigger('reloadGrid');
                        $("#tblResumenVisitasValidasInvalidas").setGridParam({datatype: 'jsonstring', datastr: datosResult['resumenVisitasValidasInvalidas']}).trigger('reloadGrid');
                        $("#tblPrimeraUltimaVisita").setGridParam({datatype: 'jsonstring', datastr: datosResult['resumenPrimeraUltima']}).trigger('reloadGrid');
                        $("#tblResumenVentas").setGridParam({datatype: 'jsonstring', datastr: datosResult['resumenVentas']}).trigger('reloadGrid');
                        mostrarVisitasEnMapa();

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
    window.open('/sisven/RptReemplazoRuta/' + accion);
//    } else {
//        mostrarVentanaMensaje("Ingrese los parámetros necesarios para generar el reporte", 'Alerta');
//    }
}