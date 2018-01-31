$(document).ready(function () {
    ConfigurarGrids();
    $("#btnBuscarAsignaciones").click(function () {
        cargarMinesAsignados();
        document.getElementById("btnGenerate").disabled = false;

        document.getElementById("divPreguntas").style.display = "block";

        document.getElementById("divPregunta2").style.display = "none";
        document.getElementById("divPregunta3").style.display = "none";
        document.getElementById("divPregunta4").style.display = "none";
        document.getElementById("divPregunta1a").style.display = "none";

        document.getElementById("RevisarMinesForm_pregunta1").value = "";
        document.getElementById("RevisarMinesForm_pregunta1a").value = "";
        document.getElementById("RevisarMinesForm_pregunta2").value = "";
        document.getElementById("RevisarMinesForm_pregunta3").value = "";
        document.getElementById("RevisarMinesForm_pregunta4").value = "";
    });
    $("#btnLimpiar").click(function () {
        document.getElementById("divPregunta2").style.display = "none";
        document.getElementById("divPregunta3").style.display = "none";
        document.getElementById("divPregunta4").style.display = "none";

        document.getElementById("divPregunta1a").style.display = "none";

        document.getElementById("RevisarMinesForm_pregunta1").value = "";
        document.getElementById("RevisarMinesForm_pregunta1a").value = "";
        document.getElementById("RevisarMinesForm_pregunta2").value = "";
        document.getElementById("RevisarMinesForm_pregunta3").value = "";
        document.getElementById("RevisarMinesForm_pregunta4").value = "";
    });

    $('#RevisarMinesForm_pregunta1').on('change', function (e) {
        var e = document.getElementById("RevisarMinesForm_pregunta1");
        var strUser = e.selectedIndex;
//        alert(strUser)
        if (strUser == 1)//Contactado
        {
            document.getElementById("divPregunta2").style.display = "block";
            document.getElementById("divPregunta3").style.display = "block";
            document.getElementById("divPregunta4").style.display = "block";
            document.getElementById("divPregunta1a").style.display = "none";

            document.getElementById("RevisarMinesForm_pregunta1a").value = "";
        } else {
            document.getElementById("divPregunta2").style.display = "none";
            document.getElementById("divPregunta3").style.display = "none";
            document.getElementById("divPregunta4").style.display = "none";

            document.getElementById("divPregunta1a").style.display = "block";

            document.getElementById("RevisarMinesForm_pregunta2").value = "";
            document.getElementById("RevisarMinesForm_pregunta3").value = "";
            document.getElementById("RevisarMinesForm_pregunta4").value = "";
        }
    });
    $('#RevisarMinesForm_pregunta1a').on('change', function (e) {
        var e = document.getElementById("RevisarMinesForm_pregunta1a");
        var strUser = e.selectedIndex;
//        alert(strUser)
        if (strUser == 1 || strUser == 3)//Contactado
        {
            document.getElementById("divPregunta2").style.display = "block";
            document.getElementById("RevisarMinesForm_pregunta2").value = "Movistar";
        } else {
            document.getElementById("divPregunta2").style.display = "none";
            document.getElementById("RevisarMinesForm_pregunta2").value = "";
        }
    });

});

function ConfigurarGrids() {
    jQuery("#tblMinesAgente").jqGrid({
        loadonce: true,
        datatype: 'json',
        mtype: 'POST',
        url: 'ConfigurarGrid',
        colNames: [
            'ID',
            'ICC',
            'MIN',
            'VENDEDOR',
        ],
        colModel: [
            {name: 'IDMIN', index: 'IDMIN', width: 1, sortable: false, frozen: true, },
            {name: 'IMEI', index: 'IMEI', width: 150, sortable: false, frozen: true, align: "left", },
            {name: 'MIN', index: 'MIN', width: 100, sortable: false, frozen: true, align: "center"},
            {name: 'VENDEDOR', index: 'VENDEDOR', width: 220, sortable: false, frozen: true, align: "left"},
        ],
        pager: '#pagGridMinesAgente',
        rowNum: 6000,
        rowList: ElementosPagina,
        sortorder: 'ASC',
        viewrecords: true,
//        height: 'auto',
        height: 400,
//        width: 490,
        autowidth: true,
        gridview: true,
        shrinkToFit: false, //permite mantener la dimensi�n personalizada de las celdas,
        rownumbers: true,
        caption: "Mines asignados",
        hidegrid: false,
//        footerrow: true,
        onSelectRow: function (idFilaSeleccionada) {
            document.getElementById("btnGenerate").disabled = false;

            document.getElementById("divPregunta2").style.display = "none";
            document.getElementById("divPregunta3").style.display = "none";
            document.getElementById("divPregunta4").style.display = "none";
            document.getElementById("divPregunta1a").style.display = "none";

            document.getElementById("RevisarMinesForm_pregunta1").value = "";
            document.getElementById("RevisarMinesForm_pregunta1a").value = "";
            document.getElementById("RevisarMinesForm_pregunta2").value = "";
            document.getElementById("RevisarMinesForm_pregunta3").value = "";
            document.getElementById("RevisarMinesForm_pregunta4").value = "";

            var fila = jQuery("#tblMinesAgente").jqGrid('getRowData', idFilaSeleccionada);
            var prefijo = document.getElementById("txtPrefijo").value;
            
            var numeroTelefonoLlamar = '';
            var min = fila.MIN;
            if (prefijo > 0) {
                numeroTelefonoLlamar = prefijo.concat(min);
            } else
                numeroTelefonoLlamar = min;

            document.getElementById("txtTelefonoConPrefijo").value = numeroTelefonoLlamar;
            guardarDatosFilaSeleccionada(fila.IDMIN, fila.IMEI, fila.MIN);
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
    jQuery("#tblMinesAgente").jqGrid('navGrid', '#pagGridMinesAgente',
            {add: false, edit: false, del: false, search: false, refresh: false, view: false}, //options 
            {}, // edit options 
            {}, // add options 
            {}, // del options 
            {}//opciones search
    );
}

function cargarMinesAsignados() {
    $.ajax(
            {
                method: "POST",
                url: "RevisarMines/CargarMinesAsignados",
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
//alert(datosResult.toSource());
                        $("#tblMinesAgente").setGridParam({datatype: 'jsonstring', datastr: datosResult['minesAsignados']}).trigger('reloadGrid');
//                        $("#tblZonasGestion").setGridParam({datatype: 'jsonstring', datastr: datosResult['zonas']}).trigger('reloadGrid');
                        document.getElementById("txtAvanceGestion").value = datosResult['contador'];

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

function guardarDatosFilaSeleccionada(IDMIN, IMEI, MIN) {
    $.ajax(
            {
                method: "POST",
                url: "RevisarMines/SetearFilaSeleccionada",
                data: {
                    IDMIN: IDMIN,
                    IMEI: IMEI,
                    MIN: MIN,
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
//                        $("#tblMinesAgente").setGridParam({datatype: 'jsonstring', datastr: datosResult['minesAsignados']}).trigger('reloadGrid');
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