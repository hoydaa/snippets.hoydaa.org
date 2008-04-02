<div id="pager">
<?php use_helper('sfLucene', 'I18N') ?>

<table class="datatable">
	<caption><?php echo __('Search Results') ?></caption>
	<thead>
		<tr>
			<th><?php echo __('Relevance') ?></th>
			<th><?php echo __('Title') ?></th>
			<th><?php echo __('Description') ?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($pager->getResults() as $result): ?>
			<?php include_search_result($result, $query) ?>
		<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4">
<?php include_search_pager($pager, sfConfig::get('app_lucene_pager_radius')) ?>

<?php //include_search_controls($query) ?>
			    <?php //echo pager_navigation($codePager, 'code/list') ?>&nbsp;
			</td>
		</tr>
	</tfoot>
</table>
</div>