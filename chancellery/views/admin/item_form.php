<section class="title">
	<h4><?= lang('page:admin_items:item_form:title');?></h4>
</section>

<section class="item">
<?php echo form_open('admin/chancellery/items/save');?>
<table style="width: 450px; border: 1px solid #eee;">
	<tr>
		<td><?= lang('page:admin_items:items:table:name');?>:</td>
		<td><?= form_input('name', (isset($item[0]->name)) ? $item[0]->name : "");?></td>
	</tr>
	<tr>
		<td><?= lang('page:admin_items:items:table:quote');?>:</td>
		<td><?= form_input('quote', (isset($item[0]->quote)) ? $item[0]->quote : "");?></td>
	</tr>
	<tr>
		<td><?= lang('page:admin_items:items:table:price');?></td>
		<td><?= form_input('price', (isset($item[0]->price)) ? $item[0]->price : "");?></td>
	</tr>
	<tr>
		<td><?= lang('page:admin_items:items:table:ed');?></td>
		<td><?= form_input('ed', (isset($item[0]->ed)) ? $item[0]->ed : "");?></td>
	</tr>
    	<tr>
            <td><?= lang('page:admin_items:items:table:contractor');?></td>
		<? $data = array('' => lang('buttons:dropdown')); foreach ($contractors as $row) { $data[$row->id] = $row->name; } ?>
		<td><?= form_dropdown('contractor', $data, (isset($item[0]->contractor) ? $item[0]->contractor : '')); ?></td>
	</tr>
	<tr>
		<td><?= lang('page:admin_items:items:table:period');?></td>
		<td><?= form_input('period', (isset($item[0]->period)) ? $item[0]->period : "");?></td>
	</tr>
	<tr>
		<td><?= lang('page:admin_items:items:table:kod1');?></td>
		<td><?= form_input('kod1', (isset($item[0]->kod1)) ? $item[0]->kod1 : "");?></td>
	</tr>
	<tr>
		<td><?= lang('page:admin_items:items:table:kod2');?></td>
		<td><?= form_input('kod2', (isset($item[0]->kod2)) ? $item[0]->kod2 : "");?></td>
	</tr>
	<tr>
		<td colspan="2">
			<button class="btn blue" value="save" name="btnAction" type="submit"><span><?= lang('buttons:save');?></span></button>
				&nbsp;&nbsp;
			<a class="btn-more" href="/admin/chancellery/items/"><?= lang('buttons:cancel');?></a>
		</td>
	</tr>
</table>
</section>

<?php 
 if(isset($item[0]->id)){
?>
<input type="hidden" name="id" value="<?= $item[0]->id; ?>">
<?php } ?>

<?= form_close(); ?>