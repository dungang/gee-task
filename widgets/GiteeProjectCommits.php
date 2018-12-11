<?php
namespace app\widgets;

use yii\base\Widget;
use yii\httpclient\Client;
use yii\helpers\Json;

class GiteeProjectCommits extends Widget
{
    public function run(){
        
        $client  = new Client();
        $resp = $client->get("https://gitee.com/dungang/gee-task/graph/master.json")->send();
        if($resp->isOk) {
            $data = Json::decode($resp->content);
            $commits = $data['commits'];
            $html = "<table class='table table-bordered'>";
            $i = 0;
            foreach ($commits as $comment){
                $html .="<tr><td width='100'>" . date('Y-m-d',strtotime($comment['date'])) . "</td><td>" . $comment['message'] . "</td></tr>";
                if($i >= 9) {
                    break;
                }
                $i++;
            }
            $html .= "</table>";
            return $html;
        }
        return '';
    }
}

