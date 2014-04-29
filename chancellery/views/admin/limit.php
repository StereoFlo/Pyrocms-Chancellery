<section class="title">
	<h4><?= lang('page:admin_limit:limit:title');?></h4>
</section>
<section class="item">
<div>
	<form action="/admin/chancellery/limit/index" method="get" accept-charset="utf-8">
		<input style="width: 80%" type="text" name="q" value="" placeholder="Enter a word"  />
		<button style="width: 18%" type="submit" class="btn blue"><span>Search</span></button>
	</form>
</div>
<? if (!empty($users)) { ?>
<div id="filter-stage">
			<table border="0" class="table-list">
				<thead>
					<tr>
						<th><?= lang('page:admin_users:users:table:login');?></th>
                                                <th><?= lang('page:admin_users:users:table:name');?></th>
                                                <th><?= lang('page:admin_users:users:table:limit');?></th>
                                                <th><?= lang('page:admin_users:users:table:manage');?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="8">
							<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
						</td>
					</tr>
				</tfoot>
				<tbody>
					<?php foreach ($users as $user): ?>
						<tr id="<?= $user->id?>">
							<td class="collapse">
								<?= $user->username; ?>
							</td>
                            <td class="collapse">
                            	<?= user_displayname($user->id, $linked = FALSE); ?>
                            </td>
							<td class="collapse">
								<? foreach ($limit as $limits) { ?>
								<? if ($limits->user == $user->id) { ?>
								<?= $limits->limit; ?>
								<? } ?>
								<? } ?>
							</td>
							<td class="actions">
								<?php echo anchor('admin/chancellery/limit/edit/' . $user->id, lang('global:edit'), array('class'=>'button edit')); ?>
                                                                <?php echo anchor('admin/chancellery/limit/delete/' . $user->id, lang('global:delete'), array('class'=>'button delete')); ?>
							</td>
							</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
</div>
<? } else { ?>
    <div class="no_data"><?= lang('page:admin_users:users:messages:no_users');?></div>
<? } ?>

</section>