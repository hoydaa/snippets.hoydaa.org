<?php use_helper('Date') ?>

<div class="related">
    <span class="title">
    	Comments for <?php echo $code->getTitle() ?>
    </span>
    <div class="comment-list">
        <?php foreach($code->getComments() as $comment): ?>
    		<div class="comment">
    			<div class="comment-info">
    			    <?php echo $comment->getTitle() . ' by ' .
    				    ($comment->getSfGuardUser() ? $comment->getSfGuardUser()->getProfile()->getFullName() : $comment->getName()) . ' at ' . 
    					format_datetime($comment->getCreatedAt()) ?>
    			</div>
    			<div class="comment-comment">
    				<?php echo $comment->getCommentHtmlized() ?>
    			</div>
    		</div>
        <?php endforeach; ?>
    </div>
</div>