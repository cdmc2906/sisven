$(document).ready(function () {
    $("#btnLimpiar").click(function () {
        $("#CargaOrdenesMbForm_rutaArchivo").val('');
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
            'Concepto',
            'Codigo',
            'Comentario',
            'Fecha de venta',
            'Fecha de creacion',
            'Fecha de despacho',
            'Tipo',
            'Estatus',
            'Cliente',
            'Cliente (Nombre)',
            'Cliente (Identificación)',
            'Direccion',
            'Lista de precios',
            'Lista de precios (Nombre)',
            'Bodega de origen',
            'Bodega de origen (Nombre)',
            'Termino de pago',
            'Termino de pago (Nombre)',
            'Usuario',
            'Usuario (Nombre)',
            'Oficina',
            'Oficina (Nombre)',
            'Tipo de secuencia',
            'IVA 12 Base',
            'IVA 12 Valor',
            'Iva 0 Base',
            'Iva 0 Valor',
            'IVA 14, Base',
            'IVA 14 Valor',
            'Subtotal',
            'Descuento',
            'Descuento',
            'Impuestos',
            'Otros cargos',
            'Total',
            'Datos',
            'Referencia',
            'Estatus de proceso',
        ],
        colModel: [
            {name: 'ID', index: 'ID', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'CONCEPTO', index: 'CONCEPTO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'CODIGO', index: 'CODIGO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'COMENTARIO', index: 'COMENTARIO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'FECHAVENTA', index: 'FECHAVENTA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'FECHACREACION', index: 'FECHACREACION', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'FECHADESPACHO', index: 'FECHADESPACHO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'TIPO', index: 'TIPO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'ESTATUS', index: 'ESTATUS', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'CLIENTE', index: 'CLIENTE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'CLIENTENOMBRE', index: 'CLIENTENOMBRE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'CLIENTEIDENTIFICACION', index: 'CLIENTEIDENTIFICACION', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'DIRECCION', index: 'DIRECCION', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'LISTAPRECIOS', index: 'LISTAPRECIOS', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'LISTAPRECIOSNOMBRE', index: 'LISTAPRECIOSNOMBRE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'BODEGAORIGEN', index: 'BODEGAORIGEN', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'BODEGAORIGENNOMBRE', index: 'BODEGAORIGENNOMBRE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'TERMINOPAGO', index: 'TERMINOPAGO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'TERMINOPAGONOMBRE', index: 'TERMINOPAGONOMBRE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'USUARIO', index: 'USUARIO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'USUARIONOMBRE', index: 'USUARIONOMBRE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'OFICINA', index: 'OFICINA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'OFICINANOMBRE', index: 'OFICINANOMBRE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'TIPOSECUENCIA', index: 'TIPOSECUENCIA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'IVA12BASE', index: 'IVA12BASE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'IVA12VALOR', index: 'IVA12VALOR', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'IVA0BASE', index: 'IVA0BASE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'IVA0VALOR', index: 'IVA0VALOR', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'IVA14BASE', index: 'IVA14BASE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'IVA14VALOR', index: 'IVA14VALOR', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'SUBTOTAL', index: 'SUBTOTAL', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'DESCUENTOP', index: 'DESCUENTOP', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'DESCUENTO', index: 'DESCUENTO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'IMPUESTOS', index: 'IMPUESTOS', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'OTROSCARGOS', index: 'OTROSCARGOS', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'TOTAL', index: 'TOTAL', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'DATOS', index: 'DATOS', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'REFERENCIA', index: 'REFERENCIA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'ESTATUSPROCESO', index: 'ESTATUSPROCESO', width: 200, resizable: false, sortable: false, frozen: false},
        ],
        pager: '#pagGrid',
        rowNum: NroFilas,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        caption: 'Detalle ordenes Mobilvendor',

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