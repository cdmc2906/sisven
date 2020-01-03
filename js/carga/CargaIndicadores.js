$(document).ready(function () {
//    ConfigDatePicker('.txtFecha');

//    if ($("#CargaIndicadorForm_fechaIngreso").val() == "") {
//        $(".txtFecha").datepicker("setDate", new Date());
//    }
    $("#btnLimpiar").click(function () {
        $("#CargaIndicadorForm_rutaArchivo").val('');
        $("#tblGrid").jqGrid("clearGridData", true).trigger("reloadGrid");

//        var maxDate = new Date();
//        $('.txtFechaConsumo').datepicker('setStartDate', null);
//        $('.txtFechaConsumo').datepicker('setEndDate', maxDate);
//
//        var fechaHoy = new Date();
//        $(".txtFechaConsumo").datepicker("setDate", new Date(fechaHoy.getFullYear(), fechaHoy.getMonth(), 1));

    });
    ConfigurarGrid();
//    ConfigurarGridResumen();
});

function ConfigurarGrid() {
    jQuery("#tblGrid").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'VerDatosArchivo',
        colNames: [
            'FECHA'
            , 'SUCURSAL'
            , 'NUM_BOD'
            , 'BODEGA'
            , 'NUM_SERIE'
            , 'NUM_FACT'
            , 'CODCLI'
            , 'TIPOCLI'
            , 'NOMCLI'
            , 'RUC'
            , 'DIRECCION'
            , 'CIUDAD'
            , 'TELEFONO'
            , 'COD_PROD'
            , 'DESCRIP'
            , 'CODGRUP'
            , 'GRUPO'
            , 'CANTIDAD'
            , 'DETALLE'
            , 'IMEI'
            , 'MIN'
            , 'ICC'
            , 'COSTO'
            , 'PRECIO1'
            , 'PRECIO2'
            , 'PRECIO3'
            , 'PRECIO4'
            , 'PRECIO5'
            , 'PRECIO'
            , 'PORCENDES'
            , 'DESCUENTO'
            , 'SUBTOTAL'
            , 'IVA'
            , 'TOTAL'
            , 'E_COD'
            , 'VENDEDOR'
            , 'MES'
            , 'SEMANA'
            , 'CEDULA'
            , 'LISTADO_OPERADORA'
            , 'PROVINCIA'
        ],
        colModel: [
            {name: 'FECHA', index: 'FECHA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'SUCURSAL', index: 'SUCURSAL', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'NUMERO_BODEGA', index: 'NUMERO_BODEGA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'BODEGA', index: 'BODEGA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'NUMERO_SERIE', index: 'NUMERO_SERIE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'NUMERO_FACTURA', index: 'NUMERO_FACTURA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'COD_CLIENTE', index: 'COD_CLIENTE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'TIPO_CLIENTE', index: 'TIPO_CLIENTE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'NOMBRE_CLIENTE', index: 'NOMBRE_CLIENTE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'RUC', index: 'RUC', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'DIRECCION', index: 'DIRECCION', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'CIUDAD', index: 'CIUDAD', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'TELEFONO', index: 'TELEFONO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'CODIGO_PRODUCTO', index: 'CODIGO_PRODUCTO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'DESCRIPCION_PRODUCTO', index: 'DESCRIPCION_PRODUCTO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'CODIGO_GRUPO', index: 'CODIGO_GRUPO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'GRUPO', index: 'GRUPO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'CANTIDAD', index: 'CANTIDAD', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'DETALLE', index: 'DETALLE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'IMEI', index: 'IMEI', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'MIN', index: 'MIN', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'ICC', index: 'ICC', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'COSTO', index: 'COSTO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'PRECIO1', index: 'PRECIO1', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'PRECIO2', index: 'PRECIO2', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'PRECIO3', index: 'PRECIO3', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'PRECIO4', index: 'PRECIO4', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'PRECIO5', index: 'PRECIO5', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'PRECIO', index: 'PRECIO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'PORCENDES', index: 'PORCENDES', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'DESCUENTO', index: 'DESCUENTO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'SUBTOTAL', index: 'SUBTOTAL', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'IVA', index: 'IVA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'TOTAL', index: 'TOTAL', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'E_CODIGO', index: 'E_CODIGO', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'VENDEDOR', index: 'VENDEDOR', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'MES', index: 'PROVINCIA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'SEMANA', index: 'SEMANA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'CEDULA', index: 'CEDULA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'LISTADO_OPERADORA', index: 'LISTADO_OPERADORA', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'PROVINCIA', index: 'PROVINCIA', width: 200, resizable: false, sortable: false, frozen: false},
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
          caption: "Detalle archivo indicadores",
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

function ConfigurarGridResumen() {
    jQuery("#tblGridResumen").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        colNames: [
            'PLAN',
            'TOTAL MIN',
            'TOTAL PAGO'
        ],
        colModel: [
            {name: 'nombre_plan', index: 'nombre_plan', width: 140, resizable: true, sortable: true, frozen: false},
            {name: 'total_min', index: 'total_min', width: 160, resizable: false, sortable: false, frozen: false},
            {name: 'total_pago', index: 'total_pago', width: 160, resizable: false, sortable: false, frozen: false},
        ],
        pager: '#pagGridResumen',
        rowNum: NroFilas,
        rowList: ElementosPagina,
        sortname: 'nombre_plan',
        sortorder: 'ASC',
        viewrecords: true,
        caption: 'Resumen',
        height: 200,
        autowidth: true,
        gridview: true, //Hace mas r�pido la carga de la grilla 
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
        rownumbers: true,
        beforeRequest: function () {
            blockUIOpen();
        },
        loadComplete: function (jsonResponse) {
            blockUIClose();
            if (!$.isEmptyObject(jsonResponse))
            {
                if (jsonResponse.Status == Error) {
                    setMensaje('error', jsonResponse.Message);
                }
            }
        },
        loadError: function (xhr, st, err) {
            blockUIClose();
//            alert(err);
        }
    });

    jQuery("#tblGridResumen").jqGrid('navGrid', '#pagGridResumen',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
//    jQuery("#tblGrid").jqGrid('setFrozenColumns');//Fija las columnas 
}

