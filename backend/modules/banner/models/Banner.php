<?php

namespace backend\modules\banner\models;

use Yii;
use backend\modules\adminsubadmin\models\Admin;

use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

/**
 * This is the model class for table "tbl_banner".
 *
 * @property integer $id
 * @property string $image
 * @property integer $is_activated
 * @property integer $is_deleted
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_date
 * @property string $updated_date
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['image', 'is_activated'], 'required', 'on'=> 'backend_create_banner'],
            [['is_activated'], 'required', 'on'=> 'backend_update_banner'],

            [['image'], 'string'],
            [['is_activated', 'is_deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image' => Yii::t('app', 'Banner Image'),
            'is_activated' => Yii::t('app', 'Is Activated'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }

    public function uploadBanner()
    {            
        $this->image = UploadedFile::getInstance($this, 'image');

        $nameofimage = 'banner_'.time().'.'.$this->image->extension; 
        $rootPath = Yii::getAlias('@rootPath');
        $pathofimage = $rootPath.'/backend/web/uploads/banner/original/' .$nameofimage;    
        $this->image->saveAs($pathofimage); 
         
        // $thumb_271X209 = $rootPath.'/frontend/web/uploads/banner/thumb_271X209/'.$nameofimage;      
  
        // $exstpath = $rootPath.'/frontend/web/uploads/banner/original/' .$nameofimage;  
        
        // if ($exstpath) 
        // {
        //     Image::getImagine()->open($exstpath)->thumbnail(new Box(271, 209))->save($thumb_271X209 , ['quality' => 90]);           
        // }
                 
        $this->image = $nameofimage;
        return true;

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
