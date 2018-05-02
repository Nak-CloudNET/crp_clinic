<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('edit_customer'); ?></h4>
        </div>
        <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form');
        echo form_open_multipart("customers/edit/" . $customer->id, $attrib); ?>
        <div class="modal-body">
            <p><?= lang('enter_info'); ?></p>

            <div class="form-group">
                <label class="control-label"
                       for="customer_group"><?php echo $this->lang->line("default_customer_group"); ?></label>

                <div class="controls"> <?php
                    foreach ($customer_groups as $customer_group) {
                        $cgs[$customer_group->id] = $customer_group->name;
                    }
                    echo form_dropdown('customer_group', $cgs, $customer->customer_group_id, 'class="form-control tip select" id="customer_group" style="width:100%;" required="required"');
                    ?>
                </div>
            </div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label"
							   for="price_group"><?php echo $this->lang->line("price_groups"); ?></label>

						<div class="controls"> <?php
							$pr_group[""] = "No Price Group";
							foreach ($price_groups as $price_group) {
								$pr_group[$price_group->id] = $price_group->name;
							}
							echo form_dropdown('price_groups', $pr_group, $customer->price_group_id, 'class="form-control tip select" id="price_groups" style="width:100%;" placeholder="' . lang("select") . ' ' . lang("price_groups") . '" ');
							?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group person">
                        <?= lang("age", "age"); ?>
                        <?php echo form_input('age', $customer->age, 'class="form-control tip" id="age"'); ?>
                    </div>
				</div>
			</div>
            <div class="row">
                <div class="col-md-6">
					<div class="form-group">
                        <?= lang("date", "date"); ?>
                        <?php echo form_input('start_date', $this->erp->hrld($customer->start_date), 'class="form-control tip datetime" id="sldate" data-bv-notempty="true"'); ?>
                    </div>
					<?php if($setting->show_company_code == 1) { ?>
					<div class="form-group">
                        <?= lang("code", "code"); ?>
                        <?php echo form_input('code', $customer->code, 'class="form-control tip" id="code"  data-bv-notempty="true"'); ?>
                    </div>
					<?php } ?>
                    <div class="form-group person">
                        <?= lang("name", "name"); ?>
                        <?php echo form_input('name', $customer->name, 'class="form-control tip" id="name" required="required"'); ?>
                    </div>
				
                    <div class="form-group">
                        <?= lang("phone", "phone"); ?>
                        <input type="tel" name="phone" class="form-control" id="phone"
                               value="<?= $customer->phone ?>" />
                    </div>
                    <div class="form-group">
                        <?= lang("address", "address"); ?> 
                        <?php echo form_input('address', $customer->address, 'class="form-control" id="address"'); ?>
                    </div>                
                </div>
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <?= lang("gender", "gender"); ?>
                        <?php
                        $gender[""] = "Select Gender";
                        $gender['male'] = "Male";
                        $gender['female'] = "Female";
                        echo form_dropdown('gender', $gender, $customer->gender, 'class="form-control select" id="gender" placeholder="' . lang("select") . ' ' . lang("gender") . '" style="width:100%"')
                        ?>
                    </div>
					<div class="form-group">
                        <?= lang("attachment", "cf4"); ?><input id="attachment" type="file" name="userfile[]" multiple data-show-upload="true" data-show-upload="true" data-show-preview="true"
                       class="file"
                       class="file">
                    </div>
                    
					<div class="form-group">
                        <?= lang("note", "note"); ?>
                        <?php echo form_textarea('note', $customer->invoice_footer, 'class="form-control skip" id="note" style="height:115px;"'); ?>
                    </div>
                </div> 
            </div>
            

        </div>
        <div class="modal-footer">
            <?php echo form_submit('edit_customer', lang('edit_customer'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<?= $modal_js ?>
<script type="text/javascript" charset="UTF-8">
    $(document).ready(function () {
        $.fn.datetimepicker.dates['erp'] = <?=$dp_lang?>;
		/*$("#sldate").datetimepicker({
			format: site.dateFormats.js_ldate,
			fontAwesome: true,
			language: 'erp',
			weekStart: 1,
			todayBtn: 1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0
		}).datetimepicker('update', new Date());*/
		
		$("#credit_limit").live('change',function(){
			var credit_limit = $(this).val()-0;
			if(isNaN(credit_limit)){
				$(this).val(0);
				return false;
			}
		});
		$("#group_area").live('change',function(){
			var group_area = $(this).val();
			var option = '';
			if(group_area!=''){
				$.ajax({
					type:"get",
					async:false,
					url: "<?= site_url('customers/get_sale_areas'); ?>",
					dataType: "json",
					data:{
						group_area:group_area
					},
					success:function(re){
						for(var i=0; i<re.length; i++){
							option +='<option value="'+re[i].areacode+'">'+re[i].areadescription+'</option>';
						}
					}
				});
				$('#sale_area').html(option);
				$('#sale_area').change();
				$('#sale_area_box').css("display","block");
			}else{
				$('#sale_area').html(option);
				$('#sale_area').change();
				$('#sale_area_box').css("display","none");
			}
		});
    });
</script>

