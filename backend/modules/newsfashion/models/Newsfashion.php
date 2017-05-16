<?php

namespace backend\modules\newsfashion\models;

use Yii;
use backend\modules\adminsubadmin\models\Admin;

use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

/**
 * This is the model class for table "tbl_news_fashion".
 *
 * @property integer $id
 * @property string $nf_title
 * @property string $nf_image
 * @property string $nf_text
 * @property integer $is_activated
 * @property integer $is_deleted
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_date
 * @property string $updated_date
 */
class Newsfashion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_news_fashion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['nf_title', 'nf_image', 'nf_text', 'is_activated'], 'required', 'on'=> 'backend_create_newsfashion'],
            [['nf_title', 'nf_text', 'is_activated'], 'required', 'on'=> 'backend_update_newsfashion'],

            [['nf_image', 'nf_text'], 'string'],
            [['is_activated', 'is_deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['nf_title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nf_title' => Yii::t('app', 'News Fashion Title'),
            'nf_image' => Yii::t('app', 'News Fashion Image'),
            'nf_text' => Yii::t('app', 'News Fashion Details'),
            'is_activated' => Yii::t('app', 'Is Activated'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }

     public function uploadImage()
    {            
        $this->nf_image = UploadedFile::getInstance($this, 'nf_image');

        $nameofimage = 'newsfashion_'.time().'.'.$this->nf_image->extension; 
        $rootPath = Yii::getAlias('@rootPath');
        $pathofimage = $rootPath.'/backend/web/uploads/newsfashion/original/' .$nameofimage;    
        $this->nf_image->saveAs($pathofimage); 
         
        // $thumb_271X209 = $rootPath.'/frontend/web/uploads/banner/thumb_271X209/'.$nameofimage;      
  
        // $exstpath = $rootPath.'/frontend/web/uploads/banner/original/' .$nameofimage;  
        
        // if ($exstpath) 
        // {
        //     Image::getImagine()->open($exstpath)->thumbnail(new Box(271, 209))->save($thumb_271X209 , ['quality' => 90]);           
        // }
                 
        $this->nf_image = $nameofimage;
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
