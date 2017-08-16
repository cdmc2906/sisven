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
class FComentariosOficinalModel extends DAOModel {

    public function getUltimoEnlaceMapaxVendedorxFecha($ejecutivo, $fechagestion) {
        $sql = "
            select co_enlace_mapa 
                from tb_comentario_oficina 
            where 1=1
                        and co_fecha_historial_revisado='" . $fechagestion . "'
                        and co_ejecutivo_revisado='" . $ejecutivo . "'
            order by co_fecha_ingreso desc
            limit 1    ;
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

}
