
<script type="text/javascript">
$(document).ready(function() {
  $("#success-alert").hide();
  $("#failed-alert").hide();


	<?php if($this->session->flashdata('success')){?>
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });
	<?php }?>
	<?php if($this->session->flashdata('failed')){?>
        $("#failed-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#failed-alert").slideUp(500);
        });
	<?php }?>
});
</script>
<div class="container">
<?php $this->load->helper('form'); ?>
    <div class="row heading-row">
		<div class="col-sm-10 text-center mx-auto mt-5">
		    <div class="alert alert-success" id="success-alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>Successfully Submitted. </strong>
            </div>
			<div class="alert alert-danger" id="failed-alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>Record Not Found! </strong>
            </div>
			<h2 style='font-family: "Cooper Black", serif;color:#002060;'>RECORD MANAGEMENT SYSTEM</h2>
		</div>
	</div>
	<form method="post" class="row g-3 needs-validation" novalidate action="<?php echo base_url("student/submit_login");?>">
	    <div class="col-md-6 text-center mx-auto">
		  <div class="row">
	        <div class="col-md-12 mt-5">
				<div class="row">
				    <div class="col-md-4" style="text-align: end;margin-top: 7px;padding-right: 0px;">
                        <label for="validationCustom01" class="form-label">Email :</label>
                    </div>
				    <div class="col-md-8">
                        <input type="text" class="form-control" name="cadet_name" id="validationCustom01" required>
			            <?php echo form_error( 'cadet_name', '<div class="invalid-feedback" style="display:block;">', '</div>');?>
                    </div>
                </div>

            </div>
			<div class="col-md-12 mt-3">
				<div class="row">
				    <div class="col-md-4" style="text-align: end;margin-top: 7px;padding-right: 0px;">
                        <label for="validationCustom01" class="form-label">Password :</label>
                    </div>
				    <div class="col-md-8">
                        <input type="password" class="form-control" name="password" id="validationCustom01" required>
			            <?php echo form_error( 'password', '<div class="invalid-feedback" style="display:block;">', '</div>');?>
                    </div>
                </div>

            </div>
          </div>
        </div>
	
	<!-- <div class="row heading-row">
		<div class="col-sm-10 text-center mx-auto mt-2">
			<div class="form-control">
				<label class="form-label">Cadet Name :</label>
				<input type="text" class="form-input" name="cadet_name"/>
				<?php echo form_error( 'cadet_name', '<div class="invalid-feedback" style="display:block;">', '</div>');?>

			</div>
		</div>
	</div>
	<div class="row heading-row">
		<div class="col-sm-10 text-center mx-auto mt-2">
			<div class="form-control">
				<label class="form-label">Password :</label>
				<input type="password" class="form-input" name="password"/>
				<?php echo form_error( 'password', '<div class="invalid-feedback" style="display:block;">', '</div>');?>

			</div>
		</div>
	</div> -->
	<div class="row heading-row">
		<div class="col-sm-10 text-center mx-auto mt-4 mb-5">
			<div class="form-control">
				<button class="btn btn-dark" style="width:150px;">Login</button>
			</div>
		</div>
	</div>
    </form>
</div>




