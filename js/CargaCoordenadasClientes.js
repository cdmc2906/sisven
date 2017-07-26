$(document).ready(function () {
//    ConfigDatePicker('.txtFecha');

//    if ($("#CargaIndicadorForm_fechaIngreso").val() == "") {
//        $(".txtFecha").datepicker("setDate", new Date());
//    }
    $("#btnLimpiar").click(function () {
        $("#CargaHistorialMbForm_rutaArchivo").val('');
        $("#tblGrid").jqGrid("clearGridData", true).trigger("reloadGrid");

//        var maxDate = new Date();
//        $('.txtFechaConsumo').datepicker('setStartDate', null);
//        $('.txtFechaConsumo').datepicker('setEndDate', maxDate);
//
//        var fechaHoy = new Date();
//        $(".txtFechaConsumo").datepicker("setDate", new Date(fechaHoy.getFullYear(), fechaHoy.getMonth(), 1));

    });
    ConfigurarGrid();
    ConfigurarGridResumen();
});

function ConfigurarGrid() {
//    console.log("23");
    jQuery("#tblGrid").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'VerDatosArchivo',
        colNames: [
            'Cliente',
            'Cliente(Nombre)',
            'Latitud',
            'Longitud'
        ],
        colModel: [

            {name: 'CLIENTE', index: 'CLIENTE', width: 200, resizable: false, sortable: false, frozen: false},
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

