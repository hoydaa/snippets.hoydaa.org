<div id="pager">
<?php use_helper('PagerNavigation', 'I18N') ?>

<table class="datatable">
	<caption><?php echo __('Code Snippet List') ?></caption>
	<thead>
		<tr>
			<th><?php echo __('Title') ?></th>
			<th><?php echo __('Description') ?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($codePager->getResults() as $code): ?>
			<tr>
				<td><?php echo link_to($code->getTitle(), 'code/show?id=' . $code->getId()); ?>&nbsp;</td>
				<td><?php echo $code->getDescription() ?>&nbsp;</td>
				<td>
					<?php if($sf_user->isAuthenticated() && $code->getSfGuardUserId() == $sf_user->getId()): ?>
				        <?php echo link_to(__('Edit'), 'code/edit?id=' . $code->getId()) ?>
				    <?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4">
			    <?php echo pager_navigation($codePager, 'code/list') ?>&nbsp;
			</td>
		</tr>
	</tfoot>
</table>
</div>