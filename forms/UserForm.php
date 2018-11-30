<?php
namespace app\forms;

use yii\base\Model;
use yii\web\NotFoundHttpException;
use app\models\User;

/**
 * 添加修改用户的表单
 * @author dungang
 *
 */
class UserForm extends Model
{
    public $id;
    
    public $username;
    
    public $nick_name;
    
    public $password;
    
    public $email;
    
    public $mobile;
    
    public $status;
    
    public $role;
    
    public function rules()
    {
        return [
            [['username','nick_name','email','mobile'], 'required'],
            [['password','role'],'safe'],
            [
                'status',
                'default',
                'value' => User::STATUS_ACTIVE
            ],
            [
                'status',
                'in',
                'range' => [
                    User::STATUS_ACTIVE,
                    User::STATUS_DELETED
                ]
            ]
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '工号',
            'nick_name' => '姓名',
            'status' => '状态',
            'email' => '邮箱',
            'mobile' => '手机',
            'role' => '角色',
            'password'=>'密码',
        ];
    }
    
    /**
     * 加载用户模型的数据
     * @param User $model
     */
    public function loadUser($model) {
        $this->id = $model->id;
        $this->username = $model->username;
        $this->nick_name = $model->nick_name;
        $this->email = $model->email;
        $this->mobile = $model->mobile;
        $this->status = $model->status;
        $this->role = $model->role;
    }
    
    /**
     * 保存
     * @return boolean
     */
    public function save() {
        $user = new User();
        $user->id = $this->id;
        if($user->id) {
            if(!$user = User::findOne(['id'=>$user->id])){
                throw new NotFoundHttpException("用户不存在");
            }
            
        } else {
            $user->generateAuthKey();
        }
        $user->username = $this->username;
        $user->nick_name = $this->nick_name;
        $user->status = $this->status;
        $user->email = $this->email;
        $user->mobile = $this->mobile;
        $user->role = $this->role;
        if($this->password) {
            $user->setPassword($this->password);
        }
        if( $user->save() ) {
            $this->id = $user->id;
            return true;
        } else {
            return false;
        }
    }
}

