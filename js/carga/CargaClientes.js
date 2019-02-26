$(document).ready(function () {
    $("#btnLimpiar").click(function () {
        $("#CargaHistorialMbForm_rutaArchivo").val('');
        $("#tblGrid").jqGrid("clearGridData", true).trigger("reloadGrid");
    });
    ConfigurarGrid();
});

function ConfigurarGrid() {
    jQuery("#tblClientes").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: MetodoListar,
        colNames: [
            'CODIGO',
            'NOMBRE',
            'CREADO',
            'ESTADO'
        ],
        colModel: [

            {name: 'CLI_CODIGO_CLIENTE', index: 'CLI_CODIGO_CLIENTE', width: 100, resizable: false, sortable: false, frozen: false},
            {name: 'CLI_NOMBRE_CLIENTE', index: 'CLI_NOMBRE_CLIENTE', width: 300, resizable: true, sortable: false, frozen: false},
            {name: 'CLI_CREADO', index: 'CLI_CREADO', width: 150, resizable: false, sortable: false, frozen: false},
            {name: 'CLI_ESTATUS', index: 'CLI_ESTATUS', width: 80, resizable: false, sortable: false, frozen: false},
        ],
        pager: '#pagtblClientes',
        rowNum: 10,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        caption: 'Datos clientes',

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

    jQuery("#tblClientes").jqGrid('navGrid', '#pagtblClientes',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
}