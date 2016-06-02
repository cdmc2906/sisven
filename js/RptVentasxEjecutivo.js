$(document).ready(function () {
    ConfigGridJSON();

    $("#btnLimpiar").click(function () {
        $("#ReporteVentasxVendedorForm_vendedor").val('');
        $("#tblGrid").jqGrid("clearGridData", true).trigger("reloadGrid");
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
        colNames: [
            'MES',
            'CHIPS VENDIDOS',
            'VENDEDOR',
        ],
        colModel: [
            {name: 'MES', index: 'MES', sortable: false, frozen: true},
            {name: 'CHIPS VENDIDOS', index: 'CHIPS VENDIDOS', width: 100, sortable: false, frozen: true},
            {name: 'VENDEDOR', index: 'VENDEDOR', width: 250, frozen: false, sortable: false, resizable: false},
        ],
        pager: '#pagGrid',
        rowNum: NroFilas,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 200,
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

function GenerarDocumentoReporte(accion) {
    if ($("#ReporteVentasxMesForm_mes").val() != "") {
        window.open('/sisven/reporteventasxvendedor/'+accion + '?vendedor=' + $("#ReporteVentasxVendedorForm_vendedor").val());
    }    else {
        mostrarVentanaMensaje("Ingrese los parámetros necesarios para generar el reporte", 'Alerta');
    }
}

