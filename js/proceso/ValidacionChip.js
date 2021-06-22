$(document).ready(function () {
    ConfigurarGrid();
    document.getElementById("promocion").style.display = "none";
    document.getElementById("ejecutivoReporta").style.display = "none";
    $('#ValidacionChipForm_tipoValidacion').on('change', function (e) {
        var e = document.getElementById("ValidacionChipForm_tipoValidacion");
        var strUser = e.selectedIndex;
//        alert(strUser)
        if (strUser == 2)//Promocion
        {
            document.getElementById("promocion").style.display = "block";
//            document.getElementById("promocion").value = "";
        } else {
            document.getElementById("promocion").style.display = "none";
            document.getElementById("ValidacionChipForm_promocion").value = "";
        }
    });
    $('#ValidacionChipForm_reportadoPor').on('change', function (e) {
        if (document.getElementById('ValidacionChipForm_reportadoPor_0').checked)//Ejecutivo
        {
            document.getElementById("ejecutivoReporta").style.display = "block";
            document.getElementById("ejecutivoReporta").value = "Movistar";
        } else {
            document.getElementById("ejecutivoReporta").style.display = "none";
            document.getElementById("ejecutivoReporta").value = "";
        }
    });
    $("#btnGuardarValidacion").click(function () {
        guardarChipsValidadosPromo();
    });
});
function ConfigurarGrid() {
    jQuery("#tblMinesAgente").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'FECHA_REVISION',
            'TIPO',
            'SUBTIPO',
            'MIN_ICC',
            'CAMPO_VALIDA',
            'RESULTADO_VALIDA',
            'COMPRA_CDG_COMPRA',
            'COMPRA_MIN',
            'COMPRA_ICC',
            'COMPRA_FECHA_COMPRA',
            'COMPRA_MIN593',
            'COMPRA_FECHA_ALTA',
            'COMPRA_MESCOMPRA',
            'COMPRA_YEARCOMPRA',
            'TXMOVISTAR_ICC',
            'TXMOVISTAR_MIN',
            'TXMOVISTAR_FECHA',
            'TXMOVISTAR_ID_DISTRI',
            'TXMOVISTAR_NMB_DISTRI',
            'TXMOVISTAR_ID_DESTINO',
            'TXMOVISTAR_NMB_DESTINO',
            'VTMOVISTAR_FECHA',
            'VTMOVISTAR_ICC',
            'VTMOVISTAR_MIN',
            'VTMOVISTAR_ID_DISTRI',
            'VTMOVISTAR_NMB_DISTRI',
            'VTMOVISTAR_ID_DESTINO',
            'VTMOVISTAR_NMB_DESTINO',
            'VENTAS_MIN',
            'VENTAS_IMEI',
            'VENTAS_MIN593',
            'VENTAS_FECHA',
            'VENTAS_NUMERO_BODEGA',
            'VENTAS_BODEGA',
            'VENTAS_SERIE',
            'VENTAS_NUMERO_FACTURA',
            'VENTAS_NOMBRE_CLIENTE',
            'VENTAS_RUC',
            'VENTAS_CODIGO',
            'VENTAS_ESTADO',
//            'ALTAS_MIN ',
            'ALTAS_ICC',
            'ALTAS_FECHA_ALTA',
            'ALTAS_CIUDAD',
            'ALTAS_MESALTA',
            'ALTAS_YEARALTA',
            'PROMO_OPERADORA',
            'PROMO_CODIGO_LOCAL',
            'PROMO_REPORTADO_POR',
            'PROMO_EJECUTIVO_REPORTA',
            'PROMO_REPORTA_VIA',
        ],
        colModel: [
            {name: 'FECHA_REVISION', index: 'FECHA_REVISION', width: 75, sortable: false, frozen: true, },
            {name: 'TIPO', index: 'TIPO', width: 70, sortable: false, frozen: true, },
            {name: 'SUBTIPO', index: 'SUBTIPO', width: 70, sortable: false, frozen: true, },
            {name: 'MIN_ICC', index: 'MIN_ICC', width: 150, sortable: false, frozen: true, },
            {name: 'CAMPO_VALIDA', index: 'CAMPO_VALIDA', width: 150, sortable: false, frozen: true, },
            {name: 'RESULTADO_VALIDA', index: 'RESULTADO_VALIDA', width: 150, sortable: false, frozen: true, },
            {name: 'COMPRA_CDG_COMPRA', index: 'COMPRA_CDG_COMPRA', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'COMPRA_MIN', index: 'COMPRA_MIN', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'COMPRA_ICC', index: 'COMPRA_ICC', width: 150, sortable: false, frozen: true, hidden: false},
            {name: 'COMPRA_FECHA_COMPRA', index: 'COMPRA_FECHA_COMPRA', width: 150, sortable: false, frozen: true, },
            {name: 'COMPRA_MIN593', index: 'COMPRA_MIN593', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'COMPRA_FECHA_ALTA', index: 'COMPRA_FECHA_ALTA', width: 150, sortable: false, frozen: true, hidden: false},
            {name: 'COMPRA_MESCOMPRA', index: 'COMPRA_MESCOMPRA', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'COMPRA_YEARCOMPRA', index: 'COMPRA_YEARCOMPRA', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'TXMOVISTAR_ICC', index: 'TXMOVISTAR_ICC', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'TXMOVISTAR_MIN', index: 'TXMOVISTAR_MIN', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'TXMOVISTAR_FECHA', index: 'TXMOVISTAR_FECHA', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'TXMOVISTAR_ID_DISTRI', index: 'TXMOVISTAR_ID_DISTRI', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'TXMOVISTAR_NMB_DISTRI', index: 'TXMOVISTAR_NMB_DISTRI', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'TXMOVISTAR_ID_DESTINO', index: 'TXMOVISTAR_ID_DESTINO', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'TXMOVISTAR_NMB_DESTINO', index: 'TXMOVISTAR_NMB_DESTINO', width: 150, sortable: false, frozen: true, },
            {name: 'VTMOVISTAR_FECHA', index: 'VTMOVISTAR_FECHA', width: 150, sortable: false, frozen: true, },
            {name: 'VTMOVISTAR_ICC', index: 'VTMOVISTAR_ICC', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'VTMOVISTAR_MIN', index: 'VTMOVISTAR_MIN', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'VTMOVISTAR_ID_DISTRI', index: 'VTMOVISTAR_ID_DISTRI', width: 150, sortable: false, frozen: true, hidden: false},
            {name: 'VTMOVISTAR_NMB_DISTRI', index: 'VTMOVISTAR_NMB_DISTRI', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'VTMOVISTAR_ID_DESTINO', index: 'VTMOVISTAR_ID_DESTINO', width: 150, sortable: false, frozen: true, hidden: false},
            {name: 'VTMOVISTAR_NMB_DESTINO', index: 'VTMOVISTAR_NMB_DESTINO', width: 150, sortable: false, frozen: true, },
            {name: 'VENTAS_MIN', index: 'VENTAS_MIN', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'VENTAS_IMEI', index: 'VENTAS_IMEI', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'VENTAS_MIN593', index: 'VENTAS_MIN593', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'VENTAS_FECHA', index: 'VENTAS_FECHA', width: 150, sortable: false, frozen: true, },
            {name: 'VENTAS_NUMERO_BODEGA', index: 'VENTAS_NUMERO_BODEGA', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'VENTAS_BODEGA', index: 'VENTAS_BODEGA', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'VENTAS_SERIE', index: 'VENTAS_SERIE', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'VENTAS_NUMERO_FACTURA', index: 'VENTAS_NUMERO_FACTURA', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'VENTAS_NOMBRE_CLIENTE', index: 'VENTAS_NOMBRE_CLIENTE', width: 150, sortable: false, frozen: true, },
            {name: 'VENTAS_RUC', index: 'VENTAS_RUC', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'VENTAS_CODIGO', index: 'VENTAS_CODIGO', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'VENTAS_ESTADO', index: 'VENTAS_ESTADO', width: 150, sortable: false, frozen: true, hidden: true},
//            {name: 'ALTAS_MIN ', index: 'ALTAS_MIN ', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'ALTAS_ICC', index: 'ALTAS_ICC', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'ALTAS_FECHA_ALTA', index: 'ALTAS_FECHA_ALTA', width: 150, sortable: false, frozen: true, },
            {name: 'ALTAS_CIUDAD', index: 'ALTAS_CIUDAD', width: 150, sortable: false, frozen: true, },
            {name: 'ALTAS_MESALTA', index: 'ALTAS_MESALTA', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'ALTAS_YEARALTA', index: 'ALTAS_YEARALTA', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'PROMO_OPERADORA', index: 'PROMO_OPERADORA', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'PROMO_CODIGO_LOCAL', index: 'PROMO_CODIGO_LOCAL', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'PROMO_REPORTADO_POR', index: 'PROMO_REPORTADO_POR', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'PROMO_EJECUTIVO_REPORTA', index: 'PROMO_EJECUTIVO_REPORTA', width: 150, sortable: false, frozen: true, hidden: true},
            {name: 'PROMO_REPORTA_VIA', index: 'PROMO_REPORTA_VIA', width: 150, sortable: false, frozen: true, hidden: true},
        ],
        pager: '#pagGridMinesAgente',
        rowNum: 6000,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 280,
//        width: 490,
        autowidth: true,
        gridview: true,
        multiselect: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
//        rownumbers: true,
        caption: "Detalle Chips validados en el dia",
        hidegrid: false,
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
    jQuery("#tblMinesAgente").jqGrid('navGrid', '#pagGridMinesAgente',
            {add: false, edit: false, del: false, search: false, refresh: false, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {}//opciones search
    );
    jQuery("#tblMinesAgente").jqGrid('navButtonAdd', '#pagGridMinesAgente', {
        caption: "Exportar datos",
        title: "Exportar",
        onClickButton: function () {
            var options = {
                includeLabels: true,
                includeGroupHeader: true,
                includeFooter: true,
                fileName: "resultado_validacion.xlsx",
                mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                maxlength: 40,
                onBeforeExport: null,
                replaceStr: null
            }
            $("#tblMinesAgente").jqGrid('exportToExcel', options);
        }
    });
    jQuery("#tblMinesAgente").jqGrid('navButtonAdd', '#pagGridMinesAgente',
            {
                caption: "Notificar Resultado",
                title: "Asignar ruta a ejecutivo seleccionado",
                onClickButton: reportarValidacion
            }
    );
}

function guardarChipsValidadosPromo() {
    $.ajax(
            {
                method: "POST",
                url: "ValidacionChip/GuardarMinesPromo",
                data: {
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
                        alert('Agregado a promocion');
//                                $("#tblRutasGestion").jqGrid("clearGridData", true).trigger("reloadGrid");
//                                $("#tblRutasAgente").jqGrid("clearGridData", true).trigger("reloadGrid");
//
//                                $("#tblRutasGestion").setGridParam({datatype: 'jsonstring', datastr: datosResult['rutasZona']}).trigger('reloadGrid');
//                                $("#tblRutasAgente").setGridParam({datatype: 'jsonstring', datastr: datosResult['rutasAsignadas']}).trigger('reloadGrid');
//
//
//                                $("#tblRutasAgente").setGridParam({datatype: 'jsonstring', datastr: datosResult['rutasAsignadas']}).trigger('reloadGrid');
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
}

function reportarValidacion() {
    var idFilasSeleccionadas;
    idFilasSeleccionadas = jQuery("#tblMinesAgente").jqGrid('getGridParam', 'selarrrow');
    var separadorMensaje = ' | ';
    var nuevaLinea = '\n\n';
    var mensaje = '';
    var filaSeleccionada = '';
    if (idFilasSeleccionadas.length > 0) {
        var filasSeleccionadas = [];
        for (var i = 0; i < idFilasSeleccionadas.length; i += 1) {
            var fila = jQuery("#tblMinesAgente").jqGrid('getRowData', idFilasSeleccionadas[i]);
            var seleccionTipo = document.getElementById('ValidacionChipForm_tipoValidacion').value;
            filasSeleccionadas.push(fila.MIN_ICC.concat(
                    separadorMensaje, 'VENTAS_FECHA '
                    , fila.VENTAS_FECHA
                    , separadorMensaje, 'VENTAS_NOMBRE_CLIENTE '
                    , fila.VENTAS_NOMBRE_CLIENTE
                    , separadorMensaje, 'VENTAS_BODEGA '
                    , fila.VENTAS_BODEGA));
            if (seleccionTipo == 'INVAS') {//INVASION
                filaSeleccionada = fila.MIN_ICC.concat(
                        '/'
                        , fila.COMPRA_ICC
                        ,separadorMensaje, 'TR_MOVI_A: '
                        , fila.TXMOVISTAR_NMB_DESTINO
                        , separadorMensaje, 'FECHA_VENTA: '
                        , fila.VENTAS_FECHA
                        , separadorMensaje, 'CLIENTE: '
                        , fila.VENTAS_NOMBRE_CLIENTE
                        , separadorMensaje, 'BODEGA_DM '
                        , fila.VENTAS_BODEGA);
                mensaje = mensaje.concat(filaSeleccionada, nuevaLinea);
            } else { //PROMOCION - AUDITORIA
                filaSeleccionada = fila.MIN_ICC.concat(
                        separadorMensaje, 'VENTAS_FECHA '
                        , fila.VENTAS_FECHA
                        , separadorMensaje, 'ALTAS_FECHA_ALTA '
                        , fila.ALTAS_FECHA_ALTA
                        , separadorMensaje, 'PROMO_VALIDACION *'
                        , fila.RESULTADO_VALIDA,'*');
                mensaje = mensaje.concat(filaSeleccionada, nuevaLinea);
            }
        }
        document.getElementById("iccCopiar").value = mensaje;
        seleccionarTexto('iccCopiar')
        var copyText = document.getElementById("iccCopiar");
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

        document.execCommand("copy");
        alert("Datos copiados");
    } else {
        alert('No existen filas seleccionadas');
    }
}
function seleccionarTexto(element) {
    var doc = document
            , text = doc.getElementById(element)
            , range, selection
            ;
    if (doc.body.createTextRange) {
        range = document.body.createTextRange();
        range.moveToElementText(text);
        range.select();
    } else if (window.getSelection) {
        selection = window.getSelection();
        range = document.createRange();
        range.selectNodeContents(text);
        selection.removeAllRanges();
        selection.addRange(range);
    }
}
