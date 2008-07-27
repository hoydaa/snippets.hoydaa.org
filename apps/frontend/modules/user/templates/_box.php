<?php use_helper('I18N', 'My') ?>

<div class="sidebox">
  <div class="bottom">
    <div class="content">
      <?php echo toggle('user-hide', 'user-up', 'user-down',
              $sf_user->getPreference('box_user') == 'none' ? 'down' : 'up',
              remote_function(array('url' => "@set_preference?pname=box_user", 'with' => "&quot;pvalue=&quot; + $('user-up').style.display"))); ?>
      <?php echo image_tag('user.gif') ?>
      <div id="user-hide"<?php echo $sf_user->getPreference('box_user') == 'none' ? " style=display:none;" : "" ?>>
        <?php echo __('Welcome') . ' ' . link_to($sf_user->getGuardUser()->getUsername(), 'user/viewProfile?username=' . $sf_user->getGuardUser()->getUsername()) ?>!<br /><br />
        You have <?php echo link_to($user_code_count, 'snippet/listMySnippets') ?> snippet(s).<br /><br />
        You have <?php echo link_to($user_comment_count, 'comment/listMine') ?> comment(s).<br /><br />
        <?php echo link_to(__('Account settings'), 'user/viewAccount') ?>
      </div>
    </div>
  </div>
</div>