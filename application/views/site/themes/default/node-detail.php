<h3><?=$node->title?></h3>
<?php if(isset($node->terms["cat"]) && !empty($node->terms["cat"])){?>
<?php $curr_cat=current($node->terms["cat"]);?>
<i class="icon-briefcase"></i> <a href="/term/<?=$curr_cat->type?>/<?=$curr_cat->alias?>"><?=$curr_cat->title?></a>
<?php }?>
<p><?=$node->body?></p>
<div>
	<?php if(isset($node->terms["tags"]) && !empty($node->terms["tags"])){?>
	<i class="icon-tag"></i> 
		<?php 
				$tagsArr=array();
				foreach ($node->terms["tags"] as $tag)$tagsArr[]='<a href="/term/'.$tag->type.'/'.$tag->alias.'">'.$tag->title.'</a>';
			?>
		<?=implode(', ', $tagsArr); ?>
	<?php }?>
</div>
<div class="span5 well" style="margin-top:10px; margin-left:0px; min-height:10px; padding:5px;">
	<small class="muted"><?=$node->add_date?></small>
</div>