$(document).ready(function () {
    $("#btnLimpiar").click(function () {
//        $("#CargaHistorialMbForm_rutaArchivo").val('');
//        $("#tblGrid").jqGrid("clearGridData", true).trigger("reloadGrid");
    });
    ConfigurarGrid();
});

function ConfigurarGrid() {
    jQuery("#tblDireccionClientes").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: MetodoListar,
        colNames: [
            'CODIGO',
            'NOMBRE',
            'PRINCIPAL',
            'SECUNDARIA',
            'NOMENCLATURA',
            'REFERENCIA',
        ],
        colModel: [

            {name: 'DCLI_CLIENTE', index: 'DCLI_CLIENTE', width: 100, resizable: false, sortable: false, frozen: false},
            {name: 'DCLI_CLIENTE_NOMBRE', index: 'DCLI_CLIENTE_NOMBRE', width: 300, resizable: true, sortable: false, frozen: false},
            {name: 'DCLI_CALLE_PRINCIPAL', index: 'DCLI_CALLE_PRINCIPAL', width: 300, resizable: false, sortable: false, frozen: false},
            {name: 'DCLI_CALLE_SECUNDARIA', index: 'DCLI_CALLE_SECUNDARIA', width: 300, resizable: false, sortable: false, frozen: false},
            {name: 'DCLI_NOMENCLATURA', index: 'DCLI_NOMENCLATURA', width: 150, resizable: false, sortable: false, frozen: false},
            {name: 'DCLI_REFERENCIA', index: 'DCLI_REFERENCIA', width: 300, resizable: false, sortable: false, frozen: false},
        ],
        pager: '#pagtblDireccionClientes',
        rowNum: 10,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        caption: 'Direcciones clientes',

        viewrecords: true,
//        height: 'auto',
        height: 230,
        width: 780,
//        autowidth: true,
        hidegrid: false,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
        rownumbers: true,

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
        }
    });

    jQuery("#tblDireccionClientes").jqGrid('navGrid', '#pagtblDireccionClientes',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
}