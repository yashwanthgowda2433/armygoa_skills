
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
            <h2 style='font-family: "Tw Cen MT";color:#000;'>Candidate Lists</h2>
        </div>
		<div class="col-sm-2 mx-auto mt-5">
		<?php if($user->name == "AdminG2320"){ ?>
		    <!-- <a class="btn btn-dark" style="width:150px;height: max-content;margin-top: auto;margin-bottom: auto;" href="<?php echo base_url('student/add_ai_skill');?>">Add AI Records</a>	 -->
		    <a class="btn btn-dark mt-3" style="width:150px;height: max-content;margin-top: auto;margin-bottom: auto;" href="<?php echo base_url('student/add_skill');?>">Add Record</a>	

		<?php } ?>
				
	    </div>
	</div>
    <form method="get" action="<?php echo base_url('student/skill_development');?>">

    <div class="row">
        <div class="col-sm-10">
		    <div class="row heading-row">
			    <div class="col-sm-2 mt-1">
			        <div class="form-control">
					
					    <label style="font-size:10px;margin-bottom:0px;">Scheme of Examination</label>
						<select class="form-input" name="scheme_of_examination"  style="width:100%;">
							<option></option>
							<?php if($this->input->get('scheme_of_examination')=="All"){ ?>
								<option selected>All</option>
							<?php }else{?>
							        <option>All</option>
							<?php }?>
							
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

				<div class="col-sm-2 mt-1">
			        <div class="form-control">
					    
						<label style="font-size:10px;margin-bottom:0px;">Trade</label>
						<select class="form-input" name="trade"  style="width:100%;">
							<option></option>
							<?php if($this->input->get('trade')=="All"){ ?>
								<option selected>All</option>
							<?php }else{?>
							        <option>All</option>
							<?php }?>
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

				<div class="col-sm-2 mt-1">
			        <div class="form-control">
					    <label style="font-size:10px;margin-bottom:0px;">Roll No.</label>
					    <input typt="text" class="form-input" placeholder="Roll No." value="<?= $this->input->get('roll_no')?$this->input->get('roll_no'):''?>" name="roll_no" style="width:100%;"/>
			        </div>
		        </div>

				<div class="col-sm-3 mt-1">
			        <div class="form-control">
					    <label style="font-size:10px;margin-bottom:0px;">Name</label>
					    <input typt="text" class="form-input" placeholder="Name" value="<?= $this->input->get('name')?$this->input->get('name'):''?>" name="name" style="width:100%;"/>
			        </div>
		        </div>
				<div class="col-sm-2 mt-1">
			        <div class="form-control">
					    
						<label style="font-size:10px;margin-bottom:0px;">ITI Center</label>
						<select class="form-input" name="iti_center"  style="width:100%;">
							<option></option>
							<?php if($this->input->get('iti_center')=="All"){ ?>
								<option selected>All</option>
							<?php }else{?>
							        <option>All</option>
							<?php }?>
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
				<div class="col-sm-2 mt-3">
			        <div class="form-control">
					    
						<label style="font-size:10px;margin-bottom:0px;">Pass Out Year</label>
						<select class="form-input" name="pass_out_year"  style="width:100%;">
							<option></option>
							<?php if($this->input->get('pass_out_year')=="All"){ ?>
								<option selected>All</option>
							<?php }else{?>
							        <option>All</option>
							<?php }?>
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
				<div class="col-sm-2 mt-3">
			        <div class="form-control">
					    <!-- <input typt="text" class="form-input" placeholder="Annual/Semester Details" value="<?= $this->input->get('sem_details')?$this->input->get('sem_details'):''?>" name="sem_details" style="width:100%;"/> -->
						<label style="font-size:10px;margin-bottom:0px;">Annual/Semester</label>
						<select class="form-input" name="sem_details"  style="width:100%;">
							<option></option>
							<?php if($this->input->get('sem_details')=="All"){ ?>
								<option selected>All</option>
							<?php }else{?>
							        <option>All</option>
							<?php }?>
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
				<div class="col-sm-2 mt-3">
			        <div class="form-control">
					    <!-- <input typt="text" class="form-input" placeholder="Annual/Semester Details" value="<?= $this->input->get('sem_details')?$this->input->get('sem_details'):''?>" name="sem_details" style="width:100%;"/> -->
						<label style="font-size:10px;margin-bottom:0px;">Annual/Semester Details</label>
						<select class="form-input" name="ann_sem_details"  style="width:100%;">
							<option></option>
							<?php if($this->input->get('ann_sem_details')=="All"){ ?>
								<option selected>All</option>
							<?php }else{?>
							        <option>All</option>
							<?php }?>
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
				<div class="col-sm-2 mt-3">
			        <div class="form-control">
						<label style="font-size:10px;margin-bottom:0px;">Result</label>
						<select class="form-input" name="result"  style="width:100%;">
							<option></option>
							<?php if($this->input->get('result')=="All"){ ?>
								<option selected>All</option>
							<?php }else{?>
							        <option>All</option>
							<?php }?>
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

            
        </div>
        <div class="col-sm-1">
            <div class="row heading-row" style="min-height: 100%;">
			      

                  <button class="btn btn-dark" style="width:150px;height: max-content;margin-top: auto;margin-bottom: auto;" type="submit">Search</button>
				  
            </div>
        </div>
		<div class="col-sm-1">
            <div class="row heading-row" style="min-height: 100%;">
			      

                  
				  <button class="btn btn-danger" onclick="window.location.href='<?php echo base_url('/student/skill_development');?>'" style="width:150px;height: max-content;margin-top: auto;margin-bottom: auto;" type="button">Reset</button>
            </div>
        </div>
    </div>
    </form>

	<!-- <div class="row heading-row">
		<div class="col-sm-10 text-center mx-auto mt-2">
			<div class="form-control">
				<label class="form-label">Cadet No :</label>
				<input typt="text" class="form-input" name="cadetno"/>
			</div>
		</div>
	</div> -->
<?php
parse_str($_SERVER['QUERY_STRING'],$query_array);
$query_array_pagination=$query_array;
$query_array_page_size=$query_array;

$sort_key=$this->input->get("sort_key");
$sort_type=$this->input->get("sort_type");


unset($query_array['sort_key']);
unset($query_array['sort_type']);

$query_string_sort=http_build_query($query_array);

unset($query_array_pagination['page']);

$query_string_pagination=http_build_query($query_array_pagination);

unset($query_array_page_size['page_size']);

$query_string_page_size=http_build_query($query_array_page_size);


if($sort_type=="asc"){

	$sort_type="desc";
	
} else {
	
	$sort_type="asc";
	
	}
	if(!empty($cadet) || $cadet != ''){
?>
						  

	<div class="row heading-row">
		<div class="col-sm-12 text-center mx-auto mt-4">
			
        <div class="module-content-section">
	        <div class="table-header-data">
		
	            <div class="left">Showing <?php echo $page_size>sizeof($cadet)?sizeof($cadet):$page_size; ?> of <?php echo $total; ?> | Page <?php echo $current_page; ?> of <?php echo $total_pages; ?></div>
	                <div class="right">
					    Records Per Page:  &nbsp; <select name="page_size" class="filter-form-select" style="width:60px;" onchange="window.location.href='<?php echo site_url("student/skill_development?".$query_string_page_size); ?>&page_size='+$(this).val()">
						    <option <?php if($this->input->get("page_size")==25): ?>selected="selected"<?php endif; ?> value="25">25</option>
						    <option <?php if($this->input->get("page_size")==50): ?>selected="selected"<?php endif; ?> value="50">50</option>
						    <option <?php if($this->input->get("page_size")==100): ?>selected="selected"<?php endif; ?> value="100">100</option>
						    <option <?php if($this->input->get("page_size")==250): ?>selected="selected"<?php endif; ?> value="250">250</option>
					    </select>
	                </div>
	                <div class="clear"></div>
	
	                </div>
	                <div class="table-container">
						<table>
						  <tr>
			                    <?php if($user->name == "AdminG2320"){ ?>
								<th>Select</th>
								<?php } ?>
								<th>Scheme Of Examination</th>
								<th>Trade</th>
								<th>Roll No.</th>
								<th>Name</th>
								<th>ITI Center</th>
								<th>Session</th>
								<th>ATS Establishment Name</th>
								<th>Annual/Semester</th>
								<th>Annual/Semester Details</th>
								<th>Pass Out Year</th>
								<th>Result(P/F/A)</th>
								<th>Link</th>
								<th>Action</th>

						  </tr>
						  
						  <?php $k=1;
						  foreach($cadet as $l): ?>
						  <tr>
						        <?php if($user->name == "AdminG2320"){ ?>
							    <td><input type="checkbox" class="deletebox" name="deletebox" id="deletebox" value="<?php echo $l->id; ?>"/></td>
								<?php } ?>
								<td><?php echo $l->scheme_of_examination; ?></td>
								<td><?php echo $l->trade; ?></td>
								<td><?php echo $l->roll_no; ?></td>
								<td><?php echo $l->name; ?></td>
								<td><?php echo $l->iti_center; ?></td>
								<td><?php echo $l->session; ?></td>
								<td><?php echo $l->ats_establishment_name; ?></td>
								<td><?php echo $l->annual_or_semester; ?></td>
								<td><?php echo $l->annual_or_semester_details; ?></td>
								<td><?php echo $l->pass_out_year; ?></td>
								<td><?php echo $l->result; ?></td>
								<td><a href="#" onclick="searchFile('<?php echo $l->link; ?>','<?php echo $l->annual_or_semester_details; ?>', '<?php echo $l->pass_out_year;?>')"><?php echo $l->link; ?></td>
								
								<td>
								    <a href="<?php echo base_url('student/edit_skill/'.$id.'/'.$l->id); ?>" class="" title="Edit Listing"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i> Edit</a>
									<?php if($user->name == "AdminG2320"){ ?>
									<?php } ?>
								</td>
						  </tr>
						  
						  <?php endforeach;
						   ?>
						</table>
						<div class="data-pagination">
							<?php if($prev_page): ?>
							<a href="<?php echo site_url("student/skill_development?page=".$prev_page_num."&".$query_string_pagination); ?>" class="form-button small-button pagination-buttons">Previous</a>
							<?php endif; ?>
							
							<?php
								
								$total=10;
								$start=1;
								
								if($total_pages<=10){
									
									$start=1;
									$total=$total_pages;
								}
								
								if($total_pages==11 and $current_page>=2){ $start=2; $total=($total+$start)>$total_pages?$total_pages:($total+$start); }
								if($total_pages==12 and $current_page>=3){ $start=3;  $total=($total+$start)>$total_pages?$total_pages:($total+$start);}
								if($total_pages==13 and $current_page>=4){ $start=4;  $total=($total+$start)>$total_pages?$total_pages:($total+$start);}
								if($total_pages==14 and $current_page>=5){ $start=5;  $total=($total+$start)>$total_pages?$total_pages:($total+$start);}
								if($total_pages>14 and $current_page>5 and $current_page<$total_pages){ $start=$current_page-5;  $total=($total+$start)>$total_pages?$total_pages:($total+$start);}
								
								if($total_pages>14 and $current_page==$total_pages){ $start=$current_page-10;  $total=($total+$start)>$total_pages?$total_pages:($total+$start); }
								
									
									for($i=$start; $i<=$total; $i++){
										
										if(($i)!=$current_page){
									?>
										<a href="<?php echo site_url("student/skill_development?page=".($i-1)."&".$query_string_pagination); ?>" class="form-button small-button pagination-buttons"><?php echo $i; ?></a>
									<?php
								 } else {
									 echo "&nbsp;".$i."&nbsp;";
									 }
									
									}
							?>
							
							<?php if($next_page): ?>
							<a href="<?php echo site_url("student/skill_development?page=".$next_page_num."&".$query_string_pagination); ?>" class="form-button small-button pagination-buttons">Next</a>
							<?php endif; ?>
						</div>
                    </div>
		        </div>
	        </div>
       
    </div>
   <?php }?>
    <div class="row heading-row">
		<div class="col-sm-10 text-center mx-auto mt-4 mb-5">
			<div class="form-control" style="text-align:end;">
			   <?php if($user->name == "AdminG2320"){ ?>
				    <a class="btn btn-dark m-2" href="<?php echo base_url('student/index');?>" id="home" style="width:120px;">Back</a>
					<button class="btn btn-danger" style="width:150px;" onclick="deleteAll()">Delete</button>

				<?php }else{ ?>
					
					<button class="btn btn-dark" style="width:150px;" onclick="window.location.href='<?php echo base_url('login/logout');?>'">Logout</button>
				
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<script>
	function deleteAll(){
		var inputs = document.querySelectorAll('.deletebox'); 
		var delete_ids = [];
        for (var i = 0; i < inputs.length; i++) {   
            if(inputs[i].checked == true)
			{
				delete_ids.push(inputs[i].value);
			}   
        }   
		window.location.href = "<?php echo base_url('student/delete_skill/'.$id.'/');?>"+delete_ids;
	}
	const searchFile = async (text, result, year)=> {
		const response = await fetch('<?php echo base_url("student/fetch_file");?>', {
            method: "POST",
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({text,result, year}),
        })
        const json = await response.json()

        if (response.ok) {
			console.log(json.url)
			// url = url.replace('//','/');
			if(json.url!=""){
			    window.open('<?php echo base_url();?>pdf/'+json.url,'_blank');
			}else{
				alert("File not found")
			}
		}
            
        }

        
</script>

