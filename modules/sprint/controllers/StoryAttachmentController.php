<?php
namespace modules\sprint\controllers;

use app\controllers\AppController;
use yii\web\UploadedFile;

/**
 *
 * @author dungang
 *        
 */
class StoryAttachmentController extends AppController
{
    

    public function actionIndex()
    {
        if($file = UploadedFile::getInstanceByName('file')) {
            //如果是图片文件生成缩略图(固定：300x200)
            if($this->isImage($file)){
                //$file->saveAs($file);
            }
        }
    }
    
    
    protected function thumbnail($file) {
        
    }

    /**
     *
     * @param UploadedFile $file
     * @return boolean
     */
    protected function isImage($file)
    {
        return \in_array($file->extension, [
            'jpg',
            'png',
            'jpeg'
        ]);
    }
}

