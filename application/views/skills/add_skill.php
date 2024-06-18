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
<script src="https://unpkg.com/tesseract.js@2.1.5/dist/tesseract.min.js"></script>

<script type="text/javascript">
async function ocr(image) {
  const worker = new Tesseract.worker();
  await worker.load();
  const result = await worker.recognize(image);
  worker.terminate();
  return result;
}
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
    function previewFile() {
        const preview = document.querySelector('iframe');
		document.querySelector('.previewfile').style.display = "block";
        const file = document.querySelector('input[type=file]').files[0];
		
        const reader = new FileReader();
        var filename = file.name;

        reader.addEventListener("load", function () {
          // convert file to base64 string
          preview.src = reader.result;

		  const image = new Image();
          image.src = reader.result;
          image.onload = async () => {
            const text = await ocr(image);
            console.log(text);
			const tables = [];
            const lines = text.split("\n");
            for (const line of lines) {
                const cells = line.split("\t");
                if (cells.length > 1) {
                    tables.push(cells);
                }
            }
			for (const table of tables) {
                console.log(table);
            }
          };
        }, false);

        if (file) {
          reader.readAsDataURL(file);
        }

    }
</script>
<div class="container">
<form enctype="multipart/form-data" method="post" action="<?php echo base_url('student/add_skill');?>">  
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
			<h2 style='font-family: "Tw Cen MT";color:#000;'>Add New Candidate</h2>
		</div>
	</div>

	
	
	<div class="row">
        <div class="col-sm-6">
            <div class="row heading-row">
		        <div class="col-sm-4 mt-2">
			        <div class="form-control">
				        <label class="form-label">Select File :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <input type="file" class="form-input" onchange="previewFile()" name="pdf" style="width:100%;"/>
			        </div>
		        </div>
	        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
		    <div class="row heading-row">
		        <div class="col-sm-4 mt-2">
			        <div class="form-control">
				        <label class="form-label">Scheme&nbsp;of&nbsp;Examination&nbsp;:</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-group">
					    <!-- <input typt="text" class="form-input" name="scheme_of_examination" style="width:100%;"/> -->
						<select class="form-control select2 scheme_of_examination select2-hidden-accessible" name="scheme_of_examination"  style="width:100%;">
							<option></option>
							
							
							<?php foreach($scheme_of_examination as $data){
								if($data->scheme_of_examination){

								if($this->input->get('scheme_of_examination')==$data->scheme_of_examination){ 
								    echo '<option selected>'.$data->scheme_of_examination.'</option>';
								}else{
									echo '<option>'.$data->scheme_of_examination.'</option>';
								}
							}
							}?>
						</select>
			        </div>
		        </div>
	        </div>
            <div class="row heading-row">
		        <div class="col-sm-4 mt-2">
			        <div class="form-control">
				        <label class="form-label">Trade :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-group">
					    <!-- <input typt="text" class="form-input" name="trade" style="width:100%;"/> -->
						<select class="form-control select2 trade select2-hidden-accessible" name="trade"  style="width:100%;">
							<option></option>
							
							<?php foreach($trade as $data){
								if($data->trade){

								if($this->input->get('trade')==$data->trade){ 
								    echo '<option selected>'.$data->trade.'</option>';
								}else{
									echo '<option>'.$data->trade.'</option>';
								}
							}
							}?>
						</select>
			        </div>
		        </div>
	        </div>
			<div class="row heading-row">
		        <div class="col-sm-4 mt-2">
			        <div class="form-control">
				        <label class="form-label">Roll No. :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <input typt="text" class="form-input" name="roll_no" style="width:100%;"/>
			        </div>
		        </div>
	        </div>
			<div class="row heading-row">
		        <div class="col-sm-4 mt-2">
			        <div class="form-control">
				        <label class="form-label">Name :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <input typt="text" class="form-input" name="name" style="width:100%;"/>
			        </div>
		        </div>
	        </div>
			<div class="row heading-row">
		        <div class="col-sm-4 mt-2">
			        <div class="form-control">
				        <label class="form-label">ITI Center :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-group">
					    <!-- <input typt="text" class="form-input" name="iti_center" style="width:100%;"/> -->
						<select class="form-control select2 iti_center select2-hidden-accessible" name="iti_center"  style="width:100%;">
							<option></option>
							
							<?php foreach($iti_center as $data){
								if($data->iti_center){
								if($this->input->get('iti_center')==$data->iti_center){ 
								    echo '<option selected>'.$data->iti_center.'</option>';
								}else{
									echo '<option>'.$data->iti_center.'</option>';
								}
							    }
							}?>
						</select>
			        </div>
		        </div>
	        </div>
			<div class="row heading-row">
		        <div class="col-sm-4 mt-2">
			        <div class="form-control">
				        <label class="form-label">Session :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <input typt="text" class="form-input" name="session" style="width:100%;"/>
			        </div>
		        </div>
	        </div>
			<div class="row heading-row">
		        <div class="col-sm-4 mt-2">
			        <div class="form-control">
				        <label class="form-label">ATS Establishment Name :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <input typt="text" class="form-input" name="ats" style="width:100%;"/>
			        </div>
		        </div>
	        </div>
			<div class="row heading-row">
		        <div class="col-sm-4 mt-2">
			        <div class="form-control">
				        <label class="form-label">Annual or Semester :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-group">
					    <!-- <input typt="text" class="form-input" name="annual_or_semester" style="width:100%;"/> -->
						<select class="form-control select2 annual_or_semester select2-hidden-accessible" name="annual_or_semester"  style="width:100%;">
							<option></option>
							
							<?php foreach($annual_or_semester as $data){
								if($data->annual_or_semester){
								if($this->input->get('sem_details')==$data->annual_or_semester){ 
								    echo '<option selected>'.$data->annual_or_semester.'</option>';
								}else{
									echo '<option>'.$data->annual_or_semester.'</option>';
								}
							    }
							}?>
						</select>
			        </div>
		        </div>
	        </div>
			<div class="row heading-row">
		        <div class="col-sm-4 mt-2">
			        <div class="form-control">
				        <label class="form-label">Annual / Semester Details :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-group">
					    <!-- <input typt="text" class="form-input" name="annual_or_semester_details" style="width:100%;"/> -->
						<select class="form-control annual_or_semester_details iti_center select2-hidden-accessible" name="annual_or_semester_details"  style="width:100%;">
							<option></option>
							
							<?php foreach($annual_or_semester_details as $data){
								if($data->annual_or_semester_details){
								if($this->input->get('ann_sem_details')==$data->annual_or_semester_details){ 
								    echo '<option selected>'.$data->annual_or_semester_details.'</option>';
								}else{
									echo '<option>'.$data->annual_or_semester_details.'</option>';
								}
							    }
							}?>
						</select>
			        </div>
		        </div>
	        </div>
			<div class="row heading-row">
		        <div class="col-sm-4 mt-2">
			        <div class="form-control">
				        <label class="form-label">Pass Out Year :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-group">
					    <!-- <input typt="text" class="form-input" name="pass_out_year" style="width:100%;"/> -->
						<select class="form-control select2 pass_out_year select2-hidden-accessible" name="pass_out_year"  style="width:100%;">
							<option></option>
							
							<?php foreach($pass_out_year as $data){
								if($data->pass_out_year){
								if($this->input->get('pass_out_year')==$data->pass_out_year){ 
								    echo '<option selected>'.$data->pass_out_year.'</option>';
								}else{
									echo '<option>'.$data->pass_out_year.'</option>';
								}
							    }
							}?>
						</select>
			        </div>
		        </div>
	        </div>
			<div class="row heading-row">
		        <div class="col-sm-4 mt-2">
			        <div class="form-control">
				        <label class="form-label">Result(P / F / A) :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-group">
					    <!-- <input typt="text" class="form-input" name="result" style="width:100%;"/> -->
						<select class="form-control select2 result select2-hidden-accessible" name="result"  style="width:100%;">
							<option></option>
							
							<?php foreach($result as $data){
								if($data->result){
								if($this->input->get('result')==$data->result){ 
								    echo '<option selected>'.$data->result.'</option>';
								}else{
									echo '<option>'.$data->result.'</option>';
								}
							    }
							}?>
						</select>
			        </div>
		        </div>
	        </div>
			<div class="row heading-row">
		        <div class="col-sm-4 mt-2">
			        <div class="form-control">
				        <label class="form-label">Link :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <input typt="text" class="form-input" name="link" style="width:100%;"/>
			        </div>
		        </div>
	        </div>
			
			
        </div>
        <div class="col-sm-6" style="padding:0;">
		    <div class="row previewfile" style="display:none">
		        <div class="col-sm-12">
		            <iframe src="" id="iframe-pdf" width="100%" height="500px"></iframe>
		        </div>
	        </div>
	    </div>
		
    </div>
	
    
	<div class="row mb-5">
		<div class="col-sm-7">
		    
		</div>
		<div class="col-sm-5">
		    <div class="row" style="width:100%;display:flex;flex-wrap: unset;margin-left: 0px;">
			    <button class="btn btn-dark m-2" id="query" style="width:32%;">Submit</button>
				<a class="btn btn-dark m-2" href="<?php echo base_url('student/index/'.$id);?>" style="width:32%;">Back</a>
				<!-- <a class="btn btn-dark m-2" href="<?php echo base_url('login/');?>" style="width:32%;">Exit</a> -->
			</div>
		</div>
	</div>
</form>
</div>


<!-- <script>
	$(document).ready(function(){
        $("#currentdetails").click(function(){
			var input = "<?php echo $id;?>";
			window.location.href="<?php echo base_url('student/currentdetails/');?>"+input;
		});
		$("#armedforces").click(function(){
			var input = "<?php echo $id;?>";
			window.location.href="<?php echo base_url('student/armedforces/');?>"+input;
		});
		$("#query").click(function(){
			var input = "<?php echo $id;?>";
			window.location.href="<?php echo base_url('student/query/');?>"+input;
		});
		$("#home").click(function(){
			var input = "<?php echo $id;?>";
			window.location.href="<?php echo base_url('student/index/');?>"+input;
		});
		$("#exit").click(function(){
			var input = "<?php echo $id;?>";
			window.location.href="<?php echo base_url('login/');?>";
		});
	});
</script> -->

<script>
$(document).ready(function() {
    $('.scheme_of_examination').select2({
        tags:true
    });
	$('.trade').select2({
        tags:true
    });
	$('.iti_center').select2({
        tags:true
    });
	$('.pass_out_year').select2({
        tags:true
    });
	$('.annual_or_semester').select2({
        tags:true
    });
	$('.annual_or_semester_details').select2({
        tags:true
    });
	$('.result').select2({
        tags:true
    });
});
</script>

