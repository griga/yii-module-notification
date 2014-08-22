<?php

/** Created by griga at 20.08.14 | 18:40.
 *
 */
class NotificationDispatcher extends CComponent
{

    /**
     * @param NotificationForm $form
     */
    public static function processContactRequest($form)
    {
        $message = $form->message . '<br>';
        if($form->fullname)
            $message .= '<br>' . $form->fullname;
        if($form->phone)
            $message .= '<br>' . $form->phone;
        if($form->email)
            $message .= '<br>' . $form->email;
        $model = new Notification();
        $model->subject = $form->subject;
        $model->message = $message;
        $model->type = Notification::TYPE_CONTACT_REQUEST;
        $model->status = Notification::STATUS_NEW;
        $model->save();

        self::sendNotifications(
            self::getNotifyEmails('contact_notify_emails'),
            $model
        );
    }


    /**
     * @param [] $emails
     * @param Notification $notification
     */
    public static function sendNotifications($emails, $notification)
    {
        foreach ($emails as $email) {
            MailService::sendMessage($notification->subject, $notification->message, $email);
        }
    }

    public static function getNotifyEmails($key){
        return explode(',',preg_replace('~\s+~', '', Config::get($key)));
    }

} 