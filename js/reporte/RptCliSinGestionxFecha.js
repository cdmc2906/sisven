$(document).ready(function () {
    ConfigDatePickersReporte('.txtfechaInicioAnalisis', '.txtfechaFinAnalisis');
    ConfigDatePickersReporte('.txtfechaInicioAnalisisVis', '.txtfechaFinAnalisisVis');

    ConfigurarGrid();

    $("#btnLimpiar").click(function () {
        $("#RptCliSinGestionxFechaForm_tipoUsuario").val('');
        document.getElementById("usuario_seleccionado").style.display = "none";
        $("#RptCliSinGestionxFechaForm_usuario").val('');

        $("#RptCliSinGestionxFechaForm_tipoFecha").val('');
        document.getElementById("seleccion_mes").style.display = "none";
        document.getElementById("seleccion_periodo").style.display = "none";
        document.getElementById("seleccion_rango_fecha").style.display = "none";
        $("#RptCliSinGestionxFechaForm_periodo").val('');
        $("#RptCliSinGestionxFechaForm_usuario").val('');
        $("#RptCliSinGestionxFechaForm_anio").val('');
        $("#RptCliSinGestionxFechaForm_mes").val('');
        $("#RptCliSinGestionxFechaForm_fechaInicioAnalisis").val('');
        $("#RptCliSinGestionxFechaForm_fechaFinAnalisis").val('');


        $("#tblCliSinGestionxFecha").jqGrid("clearGridData", true).trigger("reloadGrid");
    });
    
    $("#btnLimpiarAcum").click(function () {
        $("#div-visitasMes").html("<table id=\"tblVisitasMes\" class=\"table table-condensed\"></table><div id=\"pagtblVisitasMes\"> </div>");
        
        document.getElementById("usuario_seleccionado_acum").style.display = "none";
        $("#RptCliSinGestionxFechaForm_tipoEjecutivoAcum").val('');
        $("#RptCliSinGestionxFechaForm_ejecutivoAcum").val('');
        $("#RptCliSinGestionxFechaForm_anioInicioAcum").val('');
        $("#RptCliSinGestionxFechaForm_mesInicioAcum").val('');
        $("#RptCliSinGestionxFechaForm_anioFinAcum").val('');
        $("#RptCliSinGestionxFechaForm_mesFinAcum").val('');

    });

    $('#RptCliSinGestionxFechaForm_tipoUsuario').on('change', function (e) {
        var e = document.getElementById("RptCliSinGestionxFechaForm_tipoUsuario");
        var strUser = e.selectedIndex;
//        alert(strUser)
        if (strUser == 2)//Por ejecutivo
        {
            document.getElementById("usuario_seleccionado").style.display = "block";
//            document.getElementById("usuario_seleccionado").value = "";
        } else {
            document.getElementById("usuario_seleccionado").style.display = "none";
//            document.getElementById("fecha_rango").value = "";
        }
    });

    $('#RptCliSinGestionxFechaForm_tipoEjecutivoAcum').on('change', function (e) {
        var e = document.getElementById("RptCliSinGestionxFechaForm_tipoEjecutivoAcum");
        var strUser = e.selectedIndex;
//        alert(strUser)
        if (strUser == 1)//Por ejecutivo
        {
            document.getElementById("usuario_seleccionado_acum").style.display = "block";
//            document.getElementById("usuario_seleccionado").value = "";
        } else {
            document.getElementById("usuario_seleccionado_acum").style.display = "none";
//            document.getElementById("fecha_rango").value = "";
        }
    });


    $('#RptCliSinGestionxFechaForm_tipoFecha').on('change', function (e) {
        var e = document.getElementById("RptCliSinGestionxFechaForm_tipoFecha");
        var strUser = e.selectedIndex;
//        alert(strUser)
        if (strUser == 1)
        {
            document.getElementById("seleccion_mes").style.display = "block";
            document.getElementById("seleccion_periodo").style.display = "none";
            document.getElementById("seleccion_rango_fecha").style.display = "none";
        } else if (strUser == 2) {
            document.getElementById("seleccion_mes").style.display = "none";
            document.getElementById("seleccion_periodo").style.display = "block";
            document.getElementById("seleccion_rango_fecha").style.display = "none";
        } else if (strUser == 3) {
            document.getElementById("seleccion_mes").style.display = "none";
            document.getElementById("seleccion_periodo").style.display = "none";
            document.getElementById("seleccion_rango_fecha").style.display = "block";
        } else {
            document.getElementById("seleccion_mes").style.display = "none";
            document.getElementById("seleccion_periodo").style.display = "none";
            document.getElementById("seleccion_rango_fecha").style.display = "none";
        }
    });

});

function ConfigurarGrid() {
    jQuery("#tblDetalleVisitados").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'ITEM',
            'EJECUTIVO',
            'RUTA',
            'CODIGO',
            'CLIENTE',
            'VISITAS',
            'PERIODO',
        ],
        colModel: [
            {name: 'ITEM', index: 'ITEM', width: 50, sortable: false, frozen: true, hidden: true},
            {name: 'EJECUTIVO', index: 'EJECUTIVO', width: 200, sortable: false, frozen: true},
            {name: 'RUTA', index: 'RUTA', width: 50, frozen: false, sortable: false, resizable: false, align: 'center'},
            {name: 'CODIGOCLIENTE', index: 'CODIGOCLIENTE', width: 90, sortable: false, frozen: true},
            {name: 'CLIENTE', index: 'CLIENTE', width: 400, sortable: false, frozen: true},
            {name: 'VISITAS', index: 'VISITAS', width: 60, sortable: false, frozen: true,align:'center'},
            {name: 'PERIODO', index: 'PERIODO', width: 200, sortable: false, frozen: true},
        ],
        pager: '#pagtblDetalleVisitados',
        rowNum: NroFilas,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 300,
        caption: 'Detalle clientes visitados',
        hidegrid: false,
//        width: 550,
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

    jQuery("#tblDetalleVisitados").jqGrid('navGrid', '#pagtblDetalleVisitados',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    jQuery("#tblDetalleVisitados").jqGrid('navButtonAdd', '#pagtblDetalleVisitados', {
        caption: "Exportar",
        title: "Exportar Resultados",
        onClickButton: function () {
            var options = {
                includeLabels: true,
                includeGroupHeader: true,
                includeFooter: true,
                fileName: "clientes_gestionados.xlsx",
                mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                maxlength: 40,
                onBeforeExport: null,
                replaceStr: null
            }
            $("#tblDetalleVisitados").jqGrid('exportToExcel', options);
        }
    });

    jQuery("#tblDetalleNoVisitados").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'ITEM',
            'EJECUTIVO',
            'RUTA',
            'CODIGO',
            'CLIENTE',
            'PERIODO',
        ],
        colModel: [
            {name: 'ITEM', index: 'ITEM', width: 50, sortable: false, frozen: true, hidden: true},
            {name: 'EJECUTIVO', index: 'EJECUTIVO', width: 200, sortable: false, frozen: true},
            {name: 'RUTA', index: 'RUTA', width: 70, frozen: false, sortable: false, resizable: false},
            {name: 'CODIGOCLIENTE', index: 'CODIGOCLIENTE', width: 100, sortable: false, frozen: true},
            {name: 'CLIENTE', index: 'CLIENTE', width: 400, sortable: false, frozen: true},
            {name: 'PERIODO', index: 'PERIODO', width: 200, sortable: false, frozen: true},
        ],
        pager: '#pagtblDetalleNoVisitados',
        rowNum: NroFilas,
        rowList: ElementosPagina,
        //sortname: 'bank_date',
        sortorder: 'ASC',
        viewrecords: true,
        caption: 'Detalle clientes no visitados',
        hidegrid: false,
//        height:'auto',
        height: 300,
//        width: 550,
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

    jQuery("#tblDetalleNoVisitados").jqGrid('navGrid', '#pagtblDetalleNoVisitados',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );
    jQuery("#tblDetalleNoVisitados").jqGrid('navButtonAdd', '#pagtblDetalleNoVisitados', {
        caption: "Exportar",
        title: "Exportar Resultados",
        onClickButton: function () {
            var options = {
                includeLabels: true,
                includeGroupHeader: true,
                includeFooter: true,
                fileName: "clientes_sin_gestion.xlsx",
                mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                maxlength: 40,
                onBeforeExport: null,
                replaceStr: null
            }
            $("#tblDetalleNoVisitados").jqGrid('exportToExcel', options);
        }
    });

}

function GenerarResumenVisitas(datosResult)
{
//    alert(datosResult.toSource())
    $("#gridPivotResumenVisitas").html("<table id=\"tblResumenVisitas\" class=\"table table-condensed\"></table><div id=\"pagtblResumenVisitas\"> </div>");
    jQuery("#tblResumenVisitas").jqGrid('jqPivot', datosResult['resumenVisitas'],
            {
                xDimension:
                        [
                            {dataName: 'EJECUTIVO', },
                            {dataName: 'RUTA', },
                        ],
                yDimension:
                        [
                            {dataName: 'PERIODO'},
//                            {dataName: 'ESTADO'},
                        ],
                aggregates:
                        [
//                            {
//                                member: 'CANTIDAD_CLIENTES',
//                                aggregator: 'sum',
//                                width: 180,
//                                label: 'Conteo',
//                                formatter: 'integer',
//                                formatoptions: {
//                                    thousandsSeparator: "",
//                                },
//
//                                align: 'right',
//                                summaryType: 'sum'
//                            }

                            {
                                member: 'GESTIONADOS',
                                aggregator: 'sum',
                                width: 100,
                                label: 'GESTIONADOS'
                            }, {
                                member: 'NOGESTIONADOS',
                                aggregator: 'sum',
                                width: 120,
                                label: 'NO_GESTIONADOS'
                            }
                        ],
                groupSummaryPos: 'footer',
                rowTotals: false,
                colTotals: true,
                frozenStaticCols: false,
            },
            {
                rowNum: 100,
                rowList: ["100000:Todo", "10:10 Filas", "20:20 Filas", "30:30 Filas"],
                width: 1000,
                shrinkToFit: false,
                height: 200,
                groupingView: {
                    groupSummary: [true],
                    groupCollapse: false,
//                    groupOrder :['asc']
                },
                pager: "#pagtblResumenVisitas",
                hidegrid: false,
//                caption: "Resumen visitados / no visitados",
            }

    );
    $("#tblResumenVisitas").jqGrid('navGrid', '#pagtblResumenVisitas',
            {add: false, edit: false, del: false, search: true},
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}

    );
    jQuery("#tblResumenVisitas").jqGrid('navButtonAdd', '#pagtblResumenVisitas',
            {
                caption: "Exportar",
                title: "Exportar Reporte",
                onClickButton: function () {
                    var options = {
                        includeLabels: true,
                        includeGroupHeader: true,
                        includeFooter: true,
                        fileName: "resumen_visitados_novisitados.xlsx",
                        mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                        maxlength: 40,
                        onBeforeExport: null,
                        replaceStr: null
                    }
                    $("#tblResumenVisitas").jqGrid('exportToExcel', options);
                }
            }
    );

}

function GenerarResumenVisitasPCP(datosResult)
{
//    alert(datosResult.toSource())
    $("#gridPivotResumenVisitasPCP").html("<table id=\"tblResumenVisitasPCP\" class=\"table table-condensed\"></table><div id=\"pagtblResumenVisitasPCP\"> </div>");
    jQuery("#tblResumenVisitasPCP").jqGrid('jqPivot', datosResult['resumenVisitasPCP'],
            {
                xDimension:
                        [
                            {dataName: 'PROVINCIA', },
                            {dataName: 'CANTON', },
                            {dataName: 'PARROQUIA', },
                        ],
                yDimension:
                        [
                            {dataName: 'PERIODO'},
//                            {dataName: 'ESTADO'},
                        ],
                aggregates:
                        [
                            {
                                member: 'GESTIONADOS',
                                aggregator: 'sum',
                                width: 100,
                                label: 'GESTIONADOS'
                            }, {
                                member: 'NOGESTIONADOS',
                                aggregator: 'sum',
                                width: 120,
                                label: 'NO_GESTIONADOS'
                            }
                        ],
                groupSummaryPos: 'footer',
                rowTotals: false,
                colTotals: true,
                frozenStaticCols: false,
            },
            {
                rowNum: 100,
                rowList: ["100000:Todo", "10:10 Filas", "20:20 Filas", "30:30 Filas"],
                width: 1000,
                shrinkToFit: false,
                height: 200,
                groupingView: {
                    groupSummary: [true],
                    groupCollapse: false,
//                    groupOrder :['asc']
                },
                pager: "#pagtblResumenVisitasPCP",
                hidegrid: false,
//                caption: "Resumen visitados / no visitados",
            }

    );
    $("#tblResumenVisitasPCP").jqGrid('navGrid', '#pagtblResumenVisitasPCP',
            {add: false, edit: false, del: false, search: true},
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}

    );
    jQuery("#tblResumenVisitasPCP").jqGrid('navButtonAdd', '#pagtblResumenVisitasPCP',
            {
                caption: "Exportar",
                title: "Exportar Reporte",
                onClickButton: function () {
                    var options = {
                        includeLabels: true,
                        includeGroupHeader: true,
                        includeFooter: true,
                        fileName: "resumen_visitados_novisitados_PCP.xlsx",
                        mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                        maxlength: 40,
                        onBeforeExport: null,
                        replaceStr: null
                    }
                    $("#tblResumenVisitasPCP").jqGrid('exportToExcel', options);
                }
            }
    );

}

function cargarMeses(anio) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        cache: false,
        traditional: true,
        url: 'RptCliSinGestionxFecha/CargarMeses',
        data: {
            anio: anio
        },
        success: function (jsonResponse) {

            if (!$.isEmptyObject(jsonResponse))
            {
                $("#div_mes_por_anio").html(jsonResponse);
            }
        },
        error: function (xhr, st, err) {
        }
    });
}

function cargarMesesInicioAcum(anio) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        cache: false,
        traditional: true,
        url: 'RptCliSinGestionxFecha/CargarMesesInicioAcum',
        data: {
            anio: anio
        },
        success: function (jsonResponse) {

            if (!$.isEmptyObject(jsonResponse))
            {
                $("#div_mes_por_anio_inicio_acum").html(jsonResponse);
            }
        },
        error: function (xhr, st, err) {
        }
    });
}
function cargarMesesFinAcum(anio) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        cache: false,
        traditional: true,
        url: 'RptCliSinGestionxFecha/CargarMesesFinAcum',
        data: {
            anio: anio
        },
        success: function (jsonResponse) {

            if (!$.isEmptyObject(jsonResponse))
            {
                $("#div_mes_por_anio_fin_acum").html(jsonResponse);
            }
        },
        error: function (xhr, st, err) {
        }
    });
}

function crearReporteAcum(result) {
    colD = result['datos'];
    colN = result['titulos'];
    colM = result['columnas'];

    jQuery("#tblVisitasMes").jqGrid({
        jsonReader: {
            cell: "",
            id: "0"
        },
        datatype: 'jsonstring',
        mtype: 'POST',
        datastr: colD,
        colNames: colN,
        colModel: colM,
        pager: jQuery('#pagtblVisitasMes'),
        rowNum: 10,
        rowList: [5, 10, 20, 50],
        viewrecords: true,
        width: 1000,
//        gridview: false,
        shrinkToFit: true,
    })
    jQuery("#tblVisitasMes").jqGrid('navGrid', '#pagtblVisitasMes',
            {add: false, edit: false, del: false, search: true, refresh: true, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {multipleSearch: true, closeAfterSearch: true, closeOnEscape: true}//opciones search
    );

    jQuery("#tblVisitasMes").jqGrid('navButtonAdd', '#pagtblVisitasMes', {
        caption: "Exportar",
        title: "Exportar Resultados",
        onClickButton: function () {
            var options = {
                includeLabels: true,
                includeGroupHeader: true,
                includeFooter: true,
                fileName: "clientes_gestionados_por_mes.xlsx",
                mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                maxlength: 40,
                onBeforeExport: null,
                replaceStr: null
            }
            $("#tblVisitasMes").jqGrid('exportToExcel', options);
        }
    });
}
