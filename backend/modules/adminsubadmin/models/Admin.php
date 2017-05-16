<?php

namespace backend\modules\adminsubadmin\models;

use Yii;
// use backend\modules\admin\models\Admin;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $admin_type
 * @property string $last_logout
 * @property integer $status
 * @property integer $is_deleted
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_date
 * @property string $updated_date
 * @property integer $created_at
 * @property integer $updated_at
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['first_name', 'last_name', 'username', 'password_hash', 'email', 'admin_type', 'last_logout', 'is_deleted', 'created_by', 'updated_by', 'created_date', 'updated_date', 'created_at', 'updated_at'], 'required'],

            [['first_name', 'last_name', 'username', 'password_hash', 'email'], 'required', 'on'=> 'update_profile'],

            [['first_name', 'last_name', 'username', 'password_hash', 'email' , 'admin_type', 'status'], 'required', 'on'=> 'create_admin'],

            [['first_name', 'last_name', 'username', 'password_hash', 'email' , 'admin_type', 'status'], 'required', 'on'=> 'update_admin'],


            [['admin_type'], 'string'],
            [['last_logout', 'created_date', 'updated_date'], 'safe'],
            [['status', 'is_deleted', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['first_name', 'last_name', 'username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            
            [['username'], 'unique'],
            
            [['email'], 'unique'],
            ['email', 'email'],
            
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'admin_type' => Yii::t('app', 'Admin Type'),
            'last_logout' => Yii::t('app', 'Last Logout'),
            'status' => Yii::t('app', 'Status'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function getUsercreatedby()
    {
        return $this->hasOne(Admin::className(), ['id' => 'created_by']);
    }

    public function getUserupdatedby()
    {
        return $this->hasOne(Admin::className(), ['id' => 'updated_by']);
    }
}
