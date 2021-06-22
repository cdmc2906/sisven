<?php

class FEjecutivoModel extends DAOModel {

    public function getEjecutivosXGrupoXEstado($grupoEjecutivos, $estado = 1) {
        $tipoUsuarios = '';
        if ($grupoEjecutivos != 'T')
            $tipoUsuarios = "and e_tipo ='" . $grupoEjecutivos . "'";

        $sql = "
            select 
                     e_nombre
                    ,e_usr_mobilvendor
                    ,e_iniciales
                from tb_ejecutivo
                where 1=1
                    and e_estado='" . $estado . "'
                    " . $tipoUsuarios . "
                    AND e_tipo NOT IN ('O','M') -- USUARIOS PARA OTROS SISTEMAS(O -> OTRO M ->MAYORISTA
                     --and e_usr_mobilvendor='QU23'
                order by e_nombre asc;";
        //    var_dump($sql);die();   
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

    public function getEjecutivosXGrupoXEstadoXFechaGestion($grupoEjecutivos, $estado = 1, $fechaInicio, $fechaFin) {
        $usuarios = '';
        if ($grupoEjecutivos != 'T')
            $usuarios = "and e_tipo ='" . $grupoEjecutivos . "'";

        $sql = "
            select 
                     e_nombre
                    ,e_usr_mobilvendor
                    ,e_iniciales
                from tb_ejecutivo
                where 1=1
                    and e_estado='" . $estado . "'
                    " . $usuarios . "
                    AND e_tipo NOT IN ('O','M') -- USUARIOS PARA OTROS SISTEMAS(O -> OTRO M ->MAYORISTA)
                        and e_usr_mobilvendor in (
                            select DISTINCT h_usuario 
                                from tb_historial_mb 
                                where convert(date,h_fecha) between '" . $fechaInicio . "' and '" . $fechaFin . "' 
                                and  h_accion='Inicio Visita'
                                --and h_usuario='mb05' 
                                )
                order by e_nombre asc;";
//        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getEjecutivoFormatoXGestion($codigoMbEjecutivo, $estado = 1) {

        $sql = "
            select 
                     e_nombre
                    ,e_usr_mobilvendor
                    ,e_iniciales
                from tb_ejecutivo
                where 1=1
                    and e_estado='" . $estado . "'      
                    and e_usr_mobilvendor in ('" . $codigoMbEjecutivo . "');";
//        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

    public function getEjecutivosXUsrMobilvendor($ejecutivo) {
        $sql = "
            select 
                     e_nombre
                    ,e_usr_mobilvendor
                    ,e_iniciales
                from tb_ejecutivo
                where 1=1
                    and e_usr_mobilvendor='$ejecutivo'
                order by e_nombre asc;";
//        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

    public function getEjecutivosXEstado($estado = 1) {
        $usuarios = '';
        $sql = "
            select 
                     e_nombre
                    ,e_usr_mobilvendor
                    ,e_iniciales
                    ,e-
                from tb_ejecutivo
                where 1=1
                    and e_estado='" . $estado . "'
                order by e_nombre asc;";

        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

    public function getEjecutivosXEstadoXTipos($estado = 1, $tipos) {
        $usuarios = '';
        $sql = "
            select 
                     e_nombre
                    ,e_usr_mobilvendor
                    ,e_iniciales
                    ,e_cod
                    ,CASE e_tipo
                    WHEN 'EZM' THEN 'EJECUTIVO_ZONA_MOVISTAR'
                    WHEN 'EZMC' THEN 'EJECUTIVO_ZONA_MOVISTAR_CENTRO'
                    WHEN 'EZT' THEN 'EJECUTIVO_ZONA_TUENTI'
                    WHEN 'D' THEN 'DESARROLLADOR'
                    WHEN 'SUPM' THEN 'SUPERVISOR_MOVISTAR'
                    WHEN 'SUPMC' THEN 'SUPERVISOR_MOVISTAR CENTRO'
                    WHEN 'SUPT' THEN 'SUPERVISOR_TUENTI'
                    WHEN 'SC' THEN 'SERVICIO_CLIENTE'
                    WHEN 'ST' THEN 'SERVICIO_TECNICO'
                    END as e_tipo
                from tb_ejecutivo
                where 1=1
                    and e_estado=1
                    and e_tipo in($tipos)
                order by e_tipo
                ";
//            var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

}
