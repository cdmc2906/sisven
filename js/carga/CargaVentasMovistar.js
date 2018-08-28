$(document).ready(function () {
    $("#btnLimpiar").click(function () {
        $("#CargaVentasMovistarForm_rutaArchivo").val('');
        $("#tblGrid").jqGrid("clearGridData", true).trigger("reloadGrid");
    });
    ConfigurarGrid();
});

function ConfigurarGrid() {
    jQuery("#tblGrid").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'VerDatosArchivo',
        colNames: [
            'Fecha',
//            'Transaccion',
//            'Distribuidor',
            'Nombre dist.',
            'Codigo de SCL',
//            'Inventario anterior Fuente',
//            'Inventario actual Fuente',
//            'Tipo SIM',
            'ICC',
            'MIN',
//            'Estado',
            'Id destino',
            'Nombre destino',
//            'Inventario anterior destino',
//            'Inventario actual destino',
//            'Canal',
            'Lote',
//            'Zona'
        ],
        colModel: [
            {name: 'FECHA', index: 'FECHA', width: 70, resizable: false, sortable: false, frozen: false},
//            {name: 'TRANSACCION', index: 'TRANSACCION', width: 200, resizable: false, sortable: false, frozen: false},
//            {name: 'DISTRIBUIDOR', index: 'DISTRIBUIDOR', width: 80, resizable: false, sortable: false, frozen: false},
            {name: 'NOMBREDISTRIBUIDOR', index: 'NOMBREDISTRIBUIDOR', width: 100, resizable: false, sortable: false, frozen: false},
            {name: 'CODIGOSCL', index: 'CODIGOSCL', width: 80, resizable: false, sortable: false, frozen: false},
//            {name: 'INVENTARIOANTERIORFUENTE', index: 'INVENTARIOANTERIORFUENTE', width: 200, resizable: false, sortable: false, frozen: false},
//            {name: 'INVENTARIOACTUALFUENTE', index: 'INVENTARIOACTUALFUENTE', width: 200, resizable: false, sortable: false, frozen: false},
//            {name: 'TIPOSIM', index: 'TIPOSIM', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'ICC', index: 'ICC', width: 150, resizable: false, sortable: false, frozen: false},
            {name: 'MIN', index: 'MIN', width: 80, resizable: false, sortable: false, frozen: false},
//            {name: 'ESTADO', index: 'ESTADO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'IDDESTINO', index: 'IDDESTINO', width: 80, resizable: false, sortable: false, frozen: false},
            {name: 'NOMBREDESTINO', index: 'NOMBREDESTINO', width: 100, resizable: false, sortable: false, frozen: false},
//            {name: 'INVENTARIOANTERIORDESTINO', index: 'INVENTARIOANTERIORDESTINO', width: 200, resizable: false, sortable: false, frozen: false},
//            {name: 'INVENTARIOACTUALDESTINO', index: 'INVENTARIOACTUALDESTINO', width: 200, resizable: false, sortable: false, frozen: false},
//            {name: 'CANAL', index: 'CANAL', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'LOTE', index: 'LOTE', width: 150, resizable: false, sortable: false, frozen: false},
//            {name: 'ZONA', index: 'ZONA', width: 200, resizable: false, sortable: false, frozen: false},
        ],
        pager: '#pagGrid',
        rowNum: NroFilas,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
//        caption: 'Detalle ventas Movistar ',

        viewrecords: true,
//        height: 'auto',
        height: 360,
//        width: 200,
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