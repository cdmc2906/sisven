$(document).ready(function () {
//    ConfigDatePicker('.txtFecha');
//
//    if ($("#CargaConsumoForm_fechaConsumo").val() == "") {
//        $(".txtFecha").datepicker("setDate", new Date());
//    }

    ConfigurarGrid();
    ConfigurarGridMinesDesconocidos();

    $("#btnExcel").click(function () {
//        alert("hola");
        GenerarDocumentoReporte('GenerateExcel');
    });
});

function ConfigurarGrid() {
    jQuery("#tblGrid").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'VerDatosArchivo',
        colNames: [
            'MES CONSUMO',
            'PLAN',
            'MIN',
            'CONTRATO',
            'CODIGO VENDEDOR',
            'VENDEDOR',
            'PAGO',
            'OBSERVACION'
        ],
        colModel: [
            {name: 'FECHACONSUMO_CONS', index: 'FECHACONSUMO_CONS', width: 90, sortable: false, frozen: false},
            {name: 'PLAN_CONS', index: 'PLAN_CONS', sortable: false, frozen: true},
            {name: 'MIN_CONS', index: 'MIN_CONS', width: 75, sortable: false, frozen: true, align: "center"},
            {name: 'CONTRATO_CONS', index: 'CONTRATO_CONS', width: 160, frozen: false, sortable: false, resizable: false},
            {name: 'CODIGOVENDEDOR_CONS', index: 'CODIGOVENDEDOR_CONS', width: 330, sortable: false, frozen: false},
            {name: 'VENDEDOR_CONS', index: 'VENDEDOR_CONS', width: 90, resizable: false, sortable: false, frozen: false},
            {name: 'VALORPAGO_CONS', index: 'VALORPAGO_CONS', width: 180, sortable: false, frozen: false},
            {name: 'OBSERVACION_CONS', index: 'OBSERVACION_CONS', width: 140, resizable: false, align: "left", sortable: false, frozen: false},
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

function ConfigurarGridMinesDesconocidos() {
    jQuery("#tblGridMinesDesconocidos").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        colNames: [
            'Mines desconocidos',
        ],
        colModel: [
            {name: 'min', index: 'min', width: 140, resizable: true, sortable: true, frozen: false},
        ],
        pager: '#pagGridMinesDesconocidos',
        rowNum: NroFilas,
        rowList: ElementosPagina,
        sortname: 'min',
        sortorder: 'ASC',
        viewrecords: true,
        caption: 'Listado Mines Desconocidos',
        height: 200,
        autowidth: true,
        gridview: true, //Hace mas rï¿½pido la carga de la grilla 
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
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

    jQuery("#tblGridMinesDesconocidos").jqGrid('navGrid', '#pagGridMinesDesconocidos',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
    {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
//    jQuery("#tblGrid").jqGrid('setFrozenColumns');//Fija las columnas 
}

function GenerarDocumentoReporte(accion) {
//    alert("joaoaoa");
//    var someSessionVariable = @Session["minesdesconocidos"];
//    alert(someSessionVariable);
    if (true) {
        window.open('/sisven/cargaconsumo/' + accion);
    } else {
        mostrarVentanaMensaje("Ingrese los parámetros necesarios para generar el reporte", 'Alerta');
    }
}