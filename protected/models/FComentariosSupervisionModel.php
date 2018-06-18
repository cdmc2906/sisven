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
class FComentariosSupervisionModel extends DAOModel {

    public function getUltimoComentarioSupervisionxEjecutivoxFechaxUsuario($ejecutivo, $fechagestion, $usuario) {
        $sql = "
          select cs_comentario
            from tb_comentario_supervision
            where 1=1
                and cs_fecha_historial_supervisado='" . $fechagestion . "'
                and cs_ejecutivo_supervisado='" . $ejecutivo . "'
                and cs_usuario_ingresa_modifica= " . $usuario . "
            order by  cs_fecha_ingreso desc
            limit 1   ;";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getComentariosSupervisionxEjecutivoxFecha($ejecutivo, $fechagestion) {
        $sql = "
          select cu.username 
                ,cs.cs_comentario
                -- ,convert(date,cs_fecha_ingreso) as fecha
                cs_fecha_ingreso AS fecha
            from tb_comentario_supervision as cs
                inner join cruge_user as cu
                    on cs.cs_usuario_ingresa_modifica=cu.iduser
            where 1=1
                and cs_fecha_historial_supervisado='" . $fechagestion . "'
                and cs_ejecutivo_supervisado='" . $ejecutivo . "'
            order by  cs_fecha_ingreso ;
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getComentarioSupervisionxEjecutivoxFecha($ejecutivo, $fechagestion) {
        $sql = "
          select
          top 1
                cu.username 
                ,cs.cs_comentario
                ,convert(date,cs.cs_fecha_ingreso) as fecha
                ," . FuncionesBaseDatos::convertToDate('sqlsrv', 'cs_fecha_ingreso') . "as fecha
            from tb_comentario_supervision as cs
                inner join cruge_user as cu
                    on cs.cs_usuario_ingresa_modifica=cu.iduser
            where 1=1
                and cs_fecha_historial_supervisado='" . $fechagestion . "'
                and cs_ejecutivo_supervisado='" . $ejecutivo . "'
            order by  cs_fecha_ingreso 
            
            ;
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

}
