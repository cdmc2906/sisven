$(document).ready(function () {
    ConfigurarGrids();

    $('#AsignaRutaAgenteForm_tipoUsuario').on('change', function (e) {
        $("#tblAgentes").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblZonasGestion").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblRutasGestion").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblRutasAgente").jqGrid("clearGridData", true).trigger("reloadGrid");
    });

    $("#btnCargarUsuarios").click(function () {
        $("#tblAgentes").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblZonasGestion").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblRutasGestion").jqGrid("clearGridData", true).trigger("reloadGrid");
        $("#tblRutasAgente").jqGrid("clearGridData", true).trigger("reloadGrid");
    });
});

function ConfigurarGrids() {
    jQuery("#tblAgentes").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'TIPO',
            'CODIGO',
            'NOMBRE',
        ],
        colModel: [
            {name: 'TIPO', index: 'TIPO', width: 220, frozen: true, sortable: false, resizable: false, hidden: true},
            {name: 'CODIGOAGENTE', index: 'CODIGOAGENTE', width: 80, hidden: true},
            {name: 'NOMBREAGENTE', index: 'NOMBREAGENTE', width: 300, frozen: true, sortable: false, resizable: false},
        ],
        pager: '#pagGridAgentes',
        rowNum: 6000,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 180,
//        width: 550,
        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
        rownumbers: true,
        caption: "Ejecutivos",
        hidegrid: false,
        grouping: true,
        groupingView: {
            groupField: ['TIPO'],
            groupColumnShow: [false],
            groupCollapse: true,
            groupText: ['<b>{0} - {1} Ejecutivo(s)</b>'],
//            groupOrder: ['desc']
        },

        onSelectRow: function (idFilaSeleccionada) {
            $("#tblRutasAgente").jqGrid("clearGridData", true).trigger("reloadGrid");
            var fila = jQuery("#tblAgentes").jqGrid('getRowData', idFilaSeleccionada);
            jQuery("#tblRutasAgente").jqGrid('setCaption', "Rutas asignadas para: " + fila.NOMBREAGENTE).trigger('reloadGrid');
            cargarRutasAsignadas(fila.CODIGOAGENTE);
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
    jQuery("#tblAgentes").jqGrid('navGrid', '#pagGridAgentes',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    jQuery("#tblZonasGestion").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'TIPOZONA',
            'CODIGO',
            'NOMBRE',
            'EJECUTIVO ENCARGADO',
            'RUTAS',
            'CLIENTES',
        ],
        colModel: [
            {name: 'TIPOZONA', index: 'TIPOZONA', width: 60, frozen: false, sortable: false, resizable: false, align: "center", hidden: true},
            {name: 'CODIGOZONA', index: 'CODIGOZONA', width: 60, frozen: false, sortable: false, resizable: false, align: "center", hidden: true},
            {name: 'NOMBREZONA', index: 'NOMBREZONA', width: 150, sortable: false, frozen: true, align: "left"},
            {name: 'EJECUTIVO', index: 'EJECUTIVO', width: 150, sortable: false, frozen: true},
            {name: 'CANTIDADRUTAS', index: 'CANTIDADRUTAS', width: 50, sortable: false, frozen: true, align: "center"},
            {name: 'CANTIDADCLIENTES', index: 'CANTIDADCLIENTES', width: 70, sortable: false, frozen: true, align: "center"},
        ],
        pager: '#pagGridZonasGestion',
        rowNum: 6000,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
//        multiselect: true,
        height: 170,
//        width: 550,
        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
//        rownumbers: true,
        caption: "Zonas Gestion disponibles",
        hidegrid: false,
        footerrow: true,
        grouping: true,
        groupingView: {
            groupField: ['TIPOZONA'],
            groupColumnShow: [false],
            groupCollapse: true,
            groupText: ['<b>{0} - {1} Zona(s)</b>'],
//            groupOrder: ['desc']
        },
        gridComplete: function () {
            var $grid = $('#tblZonasGestion');
            var colSumRutas = $grid.jqGrid('getCol', 'CANTIDADRUTAS', false, 'sum');
            var colSumClientes = $grid.jqGrid('getCol', 'CANTIDADCLIENTES', false, 'sum');
            $grid.jqGrid('footerData', 'set', {'EJECUTIVO': 'Total'});
            $grid.jqGrid('footerData', 'set', {'CANTIDADRUTAS': colSumRutas});
            $grid.jqGrid('footerData', 'set', {'CANTIDADCLIENTES': colSumClientes});

        },
        onSelectRow: function (idFilaSeleccionada) {
            var fila = jQuery("#tblZonasGestion").jqGrid('getRowData', idFilaSeleccionada);
//                    jQuery("#tblGridDetalle").jqGrid('setCaption', "Detalle rutas visitadas ejecutivo: " + fila.SUPERVISOR).trigger('reloadGrid');
            cargarRutasZona(fila.CODIGOZONA);
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
    jQuery("#tblZonasGestion").jqGrid('navGrid', '#pagGridZonasGestion',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    jQuery("#tblRutasGestion").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'ID',
            'CODIGO',
            'NOMBRE',
            'SEMANA',
            'DIA',
            'CLIENTES',
        ],
        colModel: [
            {name: 'IDRUTA', index: 'IDRUTA', width: 80, frozen: false, sortable: false, resizable: false, align: "center", hidden: true},
            {name: 'CODIGORUTA', index: 'CODIGORUTA', width: 80, frozen: false, sortable: false, resizable: false, align: "center"},
            {name: 'NOMBRERUTA', index: 'NOMBRERUTA', width: 290, sortable: false, frozen: true, },
            {name: 'SEMANA', index: 'SEMANA', width: 60, sortable: false, frozen: true, align: "center"},
            {name: 'DIA', index: 'DIA', width: 40, sortable: false, frozen: true, align: "center"},
            {name: 'CLIENTESRUTA', index: 'CLIENTESRUTA', width: 70, sortable: false, frozen: true, align: "center"},
        ],
        pager: '#pagGridRutasGestion',
        rowNum: 6000,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 170,
//        width: 560,
        autowidth: true,
        multiselect: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
//        rownumbers: true,
        caption: "Rutas disponibles en Zona",
        hidegrid: false,
        footerrow: true,
        gridComplete: function () {
            var $grid = $('#tblRutasGestion');
            var colSum = $grid.jqGrid('getCol', 'CLIENTESRUTA', false, 'sum');
            $grid.jqGrid('footerData', 'set', {'DIA': 'Total'});
            $grid.jqGrid('footerData', 'set', {'CLIENTESRUTA': colSum});

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
    jQuery("#tblRutasGestion").jqGrid('navGrid', '#pagGridRutasGestion',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    jQuery("#tblRutasGestion").jqGrid('navButtonAdd', '#pagGridRutasGestion',
            {
                caption: "Asignar ruta",
                title: "Asignar ruta a ejecutivo seleccionado",
                onClickButton: guardarRutasSeleccionadas
            }
    );

    jQuery("#tblRutasAgente").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'ID USUARO RUTA',
            'CODIGO ZONA',
            'ID RUTA',
            'CODIGO RUTA',
            'RUTA',
            'SEMANA',
            'DIA',
            'CLIENTES',
        ],
        colModel: [
            {name: 'CODIGOUSUARIORUTA', index: 'CODIGOUSUARIORUTA', width: 30, frozen: false, sortable: false, resizable: false, hidden: true},
            {name: 'ZONA', index: 'ZONA', width: 80, frozen: false, sortable: false, resizable: false, align: "center"},
            {name: 'IDRUTA', index: 'IDRUTA', width: 80, frozen: false, sortable: false, resizable: false, align: "center", hidden: true, },
            {name: 'CODIGORUTA', index: 'CODIGORUTA', width: 100, frozen: false, sortable: false, align: "center", resizable: false},
            {name: 'NOMBRERUTA', index: 'NOMBRERUTA', width: 220, sortable: false, frozen: true},
            {name: 'SEMANA', index: 'SEMANA', width: 50, sortable: false, align: "center", frozen: true},
            {name: 'DIA', index: 'DIA', width: 50, sortable: false, align: "center", frozen: true},
            {name: 'CLIENTESRUTA', index: 'CLIENTESRUTA', width: 80, sortable: false, align: "center", formatter: "integer", summaryType: 'sum'},
        ],
        pager: '#pagGridRutasAgente',
        rowNum: 6000,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 160,
//        width: 600,
        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
//        rownumbers: true,
        caption: "Rutas asignadas",
        hidegrid: false,
//        footerrow: true,
        multiselect: true,
        grouping: true,
        groupingView: {
            groupField: ['ZONA']
            , groupColumnShow: [false]
            , groupCollapse: false
            , groupText: ['<b>{0} - {1} Ruta(s)</b>']
        },
//        footerrow: true
//        , gridComplete: function () {
//            var $grid = $('#tblRutasAgente');
//            var colSum = $grid.jqGrid('getCol', 'CLIENTESRUTA', false, 'sum');
//            //alert (colSum)
//            $grid.jqGrid('footerData', 'set', {'SEMANA': 'Total'});
//            $grid.jqGrid('footerData', 'set', {'CLIENTESRUTA': colSum});
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
    jQuery("#tblRutasAgente").jqGrid('navGrid', '#pagGridRutasAgente',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    jQuery("#tblRutasAgente").jqGrid('navButtonAdd', '#pagGridRutasAgente',
            {
                caption: "Quitar ruta",
                title: "Quitar ruta a ejecutivo seleccionado",
                onClickButton: eliminarRutasSeleccionadas
            }
    );
}


function cargarRutasAsignadas(codigoUsuario) {
    $.ajax(
            {
                method: "POST",
                url: "AsignarRutaAgente/CargarRutasAsignadas",
                data: {
                    codigoUsuario: codigoUsuario,
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

                        $("#tblRutasAgente").setGridParam({datatype: 'jsonstring', datastr: datosResult['rutasAsignadas']}).trigger('reloadGrid');
                        $("#tblZonasGestion").setGridParam({datatype: 'jsonstring', datastr: datosResult['zonas']}).trigger('reloadGrid');

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

function cargarRutasZona(codigoZona) {
    $.ajax(
            {
                method: "POST",
                url: "AsignarRutaAgente/CargarRutasZona",
                data: {
                    codigoZona: codigoZona,
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
                        $("#tblRutasGestion").setGridParam({datatype: 'jsonstring', datastr: datosResult}).trigger('reloadGrid');

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

function guardarRutasSeleccionadas() {
    var idFilasSeleccionadas;
    idFilasSeleccionadas = jQuery("#tblRutasGestion").jqGrid('getGridParam', 'selarrrow');

    if (idFilasSeleccionadas.length > 0) {
//        alert(idFilasSeleccionadas);
        var idRutasSeleccionadas = [];
        for (var i = 0; i < idFilasSeleccionadas.length; i += 1) {
            var fila = jQuery("#tblRutasGestion").jqGrid('getRowData', idFilasSeleccionadas[i]);
            idRutasSeleccionadas.push(fila.IDRUTA.concat("-", fila.SEMANA, "-", fila.DIA));
        }
//        alert(idRutasSeleccionadas);
        $.ajax(
                {
                    method: "POST",
                    url: "AsignarRutaAgente/GuardarSeleccion",
                    data: {
                        rutasSeleccionadas: idRutasSeleccionadas,
                    },
                    dataType: 'json',
                    type: 'post',
                    beforeSend: function () {
                        blockUIOpen();
                    },
                    success: function (data)
                    {
                        if (data.Status == 1) {
                            var datosResult = data.Result;
                            $("#tblRutasGestion").jqGrid("clearGridData", true).trigger("reloadGrid");
                            $("#tblRutasAgente").jqGrid("clearGridData", true).trigger("reloadGrid");

                            $("#tblRutasGestion").setGridParam({datatype: 'jsonstring', datastr: datosResult['rutasZona']}).trigger('reloadGrid');
                            $("#tblRutasAgente").setGridParam({datatype: 'jsonstring', datastr: datosResult['rutasAsignadas']}).trigger('reloadGrid');


                            $("#tblRutasAgente").setGridParam({datatype: 'jsonstring', datastr: datosResult['rutasAsignadas']}).trigger('reloadGrid');
                            setMensaje(data.ClasssMessage, data.Message);
                        } else {
                            //to do
                        }
                        blockUIClose();
                    },
                    error: function (xhr, st, err)
                    {
                        blockUIClose();
                        alert(err);
                    }
                }
        );
    } else {
        alert('No existen rutas seleccionadas');
    }
}

function eliminarRutasSeleccionadas() {
    var idFilasSeleccionadas;
    idFilasSeleccionadas = jQuery("#tblRutasAgente").jqGrid('getGridParam', 'selarrrow');
    if (idFilasSeleccionadas.length > 0) {
        var idRutasSeleccionadas = [];
        for (var i = 0; i < idFilasSeleccionadas.length; i += 1) {
            var fila = jQuery("#tblRutasAgente").jqGrid('getRowData', idFilasSeleccionadas[i]);
            idRutasSeleccionadas.push(fila.CODIGOUSUARIORUTA);
        }

        $.ajax(
                {
                    method: "POST",
                    url: "AsignarRutaAgente/EliminarSeleccion",
                    data: {
                        rutasSeleccionadas: idRutasSeleccionadas,
                    },
                    dataType: 'json',
                    type: 'post',
                    beforeSend: function () {
                        blockUIOpen();
                    },
                    success: function (data)
                    {
                        if (data.Status == 1) {
                            var datosResult = data.Result;
                            $("#tblRutasGestion").jqGrid("clearGridData", true).trigger("reloadGrid");
                            $("#tblRutasAgente").jqGrid("clearGridData", true).trigger("reloadGrid");

                            $("#tblRutasGestion").setGridParam({datatype: 'jsonstring', datastr: datosResult['rutasZona']}).trigger('reloadGrid');
                            $("#tblRutasAgente").setGridParam({datatype: 'jsonstring', datastr: datosResult['rutasAsignadas']}).trigger('reloadGrid');
                            setMensaje(data.ClassMessage, data.Message);

                        } else {
                            //to do
                        }
                        blockUIClose();
                    },
                    error: function (xhr, st, err)
                    {
                        blockUIClose();
                        alert(err);
                    }
                }
        );
    } else {
        alert('No existen rutas seleccionadas');
    }
}