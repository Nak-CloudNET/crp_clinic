<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('add_customer'); ?></h4>
        </div>
        <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'add-customer-form');
		if($sale){
        echo form_open_multipart("customers/add/".$sale, $attrib);

		}else{
			echo form_open_multipart("customers/add", $attrib);

		}		?>
        <div class="modal-body">
            <p><?= lang('enter_info'); ?></p>

            <div class="form-group">
                <label class="control-label"
                       for="customer_group"><?php echo $this->lang->line("default_customer_group"); ?></label>

                <div class="controls"> <?php
                    foreach ($customer_groups as $customer_group) {
                        $cgs[$customer_group->id] = $customer_group->name;
                    }
                    echo form_dropdown('customer_group', $cgs, $this->Settings->customer_group, 'class="form-control tip select" id="customer_group" style="width:100%;" required="required"');
                    ?>
                </div>
            </div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label"
							   for="price_group"><?php echo $this->lang->line("price_groups"); ?></label>

						<div class="controls"> <?php
							$pr_group[''] = 'No Price Group';
							foreach ($price_groups as $price_group) {
								$pr_group[$price_group->id] = $price_group->name;
							}
							echo form_dropdown('price_group', $pr_group, '', 'class="form-control tip select" id="price_groups" style="width:100%;" placeholder="Select Price Group" ');
							?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group person">
                        <?= lang("age", "age"); ?>
                        <?php echo form_input('age', '', 'class="form-control tip" id="age"'); ?>
                    </div>
				</div>
			</div>

            <div class="row">
                <div class="col-md-6">
					<div class="form-group">
                        <?= lang("date", "date"); ?>
                        <?php echo form_input('start_date', '', 'class="form-control tip date" id="sldate" data-bv-notempty="true"'); ?>
                    </div>
					<?php if($setting->show_company_code == 1) { ?>
					<div class="form-group">
                        <?= lang("code", "code"); ?>
                        <?php
                            if (!empty($Settings->customer_code_prefix)) {
                                $reference = $reference;
                            } else {
                                $reference = substr($reference, 5);
                            }
                        ?>
                        <?php echo form_input('code', $reference ? $reference : "",'class="form-control input-tip" id="code" data-bv-notempty="true"'); ?>
                    </div>
					<?php } ?>					
                    <div class="form-group">
                        <?= lang("name", "name"); ?>
                        <?php echo form_input('name', '', 'class="form-control tip" id="name" data-bv-notempty="true" required="required"'); ?>
                    </div>
					<div class="form-group">
                        <?= lang("phone", "phone"); ?>
						<?php echo form_input('phone', '', 'class="form-control" id="phone" type="tel"'); ?>
                    </div>
                    <div class="form-group">
                        <?= lang("address", "address"); ?> <span style="float:right;"><button class="btn btn-sm btn-primary add_more">Add More</button></span>
                        <?php echo form_input('address', '', 'class="form-control" id="address"'); ?>
                    </div>				
                    
					<div id="address_show" style="display:none;">
						<div class="form-group">
							<?= lang("address1", "address1"); ?> 
							<?php echo form_input('address1', '', 'class="form-control" id="address1" '); ?>
						</div>
						<div class="form-group">
							<?= lang("address2", "address2"); ?> 
							<?php echo form_input('address2', '', 'class="form-control" id="address2" '); ?>
						</div>
						<div class="form-group">
							<?= lang("address3", "address3"); ?> 
							<?php echo form_input('address3', '', 'class="form-control" id="address3" '); ?>
						</div>
						<div class="form-group">
							<?= lang("address4", "address4"); ?> 
							<?php echo form_input('address4', '', 'class="form-control" id="address4" '); ?>
						</div>
						<div class="form-group">
							<?= lang("address5", "address5"); ?> 
							<?php echo form_input('address5', '', 'class="form-control" id="address5" '); ?>
						</div>
					</div>			
                </div>
                <div class="col-md-6">
                    <div class="form-group" id ="gender_fg">
                        <?= lang("gender", "gender"); ?>
                        <?php
                        $gender[""] = "";
                        $gender['male'] = "Male";
                        $gender['female'] = "Female";
                        echo form_dropdown('gender', $gender, isset($customer->gender)?$customer->gender:'', 'class="form-control select" id="gender" placeholder="' . lang("select") . ' ' . lang("gender") . '" required="required" style="width:100%"')
                        ?>
                    </div>
				
                    <div class="form-group">
                        <?= lang("attachment", "cf4"); ?><input id="attachment" type="file" name="userfile[]" multiple data-show-upload="true" data-show-upload="true" data-show-preview="true"
                       class="file">

                    </div>
               
					<div class="form-group">
                        <?= lang("note", "note"); ?>
                        <?php echo form_textarea('note', '', 'class="form-control skip" id="note" style="height:115px;"'); ?>
                    </div>
                </div>
            </div>


        </div>
        <div class="modal-footer">
            <?php echo form_submit('add_customer', lang('add_customer'), 'class="btn btn-primary add_customer" id="addCustomer"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<?= $modal_js ?>
<script type="text/javascript">
$(document).ready(function(){
	$.fn.datetimepicker.dates['erp'] = <?=$dp_lang?>;
	$("#sldate").datetimepicker({
		format: site.dateFormats.js_ldate,
		fontAwesome: true,
		language: 'erp',
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0
	}).datetimepicker('update', new Date());
	$('body').on('click', '.add_more', function(e) {
		  e.preventDefault();
		$("#address_show").toggle();
	});
	$(".add_customer").click(function () {
		var gender = $("#gender");
		if (gender.val() == null || gender.val() == '') {
			$('#gender_fg').css('color', 'rgb(174, 13, 13)');
			return false;
		}

		return true;

	});
});
</script>