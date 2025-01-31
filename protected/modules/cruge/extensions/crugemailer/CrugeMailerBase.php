<?php

/**    CrugeMailerBase

  centraliza la emision de correos electronicos ademas de darle formato utilizando patrones
  y vistas.

  asume que el layout sera:
  application/protected/modules/cruge/views/layout/mailer.php

  y que las vistas estan alojadas en:
  application/protected/modules/cruge/views/mailer/

  uso:

  1. configuracion:
  debe ser inicializado en config/main de esta manera:
  'crugemailer'=>array(
  'class' => 'application.modules.cruge.components.CrugeMailer',
  'mailfrom' => 'christiansalazarh@gmail.com',
  'subjectprefix' => 'CrugeMailer - ',
  ),


  @author: Christian Salazar H. <christiansalazarh@gmail.com> @salazarchris74
  http://www.yiiframeworkenespanol.org/licencia
 */
abstract class CrugeMailerBase extends CApplicationComponent {

    public $layout = null; // por defecto hacia //protected/modules/cruge/views/mailer
    public $mailfrom; // configurado en mail config
    public $subjectprefix = ""; // prefijo para los asuntos del correo
    public $controllerId = "mailer";
    public $cc;
    public $bcc;
    public $replyTo;
    private $_controller = null;
    private $_module = null;

    public function init() {
        parent::init();
        $this->_module = Yii::app(); // si no se quiere usar como modulo, apuntar a app()
    }

    public function setModule(CModule $module) {
        $this->_module = $module;
    }

    /* Contruye un controller para renderizar el contenido de los correos en base
      a vistas.

      asume que el layout sera:
      application/protected/modules/cruge/views/layout/mailer.php

      y que las vistas estan alojadas en:
      application/protected/modules/cruge/views/mailer/
     */

    protected function getController() {
        if ($this->_controller == null) {
            $this->_controller = new CController($this->controllerId, $this->_module);
            $this->_controller->layout = $this->controllerId;
        }
        return $this->_controller;
    }

    protected function render($viewname, $data = array()) {
        return $this->getController()->render($viewname, $data, true);
    }

    protected function sendEmail($to, $subject, $body, $pathArchivoAdjunto) {
        $from = $this->mailfrom;
        $cc = '';
        $bcc = '';
        $reply = '';
        if ($this->replyTo == '')
            $this->replyTo = $from;
        if ($this->cc != '')
            $cc = 'Cc: ' . $this->cc . "\r\n";
        if ($this->bcc != '')
            $bcc = 'Bcc: ' . $this->bcc . "\r\n";

        $reply = 'Reply-To: ' . $this->replyTo . "\r\n";
        $_subject = $this->subjectprefix . $subject;
        $headers = "To: {$to}\r\nFrom: {$from}\r\n";
        $headers .= $reply;
        $headers .= $cc;
        $headers .= $bcc;
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
        //var_dump($to, $_subject, $body, $headers);die();
        //$ret = @mail($to, $_subject, $body, $headers);
        $ret = $this->sendMail($to, $_subject, $body, $pathArchivoAdjunto, $headers);
        $tmp = "to:" . $to . "\nsubject:" . $_subject . "\nheaders:\n"
                . $headers . "\nbody:" . $body . "\n";
        Yii::app()->session['resultadoEnvioMail'] = $ret;
        Yii::log(__METHOD__ . "\nreturns:" . $ret . "\n" . $tmp, "email");
        Yii::app()->session['detalleResultadoEnvioMail'] = __METHOD__ . "\nreturns:" . $ret . "\n" . $tmp . "email";
        return $ret;
    }

    function sendMail($to, $subject, $message, $pathArchivoAdjuntar, $additional_headers = null, $additional_parameters = null) {
        Yii::import('application.extensions.phpmailer.JPhpMailer');
        $nameFrom = "SISVEN";
        $from = "sisven@tececab.com.ec";
//    $passwordFrom = "innova2013";
        $mail = new JPhpMailer;
        $mail->IsSMTP();
        $mail->Host = '172.17.1.4';
//    $mail->SMTPAuth = true;
        $mail->Username = $from;
//    $mail->Password = $passwordFrom;
        $mail->SetFrom($from, $nameFrom);
        $mail->Subject = $subject;
        $mail->AltBody = 'Para ver el mensaje, por favor, utilice un visor de correo electrónico HTML compatible!';
        $mail->MsgHTML($message);
        $mail->AddAddress($to);
        if (strlen($pathArchivoAdjuntar) > 0)
            $mail->AddAttachment($pathArchivoAdjuntar);
        //var_dump($mail); die();
        return $mail->Send();
    }

    function sendMailFrom($from, $to, $subject, $message) {
        Yii::import('application.extensions.phpmailer.JPhpMailer');

        $mail = new JPhpMailer;
        $mail->IsSMTP();
        $mail->Host = '172.17.1.4';
        $mail->SMTPAuth = true;
        $mail->Username = $from["mail"];
        $mail->Password = $from["password"];
        $mail->SetFrom($from["mail"], $from["name"]);
        $mail->Subject = $subject;
        $mail->AltBody = 'Para ver el mensaje, por favor, utilice un visor de correo electrónico HTML compatible!';
        $mail->MsgHTML($message);
        $mail->AddAddress($to);
        $mail->CharSet = 'utf-8';
        $mail->AddCC($from["mail"]);
        return $mail->Send();
    }

}
