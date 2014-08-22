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
            ['captcha', 'recaptcha'],
        ];
    }

    /**
     * check google recaptcha
     * check the password against the pattern requested
     * by the strength parameter
     * This is the 'passwordStrength' validator as declared in rules().
     */
    public function recaptcha($attribute,$params)
    {
        require_once(Yii::getPathOfAlias('ext.recaptcha.recaptchalib').'.php');
        $privateKey = Config::get('apiKeys.recaptcha.private');
        $resp = recaptcha_check_answer ($privateKey,
            $_SERVER["SERVER_NAME"],
            $this->attributes[$attribute]['challenge'],
            $this->attributes[$attribute]['response']);

        if (!$resp->is_valid) {
            $this->addError($attribute,("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
                "(reCAPTCHA said: " . $resp->error . ")"));
        }
    }


}