<?php

/**
 * Description of Response
 * Objeto para transportar la data desde el VIEW al CONTROLLER para peticiones AJAX
 * @fecha 2014/05/21
 * @author Jorge - Innovasoft
 */
class  Response {
    
    public  $Result = array();
    public  $Message = array();
    public  $Status = SUCCESS;
    public  $ClassMessage = CLASS_MENSAJE_SUCCESS;
           
}
