/*
 * Secci�n variables globales
 */
var delayAnimate = 5000;
var msjError = "Ocurrio un error inesperado. Intentelo nuevamente.";

var aTildeJS = '\xe1';
var eTildeJS = '\xe9';
var iTildeJS = '\xed';
var oTildeJS = '\xf3';
var uTildeJS = '\xfa';
/* Fin Secci�n variables globales*/

function ConfigDatePicker(campo) {
    $(campo)
            .datepicker({
                format: "yyyy/mm/dd",
                startView: 1,
                language: "es",
                autoclose: true,
                endDate: "0d"
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
    }
    else
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
    }
    else
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

function ConfigDatePickersReporte(inicio, fin) {
    $(inicio)
            .datepicker({
                format: "yyyy/mm/dd",
                startView: 1,
                language: "es",
                autoclose: true
            }
            )
            .on('changeDate', function (e) {
                var selectedDate = $(inicio).val();
                $(fin).datepicker('setStartDate', selectedDate);

                var fechaHoy = new Date();
                var fechaMaxima = new Date(e.date);
                fechaMaxima.setMonth(fechaMaxima.getMonth() + 12);
                var anio = fechaMaxima.getFullYear();
                var mes = fechaMaxima.getMonth();
                var dia = new Date(fechaMaxima.getFullYear(), fechaMaxima.getMonth(), 0).getDate();

                if (fechaHoy > fechaMaxima)
                {
                    var fecha = anio + "/" + mes + "/" + dia;
                    $(fin).datepicker('setEndDate', fecha);
                    $(fin).datepicker('setDate', fecha);
                }
                else
                {
                    $(fin).datepicker('setEndDate', fechaHoy);
                    $(fin).datepicker('setDate', fechaHoy.getFullYear() + '/' + (fechaHoy.getMonth() + 1) + '/' + fechaHoy.getDate());
                }
            }
            );

    $(fin)
            .datepicker({
                format: "yyyy/mm/dd",
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