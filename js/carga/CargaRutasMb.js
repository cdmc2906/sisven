$(document).ready(function () {
    $("#btnLimpiar").click(function () {
        $("#CargaRutasMbForm_rutaArchivo").val('');
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
            'Codigo',
            'Ruta',
            'Cliente',
            'Nombre',
            'Tipo Negocio',
            'Direccion',
            'Direccion (Descripcion)',
            'Referencia',
            'Semana',
            'Dia',
            'Secuencia',
            'Estatus'
        ],
        colModel: [
            {name: 'CODIGO', index: 'CODIGO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'RUTA', index: 'RUTA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'CLIENTE', index: 'CLIENTE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'NOMBRE', index: 'NOMBRE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'TIPODENEGOCIO', index: 'TIPODENEGOCIO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'DIRECCION', index: 'DIRECCION', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'DIRECCIONDESCRIPCION', index: 'DIRECCIONDESCRIPCION', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'REFERENCIA', index: 'REFERENCIA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'SEMANA', index: 'SEMANA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'DIA', index: 'DIA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'SECUENCIA', index: 'SECUENCIA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'ESTATUS', index: 'ESTATUS', width: 200, resizable: false, sortable: false, frozen: false},
        ],
        pager: '#pagGrid',
        rowNum: NroFilas,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        caption: 'Detalle Rutas Mobilvendor',
        viewrecords: true,
//        height: 'auto',
        height: 360,
//        width: 200,
        hidegrid: false,
        autowidth: true,
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