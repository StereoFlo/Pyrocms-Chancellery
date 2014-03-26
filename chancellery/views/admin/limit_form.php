<section class="title">
	<h4><?= lang('page:admin_users:users_form:title');?>: <?= $display_name?></h4>
</section>

<section class="item">
<?php echo form_open('admin/chancellery/limit/save');?>
<table style="width: 450px; border: 1px solid #eee;">
	<tr>
		<td><?= lang('page:admin_limit:limit:table:limit');?>:</td>
		<td><?= form_input('limit', (isset($limit[0]->limit)) ? $limit[0]->limit : "");?></td>
	</tr>
	<tr>
		<td colspan="2">
			<button class="btn blue" value="save" name="btnAction" type="submit"><span><?= lang('buttons:save');?></span></button>
				&nbsp;&nbsp;
			<a class="btn-more" href="/admin/chancellery/limit/"><?= lang('buttons:cancel');?></a>
		</td>
	</tr>
</table>
<input type="hidden" name="user" value="<?= isset($codes[0]->user) ? $codes[0]->user : $active_id; ?>">

<?= form_close(); ?>
</section>