$(document).ready(function () {
    ConfigGridJSON();
    $("#btnLimpiar").click(function () {
//        alert($("#ReporteChipsFacturadosTransferidosForm_anioConsulta").val(0));
        $("#ReporteChipsFacturadosTransferidosForm_anioConsulta").val(0);
        $("#ReporteChipsFacturadosTransferidosForm_mesConsulta").val(0);
        $("#tblGridFacturadosNoTransferidos").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblGridNoFacturadosTransferidos").jqGrid("clearGridData", true).trigger("reloadGrid");
    });
    $("#btnExcelFacturadosNoTransferidos").click(function () {
        GenerarDocumentoReporte('GenerateExcel', 'FNT');
    });
    $("#btnExcelNoFacturadosTransferidos").click(function () {
        GenerarDocumentoReporte('GenerateExcel', 'NFT');
    });
});


function ConfigGridJSON() {
    jQuery("#tblGridFacturadosNoTransferidos").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'VerDatosArchivo',
        colNames: [
            'FECHA',
            'BODEGA',
            'COD CLIENTE',
            'CLIENTE',
            'ICC',
            'MIN',
            'LOTE'
        ],
        colModel: [
            {name: 'FECHA',
                index: 'FECHA',
                sortable: false,
                frozen: true,
                width: 80
            },
            {name: 'BODEGA', index: 'BODEGA', sortable: false, frozen: true
                , width: 120
            },
            {name: 'COD_CLIENTE', index: 'COD_CLIENTE', sortable: false, frozen: true
                , width: 90
            },
            {name: 'CLIENTE', index: 'CLIENTE', sortable: false, frozen: true
                , width: 200},
            {name: 'ICC', index: 'ICC', sortable: false, frozen: true
                , width: 150
            },
            {name: 'MIN', index: 'MIN', sortable: false, frozen: true                , width: 80},
            {name: 'LOTE', index: 'LOTE', sortable: false, frozen: true                , width: 150},
        ],
        pager: '#pagGridFacturadosNoTransferidos',
        rowNum: 200, //NroFilas,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 300,
        width: 923,
//        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
//        rownumbers: true,
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

    jQuery("#tblGridFacturadosNoTransferidos").jqGrid('navGrid', '#pagGridFacturadosNoTransferidos',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );

    jQuery("#tblGridNoFacturadosTransferidos").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'VerDatosArchivo',
        colNames: [
            'FECHA',
            'EJECUTIVO',
            'COD CLIENTE',
            'CLIENTE',
            'ICC',
            'MIN'
        ],
        colModel: [
            {name: 'FECHA', index: 'FECHA', sortable: false, frozen: true, width: 80},
            {name: 'EJECUTIVO', index: 'EJECUTIVO', sortable: false, frozen: true, width: 120},
            {name: 'COD_CLIENTE', index: 'COD_CLIENTE', sortable: false, frozen: true, width: 90},
            {name: 'CLIENTE', index: '_CLIENTE', sortable: false, frozen: true, width: 200},
            {name: 'ICC', index: 'ICC', sortable: false, frozen: true, width: 150},
            {name: 'MIN', index: 'MIN', sortable: false, frozen: true, width: 80},
        ],
        pager: '#pagGridNoFacturadosTransferidos',
        rowNum: 200, //NroFilas,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 300,
        width: 770,
//        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensiï¿½n personalizada de las celdas,
//        rownumbers: true,

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

    jQuery("#tblGridNoFacturadosTransferidos").jqGrid('navGrid', '#pagGridNoFacturadosTransferidos',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
}

function GenerarDocumentoReporte(accion, opcion) {
    if ($("#ReporteInicioFinJornadaxFechaForm_fechaInicioFinJornadaInicio").val() != "") {
        window.open('/sisven_2/ReporteChipsFacturadosTransferidos/'
                + accion
                + '?opcion=' + opcion
                );
    } else {
        mostrarVentanaMensaje("Ingrese los parámetros necesarios para generar el reporte", 'Alerta');
    }
}

