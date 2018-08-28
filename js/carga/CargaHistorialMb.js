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
            'Id',
            'Fecha',
            'Usuario',
            'Usuario(Nombre)',
            'Ruta',
            'Ruta(Nombre)',
            'Semana',
            'Dia',
            'Cliente',
            'Cliente(Nombre)',
            'Direccion',
            'Accion',
            'Codigo',
            'Codigo de comentario',
            'Comentario',
            'Monto',
            'Latitud',
            'Longitud',
            'Romper secuencia',
        ],
        colModel: [

            {name: 'ID', index: 'ID', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'FECHA', index: 'FECHA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'USUARIO', index: 'USUARIO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'USUARIONOMBRE', index: 'USUARIONOMBRE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'RUTA', index: 'RUTA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'RUTANOMBRE', index: 'RUTANOMBRE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'SEMANA', index: 'SEMANA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'DIA', index: 'DIA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'CLIENTE', index: 'CLIENTE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'CLIENTENOMBRE', index: 'CLIENTENOMBRE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'DIRECCION', index: 'DIRECCION', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'ACCION', index: 'ACCION', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'CODIGO', index: 'CODIGO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'CODIGOCOMENTARIO', index: 'CODIGOCOMENTARIO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'COMENTARIO', index: 'COMENTARIO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'MONTO', index: 'MONTO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'LATITUD', index: 'LATITUD', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'LONGITUD', index: 'LONGITUD', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'ROMPERSECUENCIA', index: 'ROMPERSECUENCIA', width: 200, resizable: false, sortable: false, frozen: false},
        ],
        pager: '#pagGrid',
        rowNum: NroFilas,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
//        caption: 'Detalle historial Mobilvendor',

        viewrecords: true,
//        height: 'auto',
        height: 360,
//        width: 200,
//        caption: "Detalle archivo historial",
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