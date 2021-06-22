$(document).ready(function () {
    $("#btnValidarAcceso").click(function () {
        var codigoAcceso = document.getElementById('ConsultaChipForm_codigoAcceso').value;
//        alert(document.getElementById('ConsultaChipForm_codigoAcceso').value)
        validarCodigoAcceso(codigoAcceso);
    });

    $("#btnLimpiar").click(function () {
        limpiarCampos();
    });
    $("#btnCopiar").click(function () {
        copiarResultados();
    });
    $("#btnSalir").click(function () {
        document.cookie = "tccvalidaciontoken=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.getElementById("login").style.display = "block";
        document.getElementById("formulario-consulta").style.display = "none";
        limpiarCampos();
        alert("CIERRE EXITOSO");
    });
//    alert(getCookie("tccvalidaciontoken"))
    if (getCookie("tccvalidaciontoken") == "nocookie")
    {
        document.getElementById("login").style.display = "block";
        document.getElementById("formulario-consulta").style.display = "none";
    } else {
        document.getElementById("login").style.display = "none";
        document.getElementById("formulario-consulta").style.display = "block";
    }

});

function limpiarCampos()
{
    $("#ConsultaChipForm_codigoAcceso").val('');
    $("#ConsultaChipForm_codigoLocal").val('');
    $("#ConsultaChipForm_min").val('');
    $("#ConsultaChipForm_icc").val('');
    $("#iccCopiar").val('');
}
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "nocookie";
}

function copiarResultados() {
    var doc = document
            , text = doc.getElementById('iccCopiar')
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

    var copyText = document.getElementById("iccCopiar");

    copyText.select();
    copyText.setSelectionRange(0, 99999); /*For mobile devices*/
//alert(copyText.length)
    document.execCommand("copy");
    alert("Datos copiados");

}
function validarCodigoAcceso(codigo)
{
    $.ajax(
            {
                method: "POST",
                url: "ConsultaChip/ValidarCodigoAcceso",
                data: {
                    codigoIngresado: codigo,
                },
                dataType: 'json',
                type: 'post',
                beforeSend: function ()
                {
                    blockUIOpen();
                },
                success: function (data)
                {
                    blockUIClose();
                    if (data.Status == 1) {
                        var datosResult = data.Result;
                        alert(datosResult['validacion'] + datosResult['usuario']);

                        if (datosResult['validacion'] == "CLAVE DE ACCESO ACEPTADA") {
                            document.getElementById("login").style.display = "none";
                            document.getElementById("formulario-consulta").style.display = "block";
                            document.getElementById("usuario").value = datosResult['usuario'];
                            limpiarCampos();
                        } else {
                            document.getElementById("login").style.display = "block";
                            document.getElementById("formulario-consulta").style.display = "none";
                            limpiarCampos();
                        }
                        console.log(datosResult['info'])
                    }
//                    else {
//                        //to do
//                    }
                },
                error: function (xhr, st, err)
                {
                    blockUIClose();
                    alert(err);
                }
            }
    );
}
