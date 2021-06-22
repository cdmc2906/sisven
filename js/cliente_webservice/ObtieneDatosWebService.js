$(document).ready(function () {
    $("#btnLimpiar").click(function () {
//        $("#CargaHistorialMbForm_rutaArchivo").val('');
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
            'Usuario Codigo',
            'Codigo ruta',
            'Codigo cliente',
            'Codigo direccion cliente',
            'Semana',
            'Dia',
            'Accion',
            'Codigo',
            'Codigo de comentario',
            'Comentario',
            'Monto',
            'Latitud',
            'Longitud',
            'Estado proceso',
            'Romper secuencia',
            'Nombre Usuario',
            'Nombre Cliente',
        ],
        colModel: [
            {name: 'id', index: 'id', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'date', index: 'date', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'user_code', index: 'user_code', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'route_code', index: 'route_code', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'customer_code', index: 'customer_code', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'customer_address_code', index: 'customer_address_code', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'week', index: 'week', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'day', index: 'day', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'action', index: 'action', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'code', index: 'code', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'comment_code', index: 'comment_code', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'comment', index: 'comment', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'amount', index: 'amount', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'lat', index: 'lat', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'lon', index: 'lon', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'process_status', index: 'process_status', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'is_sequence_break', index: 'is_sequence_break', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'user_name', index: 'user_name', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'customer_name', index: 'customer_name', width: 200, resizable: false, sortable: false, frozen: false},
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