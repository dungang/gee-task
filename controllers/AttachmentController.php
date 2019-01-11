<?php
namespace app\controllers;

use app\core\BaseController;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

class AttachmentController extends BaseController
{

    public function init()
    {
        parent::init();
        $this->userActions = [
            'wang-editor'
        ];
        $this->verbsActions = [
            'wang-editor' => [
                'post'
            ]
        ];
    }

    /**
     * Wang Editor image uploader
     *
     * @return \yii\web\Response
     */
    public function actionWangEditor()
    {
        try {
            return $this->asJson([
                'errno' => 0,
                'data' => [
                    $this->saveAttachment('image', 'file')
                ]
            ]);
        } catch (\Exception $e) {
            return $this->asJson([
                'errno' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }
    
    protected function saveAttachment($fileType = 'image', $fileField = 'file')
    {
        $file = UploadedFile::getInstanceByName($fileField);
        $dir = 'uploader/' . $fileType . '/' . Date('Y/m-d/');
        $url = $dir . uniqid($fileType, true) . '.' . $file->extension;
        $webroot = \Yii::getAlias("@webroot");
        $path = $webroot . '/' . $dir;
        if (! is_dir($path)) {
            FileHelper::createDirectory($path);
        }
        $file->saveAs($webroot . '/' . $url);
        return $url;
    }
}

