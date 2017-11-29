$(document).ready(function () {
//    ConfigDatePicker('.txtFecha');
//
//    if ($("#CargaAsignacionForm_fechaCompra").val() == "") {
//        $(".txtFecha").datepicker("setDate", new Date());
//    }

    ConfigurarGrid();
//    ConfigGridJSON2();
});

function ConfigurarGrid() {
    jQuery("#tblGrid").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'VerDatosArchivo',
        colNames: [
            'NOMBRE PRODUCTO',
            'MIN',
            'ICC',
            'IMEI',
            'FECHA ASIGNACION',
            'VENDEDOR',
        ],
        colModel: [
            {name: 'NOMBRE_PROD', index: 'NOMBRE_PROD', sortable: false, frozen: true},
            {name: 'MIN_PROD', index: 'MIN_PROD', width: 75, sortable: false, frozen: true, align: "center"},
            {name: 'ICC_PROD', index: 'ICC_PROD', width: 160, frozen: false, sortable: false, resizable: false},
            {name: 'IMEI_PROD', index: 'IMEI_PROD', width: 330, sortable: false, frozen: false},
            {name: 'NUMSERIE_PROD', index: 'NUMSERIE_PROD', width: 90, resizable: false, sortable: false, frozen: false},
            {name: 'PRECIO_PROD', index: 'PRECIO_PROD', width: 180, sortable: false, frozen: false},
            {name: 'COSTO_PROD', index: 'COSTO_PROD', width: 210, sortable: false, frozen: false},
//            {name: 'COSTO_PROD', index: 'COSTO_PROD', width: 210, sortable: false, frozen: false},
            {name: 'PORCENTAJEDESCUENTO_PROD', index: 'PORCENTAJEDESCUENTO_PROD', width: 140, resizable: false, align: "left", sortable: false, frozen: false},
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

function ConfigGridJSON2() {
    jQuery("#tblGrid2").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'BankStatementLoaded',
        colNames: [
            'FECHA',
            'CONCEPTO',
            'TIPO',
            'DOCUMENTO',
            'OFICINA',
            'MONTO'
        ],
        colModel: [
            {name: 'bank_date', index: 'bank_date', width: 160, frozen: false, sortable: false, resizable: false},
            {name: 'concept', index: 'concept', width: 350, sortable: false, frozen: false},
            {name: 'transaction_type', index: 'transaction_type', width: 120, resizable: false, sortable: false, frozen: false},
            {name: 'bank_document', index: 'bank_document', width: 180, sortable: false, frozen: false},
            {name: 'branch_office', index: 'branch_office', width: 210, sortable: false, frozen: false},
            {name: 'amount', index: 'amount', width: 140, resizable: false, align: "left", sortable: false, frozen: false},
        ],
        pager: '#paginacionGrid2',
        rowNum: NroFilas,
        rowList: ElementosPagina,
        sortname: 'bank_date',
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 360,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
        rownumbers: true,
        jsonReader: {
            root: "Result",
            repeatitems: false, //cuando el array de la data son object
            id: "id" //representa el �ndice del identificador �nico de la entidad
        },
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

            $(window).bind('resize', function () {
                $('#contentGrid div:not(.ui-jqgrid-titlebar)').width("100%");
            }).trigger('resize');
        },
        gridComplete: function () {
            $('#tabbable div:not(.ui-jqgrid-titlebar)').width("100%");
            $(this).jqGrid('setGridWidth', $(this).parent().width() - 25);
        },
        loadError: function (xhr, st, err) {
            blockUIClose();
            // RedirigirError(xhr.status);
        }
    });

    jQuery("#tblGrid2").jqGrid('navGrid', '#paginacionGrid2',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
    {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    //jQuery("#tblGrid").jqGrid('setFrozenColumns');//Fija las columnas 

}

