/*
 * Secci�n variables globales
 */
var delayAnimate = 6000; //en milisegundos - 1000 -> 1 segundo
var msjError = "Ocurrio un error inesperado. Intentelo nuevamente.";

var aTildeJS = '\xe1';
var eTildeJS = '\xe9';
var iTildeJS = '\xed';
var oTildeJS = '\xf3';
var uTildeJS = '\xfa';
/* Fin Secci�n variables globales*/

function ConfigDatePicker(campo) {
    $(campo).datepicker(
            {
                format: "yyyy/mm/dd",
                startView: 1,
                language: "es",
                autoclose: true,
                endDate: "0d",
                weekStart: 1,
            }
    )
}

function setMensaje(clase, message)
{
    // $('html, body').animate({scrollTop: 0}, duration);
    $('#main').scrollTop(0);

    if (typeof message == 'object')
    {
        var code = '<li><div class="flash-' + clase + '">' + 'ERROR: ' + message.code + "</div></li>";
        var error = '<li><div class="flash-' + clase + '">' + "MENSAJE:<br>" + message.error + "</div></li>";
        var file = '<li><div class="flash-' + clase + '">' + 'ARCHIVO: ' + message.file + "</div></li>";
        var line = '<li><div class="flash-' + clase + '">' + 'LINEA: ' + message.line + "</div></li>";
        message = code + error + file + line;
    } else
    {
        message = '<li><div class="flash-' + clase + '">' + message + "</div></li>";
    }

    $("ul.flashes").html(message);

    showEffect();
    hideEffect();
    return false;
}

function hideEffect() {
    $(".flashes").animate({opacity: 1.0}, delayAnimate).fadeOut("slow");
}


function showEffect() {
    $("#ulMensajesUsuarios").removeClass("displayNone");
    $(".flashes").show();
}

function RedirigirError(error) {
    if (error == 403 || error == 401) {
        location.reload();
    } else {
        mostrarVentanaMensaje(msjError, 'Error');
    }
}

function mostrarVentanaMensaje(mensaje, tituloDialogo, clase) {

    var msj = null;
    if (clase == undefined)
    {
        msj = '<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>';
    } else
    {
        msj = '<span class= "' + clase + '" style="float:left; margin:0 7px 20px 0;"></span>';
    }

    $('#divDialogMensaje > p').html(msj + mensaje);

    $('#divDialogMensaje').dialog({
        modal: true,
        dialogClass: 'popup',
        stack: true,
        resizable: false,
        zIndex: 3999,
        width: 400,
        minHeight: 10
//        buttons: {
//            'Ok': function() {
//                $(this).dialog('destroy');
//                $('#divDialogMensaje > p').html('');                
//            }
//        }
    }).dialog('option', 'title', tituloDialogo).dialog('open');
}

function ConfigDatePickersRango2(inicio) {
    $(inicio).daterangepicker();
}

function ConfigDatePickersReporteMismoMes(inicio, fin) {
    $(inicio)
            .datepicker({
                format: "yyyy-mm-dd",
                startView: 1,
                language: "es",
                autoclose: true,
                weekStart: 1,
            })
            .on('changeDate', function (e) {
                var selectedDate = $(inicio).val();
                $(fin).datepicker('setStartDate', selectedDate);
                var fechaInicio = new Date(e.date);
                var fechaMaxima = new Date(fechaInicio.getFullYear(), fechaInicio.getMonth() + 1, 0);
                $(fin).datepicker('setEndDate', fechaMaxima);
            }
            );

    $(fin)
            .datepicker({
                format: "yyyy-mm-dd",
                startView: 1,
                language: "es",
                autoclose: true,
                weekStart: 1,
            }
            )
            .on('changeDate', function (e) {
                var maxDate = new Date();
                $(inicio).datepicker('setEndDate', maxDate);
            }
            );
}

function ConfigDatePickersReporte(inicio, fin) {
    $(inicio)
            .datepicker({
                format: "yyyy-mm-dd",
                startView: 1,
                language: "es",
                autoclose: true,
                weekStart: 1,
            })
            .on('changeDate', function (e) {
                var selectedDate = $(inicio).val();
                $(fin).datepicker('setStartDate', selectedDate);
                var fechaInicio = new Date(e.date);
                var fechaMaxima = new Date(fechaInicio.getFullYear(), fechaInicio.getMonth() + 2, 0);
                $(fin).datepicker('setEndDate', fechaMaxima);
            }
            );

    $(fin)
            .datepicker({
                format: "yyyy-mm-dd",
                startView: 1,
                language: "es",
                autoclose: true,
                weekStart: 1,
            }
            )
            .on('changeDate', function (e) {
                var maxDate = new Date();
                $(inicio).datepicker('setEndDate', maxDate);
            }
            );
}

/*
 * tipoRango : 1 semanal . 2 mensual
 * 
 */
function ConfigDatePickersRango(inicio, fin, tipoRango, rango) {
//    var fechaHoy = new Date();
//    var fechaMinima = new Date(fechaHoy.getFullYear(), fechaHoy.getMonth(), 1);
    $(inicio)
            .datepicker({
                format: "yyyy-mm-dd",
                startView: 1,
                language: "es",
                autoclose: true,
                weekStart: 1,
            }
            )
//            .datepicker('setStartDate', fechaMinima)
            .on('changeDate', function (e) {
                var selectedDate = $(inicio).val();
                $(fin).datepicker('setStartDate', selectedDate);
                var fechaInicio = new Date(e.date);
                var fechaMaxima;
                switch (tipoRango) {
                    case 1:
                        fechaMaxima = new Date(fechaInicio.getFullYear(), fechaInicio.getMonth() + 11, 0);
                        break;
                    case 2:
                        fechaMaxima = new Date(fechaInicio.getFullYear(), fechaInicio.getMonth(), fechaInicio.getDate() + rango);
                        break;

                    case 3:
                        //agrego 1 al mes porque getmonth devuelve el numero de mes mes 1. es decir enero es 0
                        fechaMaxima = new Date(fechaInicio.getFullYear(), fechaInicio.getMonth() + 1 + rango, 0);
                        break;
                }
                $(fin).datepicker('setEndDate', fechaMaxima);
            }
            );

    $(fin)
            .datepicker({
                format: "yyyy-mm-dd",
                startView: 1,
                language: "es",
                autoclose: true,
                weekStart: 1,
            }
            )
            .on('changeDate', function (e) {
                var maxDate = new Date();
                $(inicio).datepicker('setEndDate', maxDate);
            }
            );
}

function ConfigDatePickersReporteSemana(inicio, fin) {
    $(inicio)
            .datepicker({
                format: "yyyy-mm-dd",
                startView: 1,
                language: "es",
                autoclose: true,
                weekStart: 1,
                beforeShowDay: $(inicio).datepicker.noWeekends,
            }
            )
            .on('changeDate', function (e) {
                var selectedDate = $(inicio).val();
                $(fin).datepicker('setStartDate', selectedDate);
//                alert(selectedDate);
                var fechaHoy = new Date();
//                alert(fechaHoy);
                var fechaMaxima = new Date(e.date);
                fechaMaxima.setMonth(fechaMaxima.getMonth() + 12);
                var anio = fechaMaxima.getFullYear();
                var mes = fechaMaxima.getMonth();
                var dia = new Date(fechaMaxima.getFullYear(), fechaMaxima.getMonth(), 0).getDate();

                $(fin).datepicker('setEndDate', fechaHoy);

            }
            );

    $(fin)
            .datepicker({
                format: "yyyy-mm-dd",
                startView: 1,
                language: "es",
                autoclose: true
            }
            )
            .on('changeDate', function (e) {
                var maxDate = new Date();
                $(inicio).datepicker('setEndDate', maxDate);
            }
            );
}