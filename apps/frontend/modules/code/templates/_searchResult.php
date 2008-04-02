			<tr>
				<td width="60px"><?php echo $result->getScore() ?>%</td>
				<td><?php echo link_to($result->getTitle(), 'code/show?id=' . $result->getId()); ?>&nbsp;</td>
				<td><?php echo $result->getDescription() ?>&nbsp;</td>
				<td>
					<?php if($sf_user->isAuthenticated() && $result->getId() == $sf_user->getId()): ?>
				        <?php echo link_to(__('Edit'), 'code/edit?id=' . $result->getId()) ?>
				    <?php endif; ?>
				</td>
			</tr>