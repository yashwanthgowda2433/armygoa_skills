<style>
	.form-input{
		background:#fff;
	}
	.form-control{
		height:max-content;
	}
	#icon{
		display:none!important;
	}
</style>
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

<form enctype="multipart/form-data" method="post" action="<?php echo base_url('student/edit_user/'.$id.'/'.$cadet->id);?>">  

<div class="container">
    
	<div class="row heading-row">
		<div class="col-sm-10 text-center mx-auto mt-5">
		    <div class="alert alert-success" id="success-alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>Successfully Submitted. </strong>
            </div>
			<div class="alert alert-danger" id="failed-alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>Failed to Submit. Please try again! </strong>
            </div>
			<h2 style='font-family: "Tw Cen MT";color:#000;'>Edit User Details</h2>
		</div>
	</div>

	
	

    <div class="row">
        <div class="col-sm-6">
            <div class="row heading-row">
		        <div class="col-sm-5 mt-2">
			        <div class="form-control">
				        <label class="form-label">Name :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <input typt="text" class="form-input" name="name" style="width:100%;" value="<?php echo $cadet->name;?>" />
			        </div>
		        </div>
	        </div>
			<div class="row heading-row">
		        <div class="col-sm-5 mt-2">
			        <div class="form-control">
				        <label class="form-label">Email :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <input typt="text" class="form-input" name="email" style="width:100%;" value="<?php echo $cadet->email;?>" />
			        </div>
		        </div>
	        </div>
			<div class="row heading-row">
		        <div class="col-sm-5 mt-2">
			        <div class="form-control">
				        <label class="form-label">Mobile :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <input typt="text" class="form-input" name="mobile" style="width:100%;" value="<?php echo $cadet->mobile;?>" />
			        </div>
		        </div>
	        </div>
			<div class="row heading-row">
		        <div class="col-sm-5 mt-2">
			        <div class="form-control">
				        <label class="form-label">Password :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <input typt="text" class="form-input" name="password" style="width:100%;" value="<?php echo $cadet->password;?>" />
			        </div>
		        </div>
	        </div>
			

			<div class="row heading-row mt-5 mb-5">
			    <button class="btn btn-dark m-2" id="home" style="width:32%;" type="submit">Submit</button>
				<a class="btn btn-dark m-2" id="home" style="width:32%;" onclick="history.back()">Back</a>
            </div>
    </div>
	
</form> 
	<!-- <div class="row mb-5">
		<div class="col-sm-7">
		    
		</div>
		<div class="col-sm-5">
		    <div class="row" style="width:100%;display:flex;flex-wrap: unset;margin-left: 0px;">
				<button class="btn btn-dark m-2" id="home" style="width:32%;" type="submit">Submit</button>

				<a class="btn btn-dark m-2" id="home" style="width:32%;" onclick="history.back()">Back</a>
			</div>
		</div>
	</div> -->
</div>


<script>
	$(document).ready(function(){
        $("#currentdetails").click(function(){
			var input = "<?php echo $id;?>";
			window.location.href="<?php echo base_url('student/currentdetails_view/');?>"+<?php echo $id;?>+'?cadetno='+<?php echo $cadet->id;?>;
		});
		$("#armedforces").click(function(){
			var input = "<?php echo $id;?>";
			window.location.href="<?php echo base_url('student/armedforces/');?>"+<?php echo $id;?>+'?cadetno='+<?php echo $cadet->id;?>;
		});
		$("#query").click(function(){
			var input = "<?php echo $id;?>";
			window.location.href="<?php echo base_url('student/query/');?>"+<?php echo $id;?>+'?cadetno='+<?php echo $cadet->id;?>;
		});
		// $("#home").click(function(){
		// 	var input = "<?php echo $id;?>";
		// 	onclick="history.back()"
		// });
		$("#exit").click(function(){
			var input = "<?php echo $id;?>";
			window.location.href="<?php echo base_url('login/');?>";
		});
	});
</script>

