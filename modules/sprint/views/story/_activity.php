<?php 
use modules\sprint\models\StoryActive;

/* @var $model \modules\sprint\models\Story */
/* @var $users []|\app\models\User[] */


?>

<?php $activities = StoryActive::find()->orderBy('created_at desc')->where(['story_id'=>$model->id])->all()?>

<br/>
<table class="table table-bordered">
		<tr>
			<th width="100">日期</th>
			<th width="100">人员</th>
			<th>内容</th>
		</tr>
	<?php foreach ($activities as $active) : ?>
	<tr>
			<td><?= date('Y-m-d',$active->created_at)?></td>
			<td><?= $users[ $active->creator_id ] ?></td>
			<td><?= $active->remark?></td>
		</tr>
	<?php endforeach;?>
</table>