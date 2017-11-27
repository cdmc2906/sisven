<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class Libreria {

    public function weekOfMonth($date) {
        $firstOfMonth = date("Y-m-01", strtotime($date));
        return intval(date("W", strtotime($date))) - intval(date("W", strtotime($firstOfMonth))) + 1;
    }

    /**
     * Haversine Formula
     * Basado en ESTO: http://www.taringa.net/posts/hazlo-tu-mismo/14270601/PHP-Calcular-distancia-entre-dos-coordenadas.html
     * Formula para sacar distancia entre dos puntos dada la latitud y longitud de dos puntos.
     * Esta distancia tiene que estar dada en notación DECIMAL y no en SEXADECIMAL (Grados, minutos... etc)
     * @param type $latitud 1
     * @param type $longitud 1
     * @param type $latitud 2
     * @param type $longitud 2
     * @return type, Distancia en Kms, con 1 decimal de precisión
     */
    // haversineGreatCircleDistance
    public function DistanciaEntreCoordenadas(
    $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo) {
        // convert from degrees to radians
        $earthRadius = 6371000;
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    // funcion que devuelve un array con los elementos de una hora

    public function parteHora($hora) {
        $horaSplit = explode(":", $hora);

        if (count($horaSplit) < 3) {
            $horaSplit[2] = 0;
        }

        return $horaSplit;
    }

    // funcion que devuelve la suma de dos horas en formato horas:minutos:segundos
    // Devuelve FALSE si se ha producido algun error
    function SumaHoras($time1, $time2) {
        list($hour1, $min1, $sec1) = $this->parteHora($time1);
        list($hour2, $min2, $sec2) = $this->parteHora($time2);

        return date('H:i:s', mktime($hour1 + $hour2, $min1 + $min2, $sec1 + $sec2));
    }

}
