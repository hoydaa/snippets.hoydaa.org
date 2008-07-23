<?php if($sf_user->isAuthenticated()): ?>
<li id="pvalue_1">
    <div id="sidebar-user">
        <?php include_component('user', 'box') ?>
    </div>
    <br />
</li>
<?php endif; ?>