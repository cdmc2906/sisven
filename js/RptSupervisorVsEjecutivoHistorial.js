$(document).ready(function () {
    ConfigDatePickersReporte('.txtfechagestion');

    ConfigurarGrids();
});

$("#btnExcelResumen").click(function () {
    GenerarDocumentoReporte('GenerateExcelResumen');
});

function ConfigurarGrids() {
    jQuery("#tblGridDetalle").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: ['CODIGO', 'CLIENTE', 'METROS SUV', 'ESTADO SUV', 'METROS EJE', 'ESTADO EJE'],
        colModel: [
            {name: 'CODIGOCLIENTE', index: 'CODIGOCLIENTE', width: 80, sortable: false, frozen: true},
            {name: 'CLIENTE', index: 'CLIENTE', width: 215, sortable: false, frozen: true},
            {name: 'METROSS', index: 'SECUENCIARUTA', width: 20, sortable: false, frozen: true, align: "center"},
            {name: 'ESTADOS', index: 'ESTADOREVISIONR', width: 100, sortable: false, frozen: true, align: "center"},
            {name: 'METROSE', index: 'ESTADOREVISIONS', width: 95, sortable: false, frozen: true, align: "center"},
            {name: 'ESTADOE', index: 'CHIPSCOMPRADOS', width: 40, sortable: false, formatter: "integer", summaryType: 'sum', align: "center"},
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

    jQuery("#tblGridSupervisores").jqGrid(
            {
                loadonce: true
                , height: 100
                , width: 320
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
                , caption: "Supervisores "
                , footerrow: true
                , gridComplete: function () {
                    var $grid = $('#tblGridSupervisores');
                    var colSum = $grid.jqGrid('getCol', 'VISITAS', false, 'sum');
                    $grid.jqGrid('footerData', 'set', {'SUPERVISOR': 'Total visitas'});
                    $grid.jqGrid('footerData', 'set', {'VISITAS': colSum});
                }
                , onSelectRow: function (idFilaSeleccionada) {
                    var fila = jQuery("#tblGridMaestro").jqGrid('getRowData', idFilaSeleccionada);
                    jQuery("#tblGridDetalle").jqGrid('setCaption', "Detalle Pedidos Ejecutivo: " + fila.EJECUTIVO).trigger('reloadGrid');
                    cargarDetalle(fila.CODIGOEJECUTIVO);
                }});
    jQuery("#tblGridRutas").jqGrid(
            {
                height: 100
                , width: 320
                , datatype: "json"
                , colNames: [
                    'EJECUTIVO',
                    'RUTA',
                    'VISITAS'
                ]
                , colModel:
                        [
                            {name: 'CODIGOEJECUTIVO',
//                                hidden: true,
                                index: 'CODIGOEJECUTIVO',
                                sortable: false,
                                width: 80,
                                frozen: true,
                                editable: true,
                                align: "center",
                                editoptions: {readonly: true, size: 10}
                            },
                            {name: 'RUTA',
                                index: 'RUTA',
                                sortable: false,
                                frozen: true,
                                editable: true,
                                editoptions: {readonly: true, size: 20}
                            },
                            {name: 'VISITAS'
                                , index: 'VISITAS'
                                , sortable: false
                                , frozen: true
                                , width: 100
                                , editable: true,
                                editoptions: {readonly: true, size: 15}
                            },
                        ]
                , rowNum: 1000
                , rowList: [5, 10, 20]
                , pager: '#pager10_d'
                , sortname: 'item'
                , viewrecords: true
                , sortorder: "asc"
                , footerrow: true
                , gridComplete: function () {
                    var $grid = $('#tblGridDetalle');
                    var colSum = $grid.jqGrid('getCol', 'VISITAS', false, 'sum');
                    $grid.jqGrid('footerData', 'set', {'RUTA': 'Total visitas'});
                    $grid.jqGrid('footerData', 'set', {'VISITAS': colSum});

                }
                , caption: "Rutas visitadas"});
    
    jQuery("#tblVisitasSupervisor").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: ['PARAMETRO', 'VALOR'],
        colModel: [
            {name: 'PARAMETRO', index: 'PARAMETRO', width: 150, sortable: false, frozen: true},
            {name: 'VALOR', index: 'VALOR', width: 90, sortable: false, frozen: true, align: 'center'}
        ],
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 46,
        width: 250,
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
        caption: "Validas-invalidas",
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

    jQuery("#tblVisitasEjecutivo").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: ['PARAMETRO', 'VALOR'],
        colModel: [
            {name: 'PARAMETRO', index: 'PARAMETRO', width: 150, sortable: false, frozen: true},
            {name: 'VALOR', index: 'VALOR', width: 90, sortable: false, frozen: true, align: 'center'}
        ],
//        pager: '#pagGrid',
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 46,
        width: 250,
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
        caption: "Validas-invalidas",
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
}

function GenerarDocumentoReporte(accion) {
    if (true) {
        window.open('/sisven/RptResumenDiarioHistorial/' + accion);
    } else {
        mostrarVentanaMensaje("Ingrese los parámetros necesarios para generar el reporte", 'Alerta');
    }
}