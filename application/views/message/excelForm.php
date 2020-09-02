
	<div class="row">

		<div class="col-md-12">

			<?php
			if($this->session->flashdata('success_msg')){
				?>
				<div class="alert alert-success alert-dismissable" id="successMessage">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
					<strong>Success!</strong> <?php echo $this->session->flashdata('success_msg');?>
				</div>

				<?php
			}
			?>
			<?php

			if($this->session->flashdata('error_msg')){
				?>
				<div class="alert alert-danger alert-dismissable" id="failedMessage">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
					<strong>Error!</strong> <?php echo $this->session->flashdata('error_msg');?>
				</div>

				<?php
			}
			?>

			<div class="portlet box blue ">

                <div class="portlet-title">
					<div class="caption">
						Excel Upload
					</div>

                </div>
                <div class="portlet-body default form portlet-empty grey-cararra">
					<form role="form" class="" action="<?php echo base_url('SendSMS/smsExcelStore');?>" method="post" enctype="multipart/form-data">
						<div class="form-body">

							<div class="form-group" style="display: inline-block;">
								<label for="exampleInputFile1">File input</label>
								<input type="file" name="excelFile" id="exampleInputFile1">
								<input type="hidden" value="<?php echo $userArray['id'] ;?>" name="userId">
								<input type="hidden" value="<?php echo $userArray['username'] ;?>" name="userName">

								<?php if(isset($upload_error)) echo '<span style="color: #ff0000;">'.$upload_error.'<span/>';

								?>
							</div>

							<div class="form-group" style="display: inline-block;" >
								<a href="<?php echo base_url('ExcelFiles/downloadSampleExcel');?>" class="icon-btn" style="height: 80px; width: 90px; border:1px solid green;">

									<img src="<?php echo base_url('assets/images/excel_download.png');?>"  style="width: 60px; height: 60px;">

								</a>

							</div>
							<a href="<?php echo base_url('ExcelFiles/downloadSampleExcel');?>">
								<p style="display: inline-block;">Download Sample Excel File</p>
							</a>



							<div class="form-group">

									<button type="submit" class="btn blue">Submit Excel</button>

							</div>
						</div>

					</form>

				</div>

				</div>
			</div>

	</div>
	
	<div class="row">

			<div class="col-md-12">
				<div class="portlet box blue ">
					<div class="portlet-title">
						<div class="caption">
							Send SMS From Text File
						</div>
					</div>
					<div class="portlet-body  grey-cararra">
						<form action="<?php echo base_url('SendSMS/smsFromTextStore');?>" method="POST" class="form-horizontal" enctype="multipart/form-data" role="form">

							<input type="hidden" value="<?php echo $userArray['id'] ;?>" name="userId">
							<input type="hidden" value="<?php echo $userArray['username'] ;?>" name="userName">

							<div class="form-group">
								<label class="col-md-2 control-label">Mask</label>
								<div class="col-md-4">
									<select name="mask" class="form-control">
										<!--									<option value="0">[-- Select One --]</option>-->
										<?php
										foreach($maskArray as $mask)
										{
											?>

											<option  value="<?php echo $mask['mask_text'];?>"><?php echo $mask['mask_text'];?></option>

											<?php
										}
										?>
									</select>
								</div>

							</div>

							<div class="form-group">
								<label class="col-md-2 control-label">Textarea</label>
								<div class="col-md-4">
									<textarea name="message" id="textarea" class="form-control" rows="5"></textarea>
								</div>

								<?php echo form_error('message',"<p class='text-danger'>","</p>");?>

								<div class="col-md-4">
									<div id="textarea_feedback"></div>
									<div id="textarea_given"></div>
									<div id="smsCount"></div>
								</div>

							</div>

							<div class="form-group form-md-line-input">
								<label class="col-md-2 control-label" for="form_control_1" style="color:#000;"></label>
								<div class="col-md-10">
									<div class="md-checkbox-list">
										<div class="md-checkbox" id="uniform-inlineCheckbox21">
											<input type="checkbox" id="scheduleSMS" class="md-check">
											<label for="scheduleSMS">
												<span></span>
												<span class="check"></span>
												<span class="box"></span> Schedule SMS </label>
										</div>
									</div>
								</div>
							</div>

							<div hidden class="form-group scheduleSMSdiv" id="scheduleSMSdiv">
								<label class="control-label col-md-2">Select Date</label>
								<div class="col-md-4">
									<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
										<input name="scheduleDate" type="text" class="form-control" readonly="">
											<span class="input-group-btn">
												<button class="btn default" type="button">
													<i class="fa fa-calendar"></i>
												</button>
											</span>
									</div>

								</div>
							</div>

							<div hidden class="form-group scheduleSMSdiv">
								<label class="control-label col-md-2">Select Time</label>
								<div class="col-md-4">
									<div class="input-icon">
										<i class="fa fa-clock-o"></i>
										<input name="scheduleTime" type="text" class="form-control timepicker timepicker-default"> </div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2" for="exampleInputFile1">File input</label>
								<div class="col-md-4">
									<input type="file" name="textFile" id="exampleInputFile1">
								</div>


								<?php if(isset($upload_error)) echo '<span style="color: #ff0000;">'.$upload_error.'<span/>';

								?>
							</div>
							<div class="form-group">
								<div class="col-md-4 col-md-offset-2">
									<a href="<?php echo base_url('ExcelFiles/downloadSampleTextFile');?>">Download Sample File</a>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-offset-2 col-md-10">
									<button type="submit" class="btn blue">Send SMS</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
	</div>

	<div class="row">

			<div class="col-md-12">
				<div class="portlet box blue ">
					<div class="portlet-title">
						<div class="caption">
							Send Single SMS
						</div>
					</div>
					<div class="portlet-body  grey-cararra">
						<form action="<?php echo base_url('SendSMS/smsStore/').$userArray['id'];?>" method="POST" class="form-horizontal" role="form">
							<div class="form-group">
								<label  class="col-md-2 control-label">Mobile Number</label>
								<div class="col-md-4">
									<input name="contact" value="<?php echo set_value('contact');?>"  type="text" class="form-control" id="inputEmail1" placeholder="Mobile Number">
								</div>
								<?php echo form_error('contact',"<p class='text-danger'>","</p>");?>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label">Mask</label>
								<div class="col-md-4">
									<select name="mask" class="form-control">
										<!--									<option value="0">[-- Select One --]</option>-->
										<?php
										foreach($maskArray as $mask)
										{
											?>

											<option  value="<?php echo $mask['mask_text'];?>"><?php echo $mask['mask_text'];?></option>

											<?php
										}
										?>
									</select>
								</div>

							</div>

							<div class="form-group">
								<label class="col-md-2 control-label">Textarea</label>
								<div class="col-md-4">
									<textarea name="message" id="textarea" class="form-control" rows="5"></textarea>
								</div>

								<?php echo form_error('message',"<p class='text-danger'>","</p>");?>

								<div class="col-md-4">
									<div id="textarea_feedback"></div>
									<div id="textarea_given"></div>
									<div id="smsCount"></div>
								</div>

							</div>

							<div class="form-group form-md-line-input">
								<label class="col-md-2 control-label" for="form_control_1" style="color:#000;"></label>
								<div class="col-md-10">
									<div class="md-checkbox-list">
										<div class="md-checkbox" id="uniform-inlineCheckbox21">
											<input type="checkbox" id="scheduleSMS" class="md-check">
											<label for="scheduleSMS">
												<span></span>
												<span class="check"></span>
												<span class="box"></span> Schedule SMS </label>
										</div>
									</div>
								</div>
							</div>

							<div hidden class="form-group scheduleSMSdiv" id="scheduleSMSdiv">
								<label class="control-label col-md-3">Select Date</label>
								<div class="col-md-3">
									<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
										<input name="scheduleDate" type="text" class="form-control" readonly="">
											<span class="input-group-btn">
												<button class="btn default" type="button">
													<i class="fa fa-calendar"></i>
												</button>
											</span>
									</div>

								</div>
							</div>

							<div hidden class="form-group scheduleSMSdiv">
								<label class="control-label col-md-3">Select Time</label>
								<div class="col-md-3">
									<div class="input-icon">
										<i class="fa fa-clock-o"></i>
										<input name="scheduleTime" type="text" class="form-control timepicker timepicker-default"> </div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-offset-2 col-md-10">
									<button type="submit" class="btn blue">Send SMS</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
	</div>


<script language="JavaScript">

	function isDoubleByte(str) {
		for (var i = 0, n = str.length; i < n; i++) {
			if (str.charCodeAt( i ) > 255) { return true; }
		}
		return false;
	}

	jQuery(document).ready(function()
	{
		App.initAjax();

		$("#scheduleSMS").click(function() {
			$( ".scheduleSMSdiv" ).toggle("slow");
		});

		var text_max = 750;
		var singleSMSCount = 160;
		var text_given = 0;
		var totalCount = 0;
		var incrimentCount =1;
		var myCount = 0;
		var mySMSCount = 0;
		var ifUnicode = false;
		var myCharCount = 0;
		var charCountedMsg = 'characters couinted';

		$('#textarea_feedback').html(text_max + ' characters remaining');
		$('#textarea_given').html(text_given + ' characters couinted');
		$('#smsCount').html(totalCount + ' SMS will be sent');

		$('#textarea').keyup(function()
		{
			var  myText = $("#textarea").val();
			//var myEncodedText = encodeURI(myText);
			//alert("myText : "+myText + "     ||  " + "myEncodedText   : " + myEncodedText );
			if (isDoubleByte(myText))
			{
				//alert("Unicode!!!!");
				incrimentCount = 2;
				singleSMSCount = 150;
				ifUnicode = true;
				myCharCount = myText.length * 2;
				charCountedMsg = 'characters couinted (unicode)'
			}
			else
			{
				myCharCount = myText.length;
				if(myCharCount <= 160) {
					singleSMSCount = 160;
				}
				charCountedMsg = 'characters couinted (ASCI)';
			}

			//alert("myCharCount : "+ myCharCount  + "     singleSMSCount " +singleSMSCount);
			if(myCharCount > singleSMSCount)
			{
				singleSMSCount = 150;

			}



			mySMSCount = Math.ceil( myCharCount / singleSMSCount );  //multiphone sms will count as 150


			var text_remaining = text_max - myCharCount;
			var text_given = text_max - myCharCount;



			$('#textarea_feedback').html(text_remaining + ' characters remaining');
			// $('#textarea_given').html(character + ' characters given');
			$('#textarea_given').html(myCharCount + ' ' +charCountedMsg);
			$('#smsCount').html(mySMSCount + ' SMS will be sent');
		});
	});
</script>
