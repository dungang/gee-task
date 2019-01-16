<?php 
use modules\sprint\models\StoryAcceptance;

/* @var $model \modules\sprint\models\Story */
?>
<?php $acceptances = StoryAcceptance::find()->where([ 'story_id' => $model->id ])->all(); ?>
<br/>
<table class="table table-bordered">
<?php foreach ($acceptances as $index => $acceptance): ?> 
	<tr><td width="40">#<?=$index+1 ?><td><?=$acceptance->acceptance?></td></tr>
<?php endforeach;?>
</table>