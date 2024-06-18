<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use setasign\Fpdi\Fpdi;
require_once('application/libraries/fpdi/autoload.php');
require_once('application/libraries/PDFMerger/PDFMerger.php');

class Student extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	
	
	
	public function __construct() {
		parent::__construct();
		$this->load->model('cadet_model','cadet');
		$this->load->model('currentdetails_model','currentdetails');
		$this->load->model('Armedforces_model','armedforces');
		$this->load->model('Query_model','query');
		$this->load->model('Skill_development_model','skill_development');
		$this->load->model('User_model','user');

		$this->load->library('fpdf/fpdf.php');

		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('html');

	}
	
	
	public function delete_cache($path, $pattern) {
		$path = rtrim(str_replace("\\", "/", $path), '/') . '/';
		$matches = Array();
		$entries = Array();
		$dir = dir($path);
		while (false !== ($entry = $dir->read())) {
		  $entries[] = $entry;
		}
		$dir->close();
		foreach ($entries as $entry) {
		  $fullname = $path . $entry;
		  if ($entry != '.' && $entry != '..' && is_dir($fullname)) {
			$this->delete_cache($fullname, $pattern);
		  } else if (is_file($fullname) && preg_match($pattern, $entry)) {
			unlink($fullname); // delete the file
			echo $fullname," deleted.<br />"; #comment out if you do not want to echo the file deleted.
		  }
		}
	}

	public function submit_login()
	{
		$this->form_validation->set_rules('cadet_name', 'cadet_name', 'trim|required|valid_email|max_length[30]');
		$this->form_validation->set_rules('password', 'password', 'trim|required|max_length[15]');

		if($this->form_validation->run()){
		   
		        $view_params['email'] = $this->input->post('cadet_name');
		        $view_params['password'] = $this->input->post('password');

		        $cadet = $this->user->view($view_params);

		        if($cadet){
				    $this->session->set_userdata('user', $cadet);
				    $this->session->set_flashdata('success','Successfully Loggedin!');
			        redirect(base_url('student/index'));
			    }else{
				    $this->session->set_flashdata('failed','Record Not Found!');
			        redirect(base_url('login/'));
				}
			
		}else{
			$this->session->set_flashdata('failed','Form Error!');

			$this->load->view('includes/header');
		    $this->load->view('login');
		    $this->load->view('includes/footer');
		}
	}

	public function index()
	{
		$cadet = $this->session->userdata('user');
		if($cadet){
		    $data['cadet'] = $cadet;
		    $data['id'] = $cadet->id;
		    if(!empty($cadet->name))
		    {
			    if($cadet->name == 'AdminG2320')
			    {
				    $this->load->view('includes/header');
		            $this->load->view('admin',$data);
		            $this->load->view('includes/footer');
			    }else{
					redirect(base_url('student/skill_development'));

			    }
		    }else{
			    $this->session->set_flashdata('failed','Record Not Found!');
			    redirect(base_url('login/'));
			}
		}else{
			redirect(base_url('login/'));
		}
	}

	// Define the comparison function
    private function compareFirstLetter($a, $b) {
		// print_r($b->trade);die;
        $firstLetterA = strtolower($a->trade);
        $firstLetterB = strtolower($b->trade);
        return strcmp($firstLetterA, $firstLetterB);
    }

	public function skill_development()
	{
	  $cadet = $this->session->userdata('user');
	  if($cadet){
		$page=$this->input->get("page");
			
		if(!$page){
					
			$page=0;
		}
			
		$page_size=25;
			
		if($this->input->get("page_size")>0){
			$page_size=$this->input->get("page_size");
		}
			
		$page_start=$page_size*$page;

		$data['id'] = $cadet->id;
		$data['user'] = $this->session->userdata('user');
		// $view_params['cadet_no'] = $i;
		$view_params['start'] = $page_start;
		$view_params['end'] = $page_size;
		$view_params['trade'] = $this->input->get('trade');
		$view_params['roll_no'] = $this->input->get('roll_no');
		$view_params['name'] = $this->input->get('name');
		$view_params['iti_center'] = $this->input->get('iti_center');
		$view_params['sem_details'] = $this->input->get('sem_details');
		$view_params['ann_sem_details'] = $this->input->get('ann_sem_details');
		$view_params['scheme_of_examination'] = $this->input->get('scheme_of_examination');
		$view_params['pass_out_year'] = $this->input->get('pass_out_year');
		$view_params['result'] = $this->input->get('result');


		// $view_params['year_of_admn'] = $this->input->get('yoa');
		// $view_params['year_of_discharged'] = $this->input->get('yod');
        $cadet = '';
		$count=0;
		// if(!empty($view_params['year_of_admn']) || !empty($view_params['year_of_discharged'] || !empty($view_params['cadet_no']))){
		    $cadet = $this->skill_development->view($view_params);

		    $count = $this->skill_development->count($view_params);
		// }
		
		$data['cadet'] = $cadet;
		$data['total']=$count;
			$data['page_size']=$page_size;
			$data['current_page']=$page+1;
			$data['total_pages']=$data['total']/$page_size;
			$data['total_pages']=$data['total_pages']<1?1:$data['total_pages'];
			
			if($data['total_pages']>(int)($data['total_pages'])){
				$data['total_pages']=(int)($data['total_pages'])+1;
			}
			
			$data['next_page']=false;
			$data['next_page_num']=$page+1;
			$data['prev_page']=true;
			$data['prev_page_num']=$page-1;
			
			if($data['total']>(($page+1) * $page_size)){
				$data['next_page']=true;
			}
			
			if($page==0){
				$data['prev_page']=false;
			}

			$data['scheme_of_examination'] = $this->skill_development->get_scheme_of_examination();
			$trade = $this->skill_development->get_trade();
			usort($trade, function($a, $b) {
				$firstLetterA = strtolower(trim($a->trade));
				$firstLetterB = strtolower(trim($b->trade));
				return strcmp($firstLetterA, $firstLetterB);
			});
			$data['trade'] = $trade;

			// print_r($data['trade']);die;
			$data['iti_center'] = $this->skill_development->get_iti_center();
			$data['pass_out_year'] = $this->skill_development->get_pass_out_year();
			$data['annual_or_semester'] = $this->skill_development->get_annual_or_semester();
			$data['annual_or_semester_details'] = $this->skill_development->get_annual_or_semesterdetails();

			$data['result'] = $this->skill_development->get_result();

			// print_r($data['scheme_of_examination']);die;
		$this->load->view('includes/header');
		$this->load->view('skills/skill_development',$data);
		$this->load->view('includes/footer');
	  }else{
		redirect(base_url('login/'));
	  }
	}

	public function add_skill()
	{
	  $cadet = $this->session->userdata('user');
	  if($cadet){
		$data['id'] = $cadet->id;

		if(!empty($this->input->post('trade')))
		{
			$photo_path = '';
			$pdf_path = '';
			
			if($_FILES["pdf"]["name"])
			{
				$upload_folder = "pdf/";
				$newfilename = $this->input->post('name');
				$extension  = pathinfo( $_FILES["pdf"]["name"], PATHINFO_EXTENSION );
				$basename = $newfilename . "." . $extension;
				$path = $upload_folder."{$basename}";
				if(move_uploaded_file($_FILES["pdf"]["tmp_name"], $path))
				{
					$pdf_path = $basename;
				}
			}
			$addparams['scheme_of_examination'] = $this->input->post('scheme_of_examination');
			$addparams['trade'] = $this->input->post('trade');
		    $addparams['roll_no'] = $this->input->post('roll_no');
		    $addparams['name'] = $this->input->post('name');
		    $addparams['iti_center'] = $this->input->post('iti_center');
		    $addparams['session'] = $this->input->post('session');
		    $addparams['annual_or_semester'] = $this->input->post('annual_or_semester');
		    $addparams['annual_or_semester_details'] = $this->input->post('annual_or_semester_details');
			$addparams['pass_out_year'] = $this->input->post('pass_out_year');
		    $addparams['result'] = $this->input->post('result');
		    $addparams['link'] = $this->input->post('link');
			$addparams['pdf_link'] = $pdf_path;
		   
		
		    $data = $this->skill_development->add($addparams);
			if($data)
		    {
			    $this->session->set_flashdata('success','Successfully submitted');
			    redirect(base_url('student/skill_development/'.$id));
		    }else{
			    $this->session->set_flashdata('failed','Failed to submit, Please try again!');
			    redirect(base_url('student/skill_development/'.$id));
		    }

		}else{
			$data['scheme_of_examination'] = $this->skill_development->get_scheme_of_examination();
			$trade = $this->skill_development->get_trade();
			usort($trade, function($a, $b) {
				$firstLetterA = strtolower(trim($a->trade));
				$firstLetterB = strtolower(trim($b->trade));
				return strcmp($firstLetterA, $firstLetterB);
			});
			$data['trade'] = $trade;

			// print_r($data['trade']);die;
			$data['iti_center'] = $this->skill_development->get_iti_center();
			$data['pass_out_year'] = $this->skill_development->get_pass_out_year();
			$data['annual_or_semester'] = $this->skill_development->get_annual_or_semester();
			$data['annual_or_semester_details'] = $this->skill_development->get_annual_or_semesterdetails();
			$data['result'] = $this->skill_development->get_result();

			$this->load->view('includes/header');
		    $this->load->view('skills/add_skill',$data);
		    $this->load->view('includes/footer');
		}
	  }else{
		redirect(base_url('login/'));
	  }
	}

	public function add_ai_skill()
	{
	  $cadet = $this->session->userdata('user');
	  if($cadet){
		$data['id'] = $cadet->id;
		if(!empty($this->input->post('trade')))
		{
			$photo_path = '';
			$pdf_path = '';
			
			if($_FILES["pdf"]["name"])
			{
				$upload_folder = "pdf/";
				$newfilename = $this->input->post('name');
				$extension  = pathinfo( $_FILES["pdf"]["name"], PATHINFO_EXTENSION );
				$basename = $newfilename . "." . $extension;
				$path = $upload_folder."{$basename}";
				if(move_uploaded_file($_FILES["pdf"]["tmp_name"], $path))
				{
					$pdf_path = $basename;
				}
			}
			$addparams['scheme_of_examination'] = $this->input->post('scheme_of_examination');
			$addparams['trade'] = $this->input->post('trade');
		    $addparams['roll_no'] = $this->input->post('roll_no');
		    $addparams['name'] = $this->input->post('name');
		    $addparams['iti_center'] = $this->input->post('iti_center');
		    $addparams['session'] = $this->input->post('session');
		    $addparams['ats_establishment_name'] = $this->input->post('ats');

		    $addparams['annual_or_semester'] = $this->input->post('annual_or_semester');
		    $addparams['annual_or_semester_details'] = $this->input->post('annual_or_semester_details');
			$addparams['pass_out_year'] = $this->input->post('pass_out_year');
		    $addparams['result'] = $this->input->post('result');
		    $addparams['link'] = $this->input->post('link');
			$addparams['pdf_link'] = $pdf_path;
		   
		
		    $data = $this->skill_development->add($addparams);
			if($data)
		    {
			    $this->session->set_flashdata('success','Successfully submitted');
			    redirect(base_url('student/skill_development/'.$id));
		    }else{
			    $this->session->set_flashdata('failed','Failed to submit, Please try again!');
			    redirect(base_url('student/skill_development/'.$id));
		    }

		}else{
			$this->load->view('includes/header');
		    $this->load->view('skills/add_ai_skill',$data);
		    $this->load->view('includes/footer');
		}
	  }else{
		redirect(base_url('login/'));
	  }
	}

	public function edit_skill($i,$skill_no)
	{
		$view_params['skill_no'] = $skill_no;
		if(!empty($this->input->post('name')))
		{
			$photo_path = '';
			$pdf_path = '';
			if($_FILES["pdf"]["name"])
			{
				$upload_folder = "pdf/";
				$newfilename = $this->input->post('name');
				$extension  = pathinfo( $_FILES["pdf"]["name"], PATHINFO_EXTENSION );
				$basename = $newfilename . "." . $extension;
				$path = $upload_folder."{$basename}";
				if(move_uploaded_file($_FILES["pdf"]["tmp_name"], $path))
				{
					$pdf_path = $basename;
				}
			}

			$addparams['id'] = $skill_no;
			$addparams['scheme_of_examination'] = $this->input->post('scheme_of_examination');
			$addparams['trade'] = $this->input->post('trade');
		    $addparams['roll_no'] = $this->input->post('roll_no');
		    $addparams['name'] = $this->input->post('name');
		    $addparams['ats_establishment_name'] = $this->input->post('ats');

		    $addparams['iti_center'] = $this->input->post('iti_center');
		    $addparams['session'] = $this->input->post('session');
		    $addparams['annual_or_semester'] = $this->input->post('annual_or_semester');
		    $addparams['annual_or_semester_details'] = $this->input->post('annual_or_semester_details');
			$addparams['pass_out_year'] = $this->input->post('pass_out_year');
		    $addparams['result'] = $this->input->post('result');
		    $addparams['link'] = $this->input->post('link');
			$addparams['pdf_link'] = $pdf_path;
		
		    $data = $this->skill_development->edit($addparams);
			if($data)
		    {
			    $this->session->set_flashdata('success','Successfully submitted');
			    redirect(base_url('student/skill_development/'.$i));
		    }else{
			    $this->session->set_flashdata('failed','Failed to submit, Please try again!');
				redirect(base_url('student/skill_development/'.$i));

		    }

		}else{
		   $cadet = $this->skill_development->view($view_params);
		   // print_r($cadet);die;
		   $data['skill_no'] = $skill_no;
		   $data['id'] = $i;
		   $data['cadet'] = $cadet;

		   $data['scheme_of_examination'] = $this->skill_development->get_scheme_of_examination();
			$trade = $this->skill_development->get_trade();
			usort($trade, function($a, $b) {
				$firstLetterA = strtolower(trim($a->trade));
				$firstLetterB = strtolower(trim($b->trade));
				return strcmp($firstLetterA, $firstLetterB);
			});
			$data['trade'] = $trade;

			// print_r($data['trade']);die;
			$data['iti_center'] = $this->skill_development->get_iti_center();
			$data['pass_out_year'] = $this->skill_development->get_pass_out_year();
			$data['annual_or_semester'] = $this->skill_development->get_annual_or_semester();
			$data['annual_or_semester_details'] = $this->skill_development->get_annual_or_semesterdetails();

		   if(!empty($cadet->name))
		   {
			if($i == 'admin')
			{
				$this->load->view('includes/header');
		        $this->load->view('skills/edit_skill',$data);
		        $this->load->view('includes/footer');
			}else{
				$this->load->view('includes/header');
		        $this->load->view('skills/edit_skill',$data);
		        $this->load->view('includes/footer');
		 	}
		  }else{
			$this->session->set_flashdata('failed','Record Not Found!');
			redirect(base_url('login/'));
		  }
	    }
		

	}

	public function delete_skill($i,$skill_no)
	{
		if($skill_no){
			$id_arr = explode(",",$skill_no);
			$success=0;
			$failed=0;
			foreach($id_arr as $data){
			    $addparams['id'] = $data;
		        $data = $this->skill_development->delete($addparams);
				if($data)
				{
					$success=$success+1;
				}else{
					$failed=$failed+1;
				}
			}
			if($data)
		    {
			    $this->session->set_flashdata('success','Successfully deleted '.$success.' Failed counts '.$failed);
			    redirect(base_url('student/skill_development/'.$i));
		    }else{
			    $this->session->set_flashdata('failed','Failed to delete, Please try again!');
				redirect(base_url('student/skill_development/'.$i));

		    }
		}else{
			$this->session->set_flashdata('failed','Failed to delete, Please try again!');
			redirect(base_url('student/skill_development/'.$i));

		}
	}

	public function add_user()
	{
	  $cadet = $this->session->userdata('user');
	  if($cadet){
		$data['id'] = $cadet->id;
		if(!empty($this->input->post('name')))
		{

			$addparams['name'] = $this->input->post('name');
		    $addparams['email'] = $this->input->post('email');
		    $addparams['password'] = $this->input->post('password');
		    $addparams['mobile'] = $this->input->post('mobile');
		
		    $data = $this->user->add($addparams);
			if($data)
		    {
			    $this->session->set_flashdata('success','Successfully submitted');
			    redirect(base_url('student/user'));
		    }else{
			    $this->session->set_flashdata('failed','Failed to submit, Please try again!');
			    redirect(base_url('student/user'));
		    }

		}else{
			$this->load->view('includes/header');
		    $this->load->view('user/add_user',$data);
		    $this->load->view('includes/footer');
		}
	  }else{
		redirect(base_url('login/'));
	  }
	}

	public function user()
	{
	  $cadet = $this->session->userdata('user');
	  if($cadet){
		$page=$this->input->get("page");
			
		if(!$page){
					
			$page=0;
		}
			
		$page_size=25;
			
		if($this->input->get("page_size")>0){
			$page_size=$this->input->get("page_size");
		}
			
		$page_start=$page_size*$page;

		$data['id'] = $cadet->id;
		// $view_params['cadet_no'] = $i;
		$view_params['start'] = $page_start;
		$view_params['end'] = $page_size;
		$view_params['search'] = $this->input->get('search');
		// $view_params['year_of_admn'] = $this->input->get('yoa');
		// $view_params['year_of_discharged'] = $this->input->get('yod');
        $cadet = '';
		$count=0;
		// if(!empty($view_params['year_of_admn']) || !empty($view_params['year_of_discharged'] || !empty($view_params['cadet_no']))){
		    $cadet = $this->user->view($view_params);

		    $count = $this->user->count($view_params);
		// }
		
		$data['cadet'] = $cadet;
		$data['total']=$count;
			$data['page_size']=$page_size;
			$data['current_page']=$page+1;
			$data['total_pages']=$data['total']/$page_size;
			$data['total_pages']=$data['total_pages']<1?1:$data['total_pages'];
			
			if($data['total_pages']>(int)($data['total_pages'])){
				$data['total_pages']=(int)($data['total_pages'])+1;
			}
			
			$data['next_page']=false;
			$data['next_page_num']=$page+1;
			$data['prev_page']=true;
			$data['prev_page_num']=$page-1;
			
			if($data['total']>(($page+1) * $page_size)){
				$data['next_page']=true;
			}
			
			if($page==0){
				$data['prev_page']=false;
			}

		$this->load->view('includes/header');
		$this->load->view('user/user',$data);
		$this->load->view('includes/footer');
	  }else{
		redirect(base_url('login/'));
	  }
	}

	public function edit_user($i,$skill_no)
	{
		$view_params['id'] = $skill_no;
		if(!empty($this->input->post('name')))
		{
			$photo_path = '';
			$pdf_path = '';

			$addparams['id'] = $skill_no;
			$addparams['name'] = $this->input->post('name');
		    $addparams['email'] = $this->input->post('email');
		    $addparams['password'] = $this->input->post('password');
		    $addparams['mobile'] = $this->input->post('mobile');
		
		
		    $data = $this->user->edit($addparams);
			if($data)
		    {
			    $this->session->set_flashdata('success','Successfully submitted');
			    redirect(base_url('student/user'));
		    }else{
			    $this->session->set_flashdata('failed','Failed to submit, Please try again!');
				redirect(base_url('student/user'));

		    }

		}else{
		   $cadet = $this->user->view($view_params);
		   // print_r($cadet);die;
		   $data['skill_no'] = $skill_no;
		   $data['id'] = $i;
		   $data['cadet'] = $cadet;

		   if(!empty($cadet->name))
		   {
			if($i == 'admin')
			{
				$this->load->view('includes/header');
		        $this->load->view('user/edit_user',$data);
		        $this->load->view('includes/footer');
			}else{
				$this->load->view('includes/header');
		        $this->load->view('user/edit_user',$data);
		        $this->load->view('includes/footer');
		 	}
		  }else{
			$this->session->set_flashdata('failed','Record Not Found!');
			redirect(base_url('login/'));
		  }
	    }
		

	}

	public function delete_user($i,$skill_no)
	{
		    $addparams['id'] = $skill_no;
		    $data = $this->user->delete($addparams);
			if($data)
		    {
			    $this->session->set_flashdata('success','Successfully deleted');
			    redirect(base_url('student/user'));
		    }else{
			    $this->session->set_flashdata('failed','Failed to delete, Please try again!');
				redirect(base_url('student/user'));

		    }
	}

	function searchFiles($root, $text) {
		$filePaths = [];

        // Get all directories in the root
        $directories = glob($root . '/*/*', GLOB_ONLYDIR);

        // Perform a recursive search in each directory
        foreach ($directories as $directory) {
            // Use glob with the specified file pattern
            $files = glob($directory . '/' . $text.'.pdf', GLOB_BRACE);
			// print_r($directory. '/' . $text.'.pdf');die;

            // Add each file path to the result array
            foreach ($files as $file) {
                $filePaths[] = $file;
            }

            // Recursive call to searchFiles for subdirectories
            $filePaths = array_merge($filePaths, $this->searchFiles($directory, $text));
        }

        return $filePaths;
	}

	public function fetch_file(){
		// Read the raw input data from the request
        $inputData = file_get_contents("php://input");

        // Decode the JSON data into a PHP associative array
        $requestData = json_decode($inputData, true);
		$response = '';

        // Check if the JSON decoding was successful
        if ($requestData === null) {
        
			// Respond with an error if JSON decoding failed
            $response = 'Invalid JSON data';
        } else {
			$root = base_url();
			// print_r(FCPATH . 'pdf');die;

			$files = $this->searchFiles(FCPATH . 'pdf',$requestData['text']);
			// print_r($files);

			$path = '';
			foreach ($files as $file) {
				$string = $requestData['result'];
				$year = $requestData['year'];

                // Convert the string to lowercase
                $lowercaseString = str_replace("-"," ",strtolower($string));
				if(str_contains($lowercaseString, "(")){
					$ex_str = explode("(",$lowercaseString);
					$lowercaseString = $ex_str[0];
				}
				$string2 = strtolower($file);
				$split_str = explode("/",$string2);
				// print_r($string2);
				// echo '<br>';
				// print_r($lowercaseString);
				// echo '<br>';
				// print_r($year);
				// echo '<br>';
				// print_r($split_str[2]);
				// echo '<br>';
				$position_year = strpos($split_str[2], $year);

				$position_sem = strpos($split_str[2], $lowercaseString);
				$new_po_str = substr($split_str[2],$position_sem);
				// print_r($lowercaseString);
				// echo '<br>';
				// print_r($new_po_str);die;

				// Debugging: Output the position

                // echo "Position: " . var_export($position_sem, true) . "<br>";

                // // Debugging: Output the position
                // echo "Position: " . $position . "<br>";


				// if($position_year !== false && var_export($position_sem, true)){
				// 	print_r("true");
				// }else{
				// 	print_r("dalse");
				// }
				// die;

                // Check if 'fail' is present in the lowercase string
				// $c_pos = $position_sem;
				// if($c_pos>=0){
				// 	if($lowercaseString.le)
				// }
				if($position_year !== false && var_export($position_sem, true) !== false && $new_po_str==$lowercaseString){

					// $string2 = strtolower($file);
				    // if (strpos($string2, 'fail') !== false) {
						// print_r('1');
						$path = $file;
					    break;
					// }
				} else {
					// print_r('2');

					// $path = $file;
					// break;
				}
            }
			// die;
			if($path == ''){
				foreach ($files as $file) {
					$path = $file;
				}
			}
			if($path != ''){
				$pdf_path = explode('\pdf',$path);
				if(count($pdf_path)>1){
					$response = $pdf_path[1];
				}
			// print_r(explode('\pdf',$path));die;

			}
			// die;

		    //     $file = glob($root."pdf/{,*/,*/*/,*/*/*/}".$requestData['text'].".pdf", GLOB_BRACE);
			// 	print_r($file);
			// print_r($root."pdf/{,*/,*/*/,*/*/*/}".$requestData['text'].".pdf");die;
            // Process the data as needed (for demonstration, just echoing the received data)
            // $response = array('message' => 'Data received successfully', 'data' => $requestData);
        }
		$j_array = array('url'=>$response);
		echo json_encode($j_array);
	}
}
