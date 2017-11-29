$(document).ready(function () {
    ConfigurarGrid();
    $("#btnLimpiar").click(function () {
        $("#CalculoComisionForm_mes").val('');
        $("#CalculoComisionForm_tipoVendedor").val('');
        $("#tblGrid").jqGrid("clearGridData", true).trigger("reloadGrid");
    });

    $("#btnExcel").click(function () {
        GenerarDocumentoReporte('GenerateExcel');
    });
});

function ConfigurarGrid() {
    jQuery("#tblGrid").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'ID_VENDEDOR',
            'VENDEDOR',
            'CHIPS VENDIDOS',
//            'CONSUMO MES',
//            'VENTA MES $',
            'CHIPS CON CONSUMO',
            'CONSUMO MES',
            'PORCENTAJE',
            'COMISION',
        ],
        colModel: [
            {name: 'ID_VENDEDOR', index: 'ID_VENDEDOR', width: 50, sortable: false, frozen: true},
            {name: 'NOMBRE_VENDEDOR', index: 'NOMBRE_VENDEDOR', width: 250, sortable: false, frozen: true},
            {name: 'CHIPS_VENDIDOS', index: 'CHIPS_VENDIDOS', width: 100, frozen: false, sortable: false, resizable: false, align: "center"},
//            {name: 'TOTAL_CONSUMOS', index: 'TOTAL_CONSUMOS', width: 75, sortable: false, frozen: true, align: "center", formatter: 'currency', formatoptions: {prefix: "$", thousandsSeparator: '.', decimalPlaces: 2}},
            {name: 'CHIPS_CON_CONSUMO', index: 'CHIPS_CON_CONSUMO', width: 100, frozen: false, sortable: false, resizable: false, align: "center"},
            {name: 'TOTAL_CONSUMOS', index: 'TOTAL_CONSUMOS', width: 100, frozen: false, sortable: false, resizable: false, align: "center", formatter: 'currency', formatoptions: {prefix: "$", thousandsSeparator: '.', decimalPlaces: 2}},
            {name: 'PORCENTAJE', index: 'PORCENTAJE', width: 100, sortable: false, frozen: false, align: "center"},
            {name: 'COMISION', index: 'COMISION', width: 100, resizable: false, sortable: false, frozen: false, align: "center", formatter: 'currency', formatoptions: {prefix: "$", thousandsSeparator: '.', decimalPlaces: 2}},
        ],
        pager: '#pagGrid',
        rowNum: NroFilas,
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
        rownumbers: true,
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

function ConfigurarGridMayoristas() {
    jQuery("#tblGridMayoristas").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGridMayoristas',
        colNames: [
            'ID_VENDEDOR',
            'VENDEDOR',
            'CHIPS VENDIDOS',
            'CONSUMO MES',
            'PORCENTAJE',
            'COMISION',
        ],
        colModel: [
            {name: 'ID_VENDEDOR', index: 'ID_VENDEDOR', width: 50, sortable: false, frozen: true},
            {name: 'NOMBRE_VENDEDOR', index: 'NOMBRE_VENDEDOR', width: 250, sortable: false, frozen: true},
            {name: 'CHIPS_VENDIDOS', index: 'CHIPS_VENDIDOS', width: 100, frozen: false, sortable: false, resizable: false, align: "center"},
            {name: 'TOTAL_CONSUMOS', index: 'TOTAL_CONSUMOS', width: 100, frozen: false, sortable: false, resizable: false, align: "center", formatter: 'currency', formatoptions: {prefix: "$", thousandsSeparator: '.', decimalPlaces: 2}},
            {name: 'PORCENTAJE', index: 'PORCENTAJE', width: 100, sortable: false, frozen: false, align: "center"},
            {name: 'COMISION', index: 'COMISION', width: 100, resizable: false, sortable: false, frozen: false, align: "center", formatter: 'currency', formatoptions: {prefix: "$", thousandsSeparator: '.', decimalPlaces: 2}},
        ],
        pager: '#pagGrid',
        rowNum: NroFilas,
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
        rownumbers: true,
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

    jQuery("#tblGridMayoristas").jqGrid('navGrid', '#pagGrid',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
    {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
}

function GenerarDocumentoReporte(accion) {
    if (true) {
        window.open('/sisven/calculocomision/' + accion);
    } else {
        mostrarVentanaMensaje("Ingrese los parámetros necesarios para generar el reporte", 'Alerta');
    }
}

