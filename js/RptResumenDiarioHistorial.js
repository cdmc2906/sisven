$(document).ready(function () {
    ConfigDatePickersReporte('.txtfechagestion');
    ConfigurarGridResumenIzquierda();
    ConfigurarGridResumenDerecha();
    ConfigurarGrid();
    $("#btnLimpiar").click(function () {
        $("#RevisionHistorialForm_fechagestion").val('');
        $("#RevisionHistorialForm_ejecutivo").val('');
        $("#tblGrid").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblGridResumenIzquierda").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblGridResumenDerecha").jqGrid("clearGridData", true).trigger("reloadGrid");
//        $("#tblGrid").jqGrid("GridDestroy");
//        GridDestroy("#tblGrid");
    });
    $("#btnExcel").click(function () {
        GenerarDocumentoReporte('GenerateExcel');
    });
});
function ConfigurarGridResumenIzquierda() {
    jQuery("#tblResumenIzquierda").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGridResumenIzquierda',
        colNames: ['Parametro', 'Valor'],
        colModel: [
            {name: 'PARAMETRO', index: 'PARAMETRO', width: 200, sortable: false, frozen: true},
            {name: 'VALOR', index: 'VALOR', width: 90, sortable: false, frozen: true, align: 'right'}
        ],
//        pager: '#pagGrid',
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 230,
        width: 310,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
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
}

function ConfigurarGridResumenDerecha() {
    jQuery("#tblResumenDerecha").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGridResumenDereha',
        colNames: ['Visita', 'Cantidad'],
        colModel: [
            {name: 'VISITA', index: 'VISITA', width: 100, sortable: false, frozen: true},
            {name: 'CANTIDAD', index: '', width: 90, sortable: false, frozen: true, align: 'right'}
        ],
        rowNum: 60,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
        height: 200,
        width: 250,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
        footerrow: true,
        gridComplete: function () {
            var $grid = $('#tblResumenDerecha');
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

function ConfigurarGrid() {
//    console.log(datosResult);
    jQuery("#tblGrid").jqGrid({
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
//            'METROS',
            'VALIDACION',
        ],
        colModel: [
//            {name: 'FECHAREVISION', index: 'FECHAREVISION', width: 100, sortable: false, frozen: true},
            {name: 'FECHARUTA', index: 'FECHARUTA', width: 80, frozen: false, sortable: false, resizable: false, align: "center"},
//            {name: 'CODEJECUTIVO', index: 'CODEJECUTIVO', width: 100, sortable: false, frozen: true},
//            {name: 'EJECUTIVO', index: 'EJECUTIVO', width: 100, sortable: false, frozen: true},
            {name: 'CODIGOCLIENTE', index: 'CODIGOCLIENTE', width: 80, sortable: false, frozen: true},
            {name: 'CLIENTE', index: 'CLIENTE', width: 200, sortable: false, frozen: true},
            {name: 'RUTAUSADA', index: 'RUTAUSADA', width: 50, sortable: false, frozen: true, align: "center"},
            {name: 'SECUENCIAVISITA', index: 'SECUENCIAVISITA', width: 30, sortable: false, frozen: true, align: "center"},
            {name: 'RUTACLIENTE', index: 'RUTACLIENTE', width: 50, sortable: false, frozen: true, align: "center"},
            {name: 'SECUENCIARUTA', index: 'SECUENCIARUTA', width: 30, sortable: false, frozen: true, align: "center"},
            {name: 'ESTADOREVISIONR', index: 'ESTADOREVISIONR', width: 100, sortable: false, frozen: true},
            {name: 'ESTADOREVISIONS', index: 'ESTADOREVISIONS', width: 100, sortable: false, frozen: true},
            {name: 'CHIPSCOMPRADOS', index: 'CHIPSCOMPRADOS', width: 40, sortable: false, formatter: "integer", summaryType: 'sum', align: "center"},
//            {name: 'METROS', index: 'METROS', width: 70, sortable: false, formatter: "number", decimalSeparator: ".", thousandsSeparator: "", decimalPlaces: 2, defaultValue: '0.00', summaryType: 'sum',align: "right"},
            {name: 'VALIDACION', index: 'VALIDACION', width: 75, sortable: false, align: "left"},
        ],
        pager: '#pagGrid',
        rowNum: 6000,
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
//        rownumbers: true,
        footerrow: true
        , gridComplete: function () {
            var $grid = $('#tblGrid');
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
    jQuery("#tblGrid").jqGrid('navGrid', '#pagGrid',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
}

function GenerarDocumentoReporte(accion) {
    if (true) {
        window.open('/sisven/RptResumenDiarioHistorial/' + accion);
    } else {
        mostrarVentanaMensaje("Ingrese los parámetros necesarios para generar el reporte", 'Alerta');
    }
}