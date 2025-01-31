<?php

class DefaultController extends Controller
{

    public function actionRead($id)
    {
        $reads = new NotifyiiReads();
        $reads->username = Yii::app()->user->id;
        $reads->notification_id = $id;
        $reads->readed = true;

        $reads->save(false);

        //$this->redirect($this->createUrl('/notifyii'));
        return true;
    }

    public function actionIndex()
    {
        $notifiche = ModelNotifyii::getAllNotifications();
        $number = 0;
        foreach ($notifiche as $notifica) {
            if($notifica->isNotReaded()) {
                $number = $number + 1;
                Yii::app()->user->setFlash('success' . ($number), $notifica->content);
            }
        }

        $this->render('index', array(
            'notifiche' => $notifiche,
        ));
    }

    public function actionAddEndOfWorld()
    {
        $notifyii = new Notifyii();
        $notifyii->message('El fin del mundo');
        $notifyii->expire(new DateTime("21-12-2012"));
        $notifyii->from("-1 week");
        $notifyii->to("+1 day");
        $notifyii->role("admin");
        $notifyii->link($this->createUrl('/site/index'));
        $notifyii->save();

        $url = $this->createUrl('index');
        $this->redirect($url);
    }

}
