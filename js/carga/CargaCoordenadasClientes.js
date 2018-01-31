$(document).ready(function () {
    $("#btnLimpiar").click(function () {
        $("#CargaHistorialMbForm_rutaArchivo").val('');
        $("#tblGrid").jqGrid("clearGridData", true).trigger("reloadGrid");
    });
    ConfigurarGrid();
});

function ConfigurarGrid() {
    jQuery("#tblGrid").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: MetodoListar,
        colNames: [
            'Codigo cliente',
            'Nombre',
            'Latitud',
            'Longitud'
        ],
        colModel: [

            {name: 'CODIGO', index: 'CODIGO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'CLIENTENOMBRE', index: 'CLIENTENOMBRE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'LATITUD', index: 'LATITUD', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'LONGITUD', index: 'LONGITUD', width: 200, resizable: false, sortable: false, frozen: false},
        ],
        pager: '#pagGrid',
        rowNum: NroFilas,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        caption:'Coordenadas clientes',
        
        viewrecords: true,
//        height: 'auto',
        height: 360,
//        width: 200,
        autowidth: true,
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

    jQuery("#tblGrid").jqGrid('navGrid', '#pagGrid',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
}