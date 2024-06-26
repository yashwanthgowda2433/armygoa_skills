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

<form enctype="multipart/form-data" method="post" action="<?php echo base_url('student/edit_skill/'.$id.'/'.$cadet->id);?>">  

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
			<h2 style='font-family: "Tw Cen MT";color:#000;'>Student Details</h2>
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
		        <div class="col-sm-5 mt-2">
			        <div class="form-control">
				        <label class="form-label">Scheme of Examination :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <!-- <input typt="text" class="form-input" name="scheme_of_examination" style="width:100%;" value="<?php echo $cadet->scheme_of_examination;?>"/> -->
						<select class="form-control select2 scheme_of_examination select2-hidden-accessible" name="scheme_of_examination"  style="width:100%;">
							<option></option>
							<?php foreach($scheme_of_examination as $data){
								if($data->scheme_of_examination){

								if($cadet->scheme_of_examination==$data->scheme_of_examination){ 
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
		        <div class="col-sm-5 mt-2">
			        <div class="form-control">
				        <label class="form-label">Trade :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <!-- <input typt="text" class="form-input" name="trade" style="width:100%;" value="<?php echo $cadet->trade;?>" /> -->
						<select class="form-control select2 trade select2-hidden-accessible" name="trade"  style="width:100%;">
							<option></option>
							
							<?php foreach($trade as $data){
								if($data->trade){

								if($cadet->trade==$data->trade){ 
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
		        <div class="col-sm-5 mt-2">
			        <div class="form-control">
				        <label class="form-label">Roll No. :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <input typt="text" class="form-input" name="roll_no" style="width:100%;" value="<?php echo $cadet->roll_no;?>" />
			        </div>
		        </div>
	        </div>
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
				        <label class="form-label">ITI Center :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <!-- <input typt="text" class="form-input" name="iti_center" style="width:100%;" value="<?php echo $cadet->iti_center;?>" /> -->
						<select class="form-control select2 iti_center select2-hidden-accessible" name="iti_center"  style="width:100%;">
							<option></option>
							
							<?php foreach($iti_center as $data){
								if($data->iti_center){
								if($cadet->iti_center==$data->iti_center){ 
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
		        <div class="col-sm-5 mt-2">
			        <div class="form-control">
				        <label class="form-label">Session :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <input typt="text" class="form-input" name="session" style="width:100%;" value="<?php echo $cadet->session;?>" />
			        </div>
		        </div>
	        </div>
			<div class="row heading-row">
		        <div class="col-sm-5 mt-2">
			        <div class="form-control">
				        <label class="form-label">ATS Establishment Name :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <input typt="text" class="form-input" name="ats" style="width:100%;" value="<?php echo $cadet->ats_establishment_name;?>"/>
			        </div>
		        </div>
	        </div>
			<div class="row heading-row">
		        <div class="col-sm-5 mt-2">
			        <div class="form-control">
				        <label class="form-label">Annual or Semester :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <!-- <input typt="text" class="form-input" name="annual_or_semester" style="width:100%;" value="<?php echo $cadet->annual_or_semester;?>" /> -->
						<select class="form-control select2 annual_or_semester select2-hidden-accessible" name="annual_or_semester"  style="width:100%;">
							<option></option>
							
							<?php foreach($annual_or_semester as $data){
								if($data->annual_or_semester){
								if($cadet->annual_or_semester==$data->annual_or_semester){ 
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
		        <div class="col-sm-5 mt-2">
			        <div class="form-control">
				        <label class="form-label">Annual / Semester Details :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <!-- <input typt="text" class="form-input" name="annual_or_semester_details" style="width:100%;" value="<?php echo $cadet->annual_or_semester_details;?>" /> -->
						<select class="form-control annual_or_semester_details iti_center select2-hidden-accessible" name="annual_or_semester_details"  style="width:100%;">
							<option></option>
							
							<?php foreach($annual_or_semester_details as $data){
								if($data->annual_or_semester_details){
								if($cadet->annual_or_semester_details==$data->annual_or_semester_details){ 
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
		        <div class="col-sm-5 mt-2">
			        <div class="form-control">
				        <label class="form-label">Pass Out Year :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <!-- <input typt="text" class="form-input" name="pass_out_year" style="width:100%;" value="<?php echo $cadet->pass_out_year;?>"/> -->
						<select class="form-control select2 pass_out_year select2-hidden-accessible" name="pass_out_year"  style="width:100%;">
							<option></option>
							
							<?php foreach($pass_out_year as $data){
								if($data->pass_out_year){
								if($cadet->pass_out_year==$data->pass_out_year){ 
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
		        <div class="col-sm-5 mt-2">
			        <div class="form-control">
				        <label class="form-label">Result (P / F / A) :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <!-- <input typt="text" class="form-input" name="result" style="width:100%;" value="<?php echo $cadet->result;?>" /> -->
						<select class="form-control select2 result select2-hidden-accessible" name="result"  style="width:100%;">
							<option></option>
							
							<?php foreach($result as $data){
								if($data->result){
								if($cadet->result==$data->result){ 
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
		        <div class="col-sm-5 mt-2">
			        <div class="form-control">
				        <label class="form-label">Link :</label>
			        </div>
		        </div>
				<div class="col-sm-7 mt-1">
			        <div class="form-control">
					    <input typt="text" class="form-input" name="link" style="width:100%;" value="<?php echo $cadet->link;?>" />
			        </div>
		        </div>
	        </div>

			<div class="row heading-row mt-5 mb-5">
			    <button class="btn btn-dark m-2" id="home" style="width:32%;" type="submit">Submit</button>
				<a class="btn btn-dark m-2" id="home" style="width:32%;" onclick="history.back()">Back</a>
            </div>  
        </div>
		<div class="col-sm-6">
		    <div class="row previewfile" style="display:block">
		        <div class="col-sm-12">
		            <iframe src="" id="iframe-pdf" width="100%" height="500px"></iframe>
		        </div>
	        </div>
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
	const searchFile = async (text, result, year)=> {
		const response = await fetch('<?php echo base_url("student/fetch_file");?>', {
            method: "POST",
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({text,result, year1}),
        })
        const json = await response.json()

        if (response.ok) {
			console.log(json.url)
			// url = url.replace('//','/');
			if(json.url!=""){
			    document.querySelector('#iframe-pdf').src = '<?php echo base_url();?>pdf/'+json.url;
			}else{
				// return '';
			}
		}else{
				// return '';
			}
            
    }
	var text1="<?php echo $cadet->link;?>";
	var res1="<?php echo $cadet->annual_or_semester_details;?>";
	var year1 = "<?php echo $cadet->pass_out_year;?>";

	searchFile(text1, res1,year1)
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