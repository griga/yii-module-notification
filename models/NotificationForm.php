<?php

/** Created by griga at 20.08.14 | 18:23.
 *
 */
class NotificationForm extends CFormModel
{

    public $email;
    public $fullname;
    public $subject;
    public $message;
    public $phone;
    public $captcha;

    public function rules()
    {
        return [
            ['email', 'email'],
            ['email, fullname, subject, message, phone','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')],
            ['captcha', 'captcha', 'allowEmpty' => !Yii::app()->user->isGuest || !CCaptcha::checkRequirements(),
            'captchaAction'=>'site/captcha'],
        ];
    }


}