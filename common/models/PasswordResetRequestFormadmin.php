<?php
namespace common\models;

use common\models\Admin;
use Yii;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestFormadmin extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\Admin',
                'filter' => ['status' => Admin::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = Admin::findOne([
            'status' => Admin::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }
        
        if (!Admin::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
        }
        
        if (!$user->save()) {
            return false;
        }
         

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html_admin', 'text' => 'passwordResetToken-text_admin'],
                ['user' => $user]
            )

            ->setFrom([\Yii::$app->params['supportEmail'] => ' GetDressed'])
            ->setTo($this->email)
            ->setSubject('Password reset for GetDressed')
            ->send();
    }
}
