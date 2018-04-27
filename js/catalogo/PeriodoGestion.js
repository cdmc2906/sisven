$(document).ready(function () {
    $('#PeriodoGestionModel_pg_tipo').on('change', function (e) {
        var e = document.getElementById("PeriodoGestionModel_pg_tipo");
        var strUser = e.selectedIndex;
//    alert(strUser)
        document.getElementById("PeriodoGestionModel_pg_fecha_inicio").value = '';
        document.getElementById("PeriodoGestionModel_pg_fecha_fin").value = '';
        switch (strUser) {
            case 1: //semanal
                ConfigDatePickersRango('.txtfechaInicioPeriodo', '.txtfechaFinPeriodo', strUser, 6);
                document.getElementById("PeriodoGestionModel_pg_fecha_inicio").disabled = false;
                document.getElementById("PeriodoGestionModel_pg_fecha_fin").disabled = false;
                break;
            case 2://mensual
                ConfigDatePickersRango('.txtfechaInicioPeriodo', '.txtfechaFinPeriodo', strUser, 0);
                document.getElementById("PeriodoGestionModel_pg_fecha_inicio").disabled = false;
                document.getElementById("PeriodoGestionModel_pg_fecha_fin").disabled = false;
                break;
        }
    });

    $("#btnLimpiar").click(function () {
        document.getElementById("PeriodoGestionModel_pg_fecha_inicio").val = "";
    });
}
);