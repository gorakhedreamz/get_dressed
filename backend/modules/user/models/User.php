<?php

namespace backend\modules\user\models;

use Yii;
use backend\modules\adminsubadmin\models\Admin;
use backend\modules\countries\models\Countries;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $dob
 * @property integer $age
 * @property integer $country_id
 * @property string $device_type
 * @property string $device_token
 * @property string $password_reset_token
 * @property integer $status
 * @property integer $is_deleted
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_date
 * @property string $updated_date
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $style;
    
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['first_name', 'last_name', 'email', 'username', 'auth_key', 'password_hash', 'dob', 'age', 'country_id', 'device_type', 'device_token', 'is_deleted', 'created_by', 'updated_by', 'created_date', 'updated_date', 'created_at', 'updated_at'], 'required'],
            
            [['first_name', 'last_name', 'email', 'username', 'password_hash', 'dob', 'country_id', 'status', 'style'], 'required', 'on'=>'backend_create_user'],
            
            [['first_name', 'last_name', 'email', 'username', 'password_hash', 'dob', 'country_id', 'status', 'style'], 'required', 'on'=>'backend_update_user'],
            

            [['dob', 'created_date', 'updated_date'], 'safe'],
            [['age', 'country_id', 'status', 'is_deleted', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['device_type', 'device_token'], 'string'],
            [['first_name', 'last_name', 'email', 'username', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            
            [['username'], 'unique'],
            [['email'], 'unique' , 'on'=>['backend_create_user', 'backend_update_user'], 'message'=> 'This email has already been taken.'],
            [['email'], 'email', 'on'=>['backend_create_user', 'backend_update_user']],
            
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
            'email' => Yii::t('app', 'Email'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password'),
            'dob' => Yii::t('app', 'Date Of Birth'),
            'age' => Yii::t('app', 'Age'),
            'country_id' => Yii::t('app', 'Country'),
            'device_type' => Yii::t('app', 'Device Type'),
            'device_token' => Yii::t('app', 'Device Token'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
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

    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    public function getUsercreatedby()
    {
        return $this->hasOne(Admin::className(), ['id' => 'created_by']);
    }

    public function getUserupdatedby()
    {
        return $this->hasOne(Admin::className(), ['id' => 'updated_by']);
    }

    public static function getUserCount()
    {
        return User::find()->where(['is_deleted' => 0])->count();
    }
}
