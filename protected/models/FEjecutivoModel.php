<?php

/**
 * This is the model class for table "tb_asignacion".
 *
 * The followings are the available columns in table 'tb_asignacion':
 * @property integer $ID_ASIG
 * @property integer $ID_PRO
 * @property integer $ID_VEND
 * @property string $FECHAINGRESO_ASIG
 * @property integer $IDUSR_ASIF
 *
 * The followings are the available model relations:
 * @property TbVendedor $iDVEND
 * @property TbProducto $iDPRO
 */
class FEjecutivoModel extends DAOModel {
    /*
     * Búsqueda del total de chips vendidos a cliente por fecha por ejecutivo
     * 1.- obtiene la fecha de la ultima visita
     * 2.- de no tener fin la ultima visita se obtiene 
     * los pedidos un minutos despues de la orden
     * 
     */

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
                        -- AND e_usr_mobilvendor='QU17'
                order by e_nombre asc;";

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
                from tb_ejecutivo
                where 1=1
                    and e_estado='" . $estado . "'
                order by e_nombre asc;";

        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

}
