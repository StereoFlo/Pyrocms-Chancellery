<style type="text/css">
.focus {
   border: 2px solid Red;
}
</style>
<script>
$(document).ready(function(){
	$("form").keypress(function(e) {
	  if (e.which == 13) {
	    return false;
	  }
	});
});
        function check(input, ogr) {
            var bla = $('#' + input).val();
            $('#' + input).keyup(function(e){
                if (bla > ogr | e.keyCode == 8) {
                    $('#' + input).addClass("focus");
                    $("#btnSubmit").attr("disabled", "disabled");
                }
                else
                {
                    $('#' + input).removeClass("focus");
                    $("#btnSubmit").removeAttr("disabled");
                }
            });
        } 
</script>
<h2 id="page_title" class="page-title"><?= lang('page:chancellery:index:title');?></h2>
<p><?= lang('page:chancellery:index:message');?>. Ваш лимит на заказ канцелярии: <b><?= $limit; ?></b></p>
	<? if(validation_errors()) { ?>
	<div class="error-box">
		<?= validation_errors();?>
	</div>
	<? } ?>
        <?= form_open('chancellery/order');?>
	<p><?= form_submit(array('value'=> lang('buttons:save'), 'id'=>'btnSubmit')); ?></p>
        <div style="width: 100%;">
            <div style="float: left; width: 40%; font-weight: bold"><?= lang('page:chancellery:index:table:name');?></div>
            <div style="float: left; width: 15%; font-weight: bold"><?= lang('page:chancellery:index:table:count');?></div>
            <div style="float: left; width: 15%; font-weight: bold"><?= lang('page:chancellery:index:table:ed');?></div>
            <div style="float: left; width: 15%; font-weight: bold"><?= lang('page:chancellery:index:table:quote');?></div>
            <div style="float: left; width: 15%; font-weight: bold"><?= lang('page:chancellery:index:table:price');?></div>
            
	    <? foreach ($items as $item) { ?>
	    
		<? if (!empty($ordered_items)) { ?>
		<? foreach ($ordered_items as $ordered_item) { ?>
		<? if ($item->id == $ordered_item->kanz_id) { ?>
		<p>
		<div style="float: left; width: 40%"><?= $item->name; ?></div>
		<div style="float: left; width: 15%"><?= form_input(array('onkeyup'=>"check('input_".$item->id."', ".$item->quote.");", 'id' => "input_".$item->id, 'name' => $item->id, 'size'=>'5', 'value' => $ordered_item->kolvo)); ?></div>
		<div style="float: left; width: 15%"><?= $item->ed; ?></div>
		<div style="float: left; width: 15%" id="quote_<?= $item->quote; ?>"><?= $item->quote; ?></div>
		<div style="float: left; width: 15%" id="price_<?= $item->price; ?>"><?= $item->price; ?></div>
		</p>
		<? } ?>
		<? } ?>
		<? } else { ?>
		<p>
		<div style="float: left; width: 40%"><?= $item->name; ?></div>
		<div style="float: left; width: 15%"><?= form_input(array('onkeyup'=>"check('input_".$item->id."', ".$item->quote.");", 'id' => "input_".$item->id, 'name' => $item->id, 'size'=>'5', 'value' => '')); ?></div>
		<div style="float: left; width: 15%"><?= $item->ed; ?></div>
		<div style="float: left; width: 15%" id="quote_<?= $item->quote; ?>"><?= $item->quote; ?></div>
		<div style="float: left; width: 15%" id="price_<?= $item->price; ?>"><?= $item->price; ?></div>
		</p>
		<? } ?>
	    
	    <? } ?>
        </div>
	<p><?= form_submit(array('value'=> lang('buttons:save'), 'id'=>'btnSubmit')); ?></p>
        <?= form_close(); ?>