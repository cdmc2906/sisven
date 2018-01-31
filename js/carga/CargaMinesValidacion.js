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
            'FECHA',
            'BODEGA', 
            'NOMCLI',
            'CODGRUP', 
            'DETALLE',
            'IMEI', 
            'MIN',
            'VENDEDOR', 
            'ASIGNADO A', 
        ],
        colModel: [
            {name: 'FECHA', index: 'FECHA', width: 90, resizable: false, sortable: false, frozen: false},
            {name: 'BODEGA', index: 'BODEGA', width: 130, resizable: false, sortable: false, frozen: false},
            {name: 'NOMBRE_CLIENTE', index: 'NOMBRE_CLIENTE', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'CODIGO_GRUPO', index: 'CODIGO_GRUPO', width: 100, resizable: false, sortable: false, frozen: false},
            {name: 'DETALLE', index: 'DETALLE', width: 100, resizable: false, sortable: false, frozen: false},
            {name: 'IMEI', index: 'IMEI', width: 150, resizable: false, sortable: false, frozen: false},
            {name: 'MIN', index: 'MIN', width: 90, resizable: false, sortable: false, frozen: false},
            {name: 'VENDEDOR', index: 'VENDEDOR', width: 200, resizable: false, sortable: false, frozen: false},
            {name: 'USUARIOASGINADO', index: 'USUARIOASGINADO', width: 80, resizable: false, sortable: false, frozen: false},
        ],
        pager: '#pagGrid',
        rowNum: NroFilas,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 360,
//        width: 1100,
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

