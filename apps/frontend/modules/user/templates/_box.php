<?php use_helper('I18N', 'My') ?>

<div class="sidebox">
  <div class="bottom">
  	<div class="content">
  		<?php echo link_to_blind('user_box', image_tag('user.gif')) ?><br />
  	</div>
    <div class="content" id="user_box">
      <br />
      <?php echo __('Welcome') . ' ' . link_to($sf_user->getGuardUser()->getUsername(), 'user/viewProfile?username=' . $sf_user->getGuardUser()->getUsername()) ?>!<br /><br />
      You have <?php echo link_to($user_code_count, 'snippet/listMySnippets') ?> snippet(s).<br /><br />
      You have <?php echo link_to($user_comment_count, 'snippet/list?job=comment') ?> comment(s).<br /><br />
      <?php echo link_to(__('Account settings'), 'user/viewAccount') ?>
    </div>
  </div>
</div>