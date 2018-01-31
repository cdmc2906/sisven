$(document).ready(function () {
    ConfigurarGrids();
    $("#btnBuscarAsignaciones").click(function () {
        cargarRutasAsignadas();
    });

    $('#GestionClientesRutaForm_pregunta1').on('change', function (e) {
        var e = document.getElementById("GestionClientesRutaForm_pregunta1");
        var strUser = e.selectedIndex;
//alert(strUser);
        if (strUser == '1') //seleccion de contactado
        {
            document.getElementById("divPregunta2").style.display = "block";
            document.getElementById("divPregunta3").style.display = "block";
            document.getElementById("divPregunta4").style.display = "block";
            document.getElementById("divPregunta5").style.display = "block";
            document.getElementById("divReportarNovedad").style.display = "block";
            document.getElementById("divObservacionGeneral").style.display = "block";

            document.getElementById("divPregunta1a").style.display = "none";
        } else {
            document.getElementById("divPregunta2").style.display = "none";
            document.getElementById("divPregunta3").style.display = "none";
            document.getElementById("divPregunta4").style.display = "none";
            document.getElementById("divPregunta5").style.display = "none";
            document.getElementById("divPregunta6").style.display = "none";
            document.getElementById("divReportarNovedad").style.display = "none";
            document.getElementById("divObservacionGeneral").style.display = "none";

            document.getElementById("divPregunta1a").style.display = "block";
        }
//        alert(strUser);
    });

    $('#GestionClientesRutaForm_pregunta4').on('change', function (e) {
        var e = document.getElementById("GestionClientesRutaForm_pregunta4");
        var strUser = e.selectedIndex;
//alert(strUser);
        if (strUser == '1') //seleccion si
        {
            document.getElementById("divPregunta6").style.display = "none";
        } else { //seleccion no
            document.getElementById("divPregunta6").style.display = "block";
        }
    });

});

function ConfigurarGrids() {
    jQuery("#tblRutasAgente").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'ID USUARO RUTA',
            'CODIGO ZONA',
            'ID RUTA',
            'RUTA',
            'RUTA',
            'CLIENTES',
        ],
        colModel: [
            {name: 'CODIGOUSUARIORUTA', index: 'CODIGOUSUARIORUTA', width: 30, frozen: false, sortable: false, resizable: false, hidden: true},
            {name: 'ZONA', index: 'ZONA', width: 80, frozen: false, sortable: false, resizable: false, align: "center"},
            {name: 'IDRUTA', index: 'IDRUTA', width: 80, frozen: false, sortable: false, resizable: false, align: "center", hidden: true, },
            {name: 'CODIGORUTA', index: 'CODIGORUTA', width: 50, frozen: false, sortable: false, align: "center", resizable: false},
            {name: 'NOMBRERUTA', index: 'NOMBRERUTA', width: 180, sortable: false, frozen: true, align: "left", },
            {name: 'CLIENTESRUTA', index: 'CLIENTESRUTA', width: 70, sortable: false, frozen: true, align: "center"},
        ],
        pager: '#pagGridRutasAgente',
        rowNum: 6000,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 255,
        width: 355,
//        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
//        rownumbers: true,
        caption: "Rutas asignadas",
        hidegrid: false,
//        footerrow: true,
//        multiselect: true,
        grouping: true,
        groupingView: {
            groupField: ['ZONA']
            , groupColumnShow: [false]
//            , groupCollapse: true
            , groupText: ['<b>{0} - {1} Ruta(s)</b>']
        },
        onSelectRow: function (idFilaSeleccionada) {
            var fila = jQuery("#tblRutasAgente").jqGrid('getRowData', idFilaSeleccionada);
            jQuery("#tblClientesRuta").jqGrid('setCaption', "Clientes ruta: " + fila.NOMBRERUTA).trigger('reloadGrid');
            cargarClientesRutas(fila.CODIGORUTA);
        },
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
    jQuery("#tblRutasAgente").jqGrid('navGrid', '#pagGridRutasAgente',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );

    jQuery("#tblClientesRuta").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'CLIENTE',
            'NOMBRE',
            'CONTACTOS',
            'ESTADO VISITA',
            'VENTA',
            'LLAMADA ANTERIOR',
        ],
        colModel: [
            {name: 'CODIGOCLIENTE', index: 'CODIGOCLIENTE', width: 90, frozen: false, sortable: false, resizable: false, },
            {name: 'NOMBRECLIENTE', index: 'NOMBRECLIENTE', width: 250, frozen: false, sortable: false, resizable: false, },
            {name: 'CONTACTOS', index: 'CONTACTOS', width: 150, frozen: false, sortable: false, resizable: false, align: "center", },
            {name: 'ESTADOVISITA', index: 'ESTADOVISITA', width: 100, frozen: false, sortable: false, align: "right", resizable: false},
            {name: 'VENTA', index: 'VENTA', width: 70, sortable: false, frozen: true},
            {name: 'LLAMADAANTERIOR', index: 'LLAMADAANTERIOR', width: 130, sortable: false, frozen: true, align: "center"},
        ],
        pager: '#pagGridClientesRuta',
        rowNum: 10,
        rowList: 10, //ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 230,
        width: 800,
//        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
//        rownumbers: true,
        caption: "Rutas asignadas",
        hidegrid: false,
//        footerrow: true,
//        multiselect: true,
//        grouping: true,
//        groupingView: {
//            groupField: ['ZONA']
//            , groupColumnShow: [false]
//            , groupCollapse: true
//            , groupText: ['<b>{0} - {1} Ruta(s)</b>']
//        },
        onSelectRow: function (idFilaSeleccionada) {
            var fila = jQuery("#tblClientesRuta").jqGrid('getRowData', idFilaSeleccionada);
//            jQuery("#tblClientesRuta").jqGrid('setCaption', "Clientes ruta: " + fila.NOMBRERUTA).trigger('reloadGrid');
            cargarDatosCliente(fila.CODIGOCLIENTE);
        },
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
    jQuery("#tblClientesRuta").jqGrid('navGrid', '#pagGridClientesRuta',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    var lastsel;
    jQuery("#tblTelefonosCliente").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'TELEFONO',
            'VALIDO',
            'IDTELEFONO',
        ],
        colModel: [
            {
                name: 'TELEFONO',
                index: 'TELEFONO',
                width: 120,
                editable: true, editoptions: {size: 13},
                frozen: false,
                sortable: false,
                resizable: false, },
            {
                name: 'VALIDO',
                index: 'VALIDO',
                width: 80,
                editable: true, edittype: 'checkbox', editoptions: {value: 'Si:No'},
                frozen: false,
                sortable: false,
                resizable: false,
                align: "center", },
            {name: 'IDTELEFONO', index: 'IDTELEFONO', width: 90, frozen: false, sortable: false, resizable: false, hidden: "true"},
        ],
        pager: '#pagTelefonosCliente',
        rowNum: 10,
        rowList: 10, //ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 80,
        width: 220,
//        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
//        rownumbers: true,
        caption: "Telefonos",
        editurl: "GestionarClientesAsignados/AgregarActualizarTelefonoCliente",
        hidegrid: false,
//        footerrow: true,
//        multiselect: true,
//        grouping: true,
//        groupingView: {
//            groupField: ['ZONA']
//            , groupColumnShow: [false]
//            , groupCollapse: true
//            , groupText: ['<b>{0} - {1} Ruta(s)</b>']
//        },
        onSelectRow: function (id) {
            if (id && id !== lastsel) {
                jQuery('#tblTelefonosCliente').jqGrid('restoreRow', lastsel);
                jQuery('#tblTelefonosCliente').jqGrid('editRow', id, true);
                lastsel = id;
            }
        },
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
    jQuery("#tblTelefonosCliente").jqGrid('navGrid', '#pagTelefonosCliente',
            {add: true, edit: false, del: false, search: false, refresh: true, view: false}, //options 
            {},
            {drag: false, reloadAfterSubmit: false}, // add options 
            {}, // del options 
//            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
            );

    jQuery("#tblNovedadesNoCompraChip").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'NOVEDAD',
            'IDNOVEDAD',
        ],
        colModel: [
            {name: 'NOVEDAD', index: 'NOVEDAD', width: 250, frozen: false, sortable: false, resizable: false, },
            {name: 'IDNOVEDAD', index: 'IDNOVEDAD', width: 90, frozen: false, sortable: false, resizable: false, hidden: "true"},
        ],
//        pager: '#pagGridClientesRuta',
        rowNum: 10,
        rowList: 10, //ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 80,
        width: 280,
//        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
//        rownumbers: true,
        caption: "Opciones",
        hidegrid: false,
//        footerrow: true,
        multiselect: true,
//        grouping: true,
//        groupingView: {
//            groupField: ['ZONA']
//            , groupColumnShow: [false]
//            , groupCollapse: true
//            , groupText: ['<b>{0} - {1} Ruta(s)</b>']
//        },
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

    jQuery("#tblNovedadesIncidentes").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'NOVEDAD',
            'OBSERVACION',
            'IDNOVEDAD',
        ],
        colModel: [
            {name: 'NOVEDAD', index: 'NOVEDAD', width: 100, frozen: false, sortable: false, resizable: false, },
            {
                name: 'OBSERVACIONNOVEDAD',
                editable: true, editoptions: {size: 500},
                index: 'OBSERVACIONNOVEDAD', width: 520, frozen: false, sortable: false, resizable: false, },
            {name: 'IDNOVEDAD', index: 'IDNOVEDAD', width: 90, frozen: false, sortable: false, resizable: false, hidden: "true"},
        ],
//        pager: '#pagGridClientesRuta',
        rowNum: 10,
        rowList: 10, //ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 90,
//        autoheight: true,
//        width: 380,
        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
//        rownumbers: true,
        caption: "Opciones",
        hidegrid: false,
//        footerrow: true,
        multiselect: true,
//        grouping: true,
//        groupingView: {
//            groupField: ['ZONA']
//            , groupColumnShow: [false]
//            , groupCollapse: true
//            , groupText: ['<b>{0} - {1} Ruta(s)</b>']
//        },
        editurl: "GestionarClientesAsignados/ReportarNovedad",
        onSelectRow: function (id) {
            if (id && id !== lastsel) {
                jQuery('#tblNovedadesIncidentes').jqGrid('restoreRow', lastsel);
                jQuery('#tblNovedadesIncidentes').jqGrid('editRow', id, true);
                lastsel = id;
            }
        },
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

    jQuery("#tblHistorialNovedades").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'IDNOVEDAD',
//            'N',
            'FECHA',
            'NOVEDAD',
            'DETALLE NOVEDAD',
            'ESTADO',
            'RESPONSABLE',
            'DESIGNACION',
            'FECHA SOL',
            'SOLUCION',
        ],
        colModel: [
            {name: 'ID', index: 'ID', width: 20, frozen: false, sortable: false, resizable: false,align: "CENTER", },
//            {name: 'ITEM', index: 'ITEM', width: 30, frozen: false, sortable: false, resizable: false, },
            {name: 'FECHAINGRESO', index: 'FECHAINGRESO', width: 70, frozen: false, sortable: false, resizable: false, },
            {name: 'NOVEDAD', index: 'NOVEDAD', width: 90, frozen: false, sortable: false, resizable: false, align: "center", },
            {name: 'DETALLENOVEDAD', index: 'DETALLENOVEDAD', width: 250, frozen: false, sortable: false, align: "left", resizable: false},
            {name: 'ESTADO', index: 'ESTADO', width: 70, sortable: false, frozen: true},
            {name: 'RESPONSABLE', index: 'RESPONSABLE', width: 150, sortable: false, frozen: true, align: "center"},
            {name: 'DESIGNACION', index: 'DESIGNACION', width: 150, sortable: false, frozen: true, align: "center"},
            {name: 'FECHASOLUCION', index: 'FECHASOLUCION', width: 120, sortable: false, frozen: true, align: "center"},
            {name: 'SOLUCION', index: 'SOLUCION', width: 250, sortable: false, frozen: true, align: "center"},
        ],
        pager: '#pagHistorialNovedades',
        rowNum: 10,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 200,
//        width: 1150,
        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
//        rownumbers: true,
        caption: "Historial Novedades",
        hidegrid: false,
//        footerrow: true,
//        multiselect: true,
//        grouping: true,
//        groupingView: {
//            groupField: ['ZONA']
//            , groupColumnShow: [false]
//            , groupCollapse: true
//            , groupText: ['<b>{0} - {1} Ruta(s)</b>']
//        },
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
    jQuery("#tblHistorialNovedades").jqGrid('navGrid', '#pagHistorialNovedades',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
}

function cargarRutasAsignadas() {
    $.ajax(
            {
                method: "POST",
                url: "GestionarClientesAsignados/CargarRutasAsignadas",
//                data: {
//                    codigoUsuario: codigoUsuario,
//                },
                dataType: 'json',
                type: 'post',
                beforeSend: function () {
                    blockUIOpen();
                },
                success: function (data)
                {
                    blockUIClose();
                    if (data.Status == 1) {
                        var datosResult = data.Result;

                        $("#tblRutasAgente").setGridParam({datatype: 'jsonstring', datastr: datosResult['rutasAsignadas']}).trigger('reloadGrid');
//                        $("#tblZonasGestion").setGridParam({datatype: 'jsonstring', datastr: datosResult['zonas']}).trigger('reloadGrid');

                    } else {
                        //to do
                    }
                },
                error: function (xhr, st, err)
                {
                    blockUIClose();
                    alert(err);
                }
            }
    );
}

function cargarClientesRutas(codigoRuta) {
    $.ajax(
            {
                method: "POST",
                url: "GestionarClientesAsignados/CargarClientesRutas",
                data: {
                    codigoRuta: codigoRuta,
                },
                dataType: 'json',
                type: 'post',
                beforeSend: function () {
                    blockUIOpen();
                },
                success: function (data)
                {
                    blockUIClose();
                    if (data.Status == 1) {
                        var datosResult = data.Result;
                        $("#tblClientesRuta").setGridParam({datatype: 'jsonstring', datastr: datosResult}).trigger('reloadGrid');

                    } else {
                        //to do
                    }
                },
                error: function (xhr, st, err)
                {
                    blockUIClose();
                    alert(err);
                }
            }
    );
}

function cargarDatosCliente(codigoCliente) {
    $.ajax(
            {
                method: "POST",
                url: "GestionarClientesAsignados/CargarDatosCliente",
                data: {
                    codigoCliente: codigoCliente,
                },
                dataType: 'json',
                type: 'post',
                beforeSend: function () {
                    blockUIOpen();
                },
                success: function (data)
                {
                    blockUIClose();
                    if (data.Status == 1) {
                        var datosResult = data.Result;
                        $("#txtCodigoCliente").val(datosResult['codigoCliente']);
                        $("#txtNombreCliente").val(datosResult['nombreCliente']);
                        $("#txtEstadoAnterior").val(datosResult['estadoAnterior']);
                        $("#txtNovedadesCliente").val(datosResult['novedades']);
                        $("#txtContactosCliente").val(datosResult['contactosCliente']);
                        $("#txtChipsVenta").val(datosResult['chipsVenta']);
//alert(datosResult['telefonosValidar'].toSource());
                        $("#tblTelefonosCliente").setGridParam({datatype: 'jsonstring', datastr: datosResult['telefonosValidar']}).trigger('reloadGrid');
                        $("#tblNovedadesNoCompraChip").setGridParam({datatype: 'jsonstring', datastr: datosResult['novedadesNoCompraChip']}).trigger('reloadGrid');
                        $("#tblNovedadesIncidentes").setGridParam({datatype: 'jsonstring', datastr: datosResult['novedadesIncidencia']}).trigger('reloadGrid');
                        
                        $("#tblHistorialNovedades").setGridParam({datatype: 'jsonstring', datastr: datosResult['historialNovedades']}).trigger('reloadGrid');




                    } else {
                        //to do
                    }
                },
                error: function (xhr, st, err)
                {
                    blockUIClose();
                    alert(err);
                }
            }
    );
}
