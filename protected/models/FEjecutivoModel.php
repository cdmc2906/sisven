<?php

class FEjecutivoModel extends DAOModel {

    public function getEjecutivosXGrupoXEstado($grupoEjecutivos, $estado = 1) {
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
                    AND e_tipo NOT IN ('O','M') -- USUARIOS PARA OTROS SISTEMAS(O -> OTRO M ->MAYORISTA
                     --and e_usr_mobilvendor='QU23'
                order by e_nombre asc;";
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
                    WHEN 'EZ' THEN 'EJECUTIVO_ZONA'
                    WHEN 'D' THEN 'DESARROLLADOR'
                    WHEN 'S' THEN 'SUPERVISOR'
                    WHEN 'SC' THEN 'SERVICIO_CLIENTE'
                    WHEN 'ST' THEN 'SERVICIO_TECNICO'
                    END as e_tipo
                from tb_ejecutivo
                where 1=1
                    and e_estado=1
                    and e_tipo in($tipos)
                order by e_tipo
                ";
//        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

}
