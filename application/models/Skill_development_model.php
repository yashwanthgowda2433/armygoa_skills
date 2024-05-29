<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skill_development_table extends CI_Model {
    public static $table_name = 'skill_development';
	public static $id = 'id';
	public static $scheme_of_examination = 'scheme_of_examination';
	public static $trade = 'trade';
	public static $roll_no = 'roll_no';
	public static $name = 'name';
	public static $password = 'password';
	public static $iti_center = 'iti_center';
	public static $session = 'session';
	public static $annual_or_semester = 'annual_or_semester';
	public static $annual_or_semester_details = 'annual_or_semester_details';
	public static $pass_out_year = 'pass_out_year';
	public static $result = 'result';
	public static $link = 'link';
    public static $pdf_link = 'pdf_link';
	public static $created_on = 'created_on';
	public static $modified_on = 'modified_on';
}

class Skill_development_model extends Skill_development_table {

    public function view($params=[])
    {
        $sql = self::$id.' as id,'
               .self::$scheme_of_examination.' as scheme_of_examination,'
               .self::$trade.' as trade,'
               .self::$roll_no.' as roll_no,'
               .self::$name.' as name,'
               .self::$iti_center.' as iti_center,'
               .self::$session.' as session,'
               .self::$annual_or_semester.' as annual_or_semester,'
               .self::$annual_or_semester_details.' as annual_or_semester_details,'
               .self::$pass_out_year.' as pass_out_year,'
               .self::$result.' as result,'
               .self::$link.' as link,'
               .self::$pdf_link.' as pdf_link,'
               .self::$created_on.' as created_on,'
               .self::$modified_on.' as modified_on' ;
        $this->db->select($sql);
        if(!empty($params['scheme_of_examination']) && $params['scheme_of_examination']!="All")
        {
            $this->db->where(self::$scheme_of_examination, $params['scheme_of_examination']);
        }
        if(!empty($params['trade']) && $params['trade']!="All")
        {
            $this->db->where(self::$trade, $params['trade']);
        }
        if(!empty($params['roll_no']))
        {
            $this->db->like(self::$roll_no, $params['roll_no']);
        }
        if(!empty($params['name']))
        {
            $this->db->like(self::$name, $params['name']);
        }
        if(!empty($params['iti_center']) && $params['iti_center']!="All")
        {
            $this->db->where(self::$iti_center, $params['iti_center']);
        }
        if(!empty($params['sem_details']) && $params['sem_details']!="All")
        {
            $this->db->where(self::$annual_or_semester_details, $params['sem_details']);
        }
        if(!empty($params['pass_out_year']) && $params['pass_out_year']!="All")
        {
            $this->db->where(self::$pass_out_year, $params['pass_out_year']);
        }
        if(!empty($params['result']) && $params['result']!="All")
        {
            $this->db->where(self::$result, $params['result']);
        }
        if(isset($params['start']) && isset($params['end']))
		{
			$this->db->limit($params['end'],$params['start']);
		}
        if(isset($params['skill_no']))
        {
            $this->db->where(self::$id,$params['skill_no']);

            $query = $this->db->get(self::$table_name);
            return $query->row();


        }else{
            $this->db->where(self::$roll_no.' != ', 'admin1');

            $query = $this->db->get(self::$table_name);
        // echo $this->db->last_query();exit;

            return $query->result();

        }
        

    }

    public function count($params=[])
    {
        $sql = '*';
        $this->db->select($sql);
        if(!empty($params['scheme_of_examination']) && $params['scheme_of_examination']!="All")
        {
            $this->db->where(self::$scheme_of_examination, $params['scheme_of_examination']);
        }
        if(!empty($params['trade']) && $params['trade']!="All")
        {
            $this->db->where(self::$trade, $params['trade']);
        }
        if(!empty($params['roll_no']))
        {
            $this->db->like(self::$roll_no, $params['roll_no']);
        }
        if(!empty($params['name']))
        {
            $this->db->like(self::$name, $params['name']);
        }
        if(!empty($params['iti_center']) && $params['iti_center']!="All")
        {
            $this->db->where(self::$iti_center, $params['iti_center']);
        }
        if(!empty($params['sem_details']) && $params['sem_details']!="All")
        {
            $this->db->where(self::$annual_or_semester_details, $params['sem_details']);
        }
        if(!empty($params['pass_out_year']) && $params['pass_out_year']!="All")
        {
            $this->db->where(self::$pass_out_year, $params['pass_out_year']);
        }
        if(!empty($params['result']) && $params['result']!="All")
        {
            $this->db->where(self::$result, $params['result']);
        }
       
        // if(isset($params['start']) && isset($params['end']))
		// {
		// 	$this->db->limit($params['end'],$params['start']);
		// }
        $query = $this->db->get(self::$table_name);
        if(!empty($params['search']))
        {
            return $query->num_rows();
        }else{
            return $query->num_rows();
        }

    }

    public function get_scheme_of_examination(){
        $this->db->select('scheme_of_examination');
        $this->db->group_by('scheme_of_examination');
        $this->db->order_by("scheme_of_examination", "asc");
        $query = $this->db->get(self::$table_name);
        return $query->result();
    }
    public function get_trade(){
        $this->db->select('trade');
        $this->db->group_by('trade');
        $this->db->order_by("trade", "asc");

        $query = $this->db->get(self::$table_name);
        return $query->result();
    }
    public function get_iti_center(){
        $this->db->select('iti_center');
        $this->db->group_by('iti_center');
        $this->db->order_by("iti_center", "asc");

        $query = $this->db->get(self::$table_name);

        return $query->result();
    }
    public function get_pass_out_year(){
        $this->db->select('pass_out_year');
        $this->db->group_by('pass_out_year');
        $this->db->order_by("pass_out_year", "asc");

        $query = $this->db->get(self::$table_name);
        return $query->result();
    }
    public function get_annual_or_semester(){
        $this->db->select('annual_or_semester_details as annual_or_semester');
        $this->db->group_by('annual_or_semester_details');
        $this->db->order_by("annual_or_semester_details", "asc");

        $query = $this->db->get(self::$table_name);
        return $query->result();
    }
    public function get_result(){
        $this->db->select('result');
        $this->db->group_by('result');
        $query = $this->db->get(self::$table_name);
        // echo $this->db->last_query();exit;
        return $query->result();
    }
    public function add($params=[])
    {
        $date = new DateTime();
        if(!empty($params['scheme_of_examination']))
        {
            $this->db->set(self::$scheme_of_examination, $params['scheme_of_examination']);
        }
        if(!empty($params['trade']))
        {
            $this->db->set(self::$trade,$params['trade']);
        }
        if(!empty($params['roll_no']))
        {
            $this->db->set(self::$roll_no,$params['roll_no']);
        }
        if(!empty($params['name']))
        {
            $this->db->set(self::$name,$params['name']);
            $this->db->set(self::$password,$params['name']."@2023");

        }
        if(!empty($params['iti_center']))
        {
            $this->db->set(self::$iti_center,$params['iti_center']);
        }
        if(!empty($params['session']))
        {
            $this->db->set(self::$session,$params['session']);
        }
        if(!empty($params['annual_or_semester']))
        {
            $this->db->set(self::$annual_or_semester,$params['annual_or_semester']);
        }
        if(!empty($params['annual_or_semester_details']))
        {
            $this->db->set(self::$annual_or_semester_details,$params['annual_or_semester_details']);
        }
        if(!empty($params['pass_out_year']))
        {
            $this->db->set(self::$pass_out_year,$params['pass_out_year']);
        }
        if(!empty($params['result']))
        {
            $this->db->set(self::$result,$params['result']);
        }
        if(!empty($params['link']))
        {
            $this->db->set(self::$link,$params['link']);
        }
        if(!empty($params['pdf_link']))
        {
            $this->db->set(self::$pdf_link, $params['pdf_link']);
        }
        
        $this->db->set(self::$created_on,$date->format('Y-m-d H:i:s'));
        
        
        $this->db->set(self::$modified_on,$date->format('Y-m-d H:i:s'));

        $query = $this->db->insert(self::$table_name);
        if($this->db->affected_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
    }

    public function edit($params=[])
    {
        $date = new DateTime();
        if(!empty($params['scheme_of_examination']))
        {
            $this->db->set(self::$scheme_of_examination, $params['scheme_of_examination']);
        }
        if(!empty($params['trade']))
        {
            $this->db->set(self::$trade,$params['trade']);
        }
        if(!empty($params['roll_no']))
        {
            $this->db->set(self::$roll_no,$params['roll_no']);
        }
        if(!empty($params['name']))
        {
            $this->db->set(self::$name,$params['name']);
           // $this->db->set(self::$password,$params['name']."@2023");

        }
        if(!empty($params['iti_center']))
        {
            $this->db->set(self::$iti_center,$params['iti_center']);
        }
        if(!empty($params['session']))
        {
            $this->db->set(self::$session,$params['session']);
        }
        if(!empty($params['annual_or_semester']))
        {
            $this->db->set(self::$annual_or_semester,$params['annual_or_semester']);
        }
        if(!empty($params['annual_or_semester_details']))
        {
            $this->db->set(self::$annual_or_semester_details,$params['annual_or_semester_details']);
        }
        if(!empty($params['pass_out_year']))
        {
            $this->db->set(self::$pass_out_year,$params['pass_out_year']);
        }
        if(!empty($params['result']))
        {
            $this->db->set(self::$result,$params['result']);
        }
        if(!empty($params['link']))
        {
            $this->db->set(self::$link,$params['link']);
        }
        if(!empty($params['pdf_link']))
        {
            $this->db->set(self::$pdf_link, $params['pdf_link']);
        }
        
        $this->db->set(self::$modified_on,$date->format('Y-m-d H:i:s'));
        if(!empty($params['id']))
        {
            $this->db->where(self::$id,$params['id']);
            $query = $this->db->update(self::$table_name);
            if($this->db->affected_rows() > 0)
		    {
			   return TRUE;
		    }else{
			   return FALSE;
		    }
        }
        
    }

    public function delete($params=[])
    {
        if(!empty($params['id']))
        {
            $this->db->where(self::$id,$params['id']);
            $query = $this->db->delete(self::$table_name);
            if($this->db->affected_rows() > 0)
		    {
			   return TRUE;
		    }else{
			   return FALSE;
		    }
        }else{
            return FALSE;
        }
    }

    public function get($params=[])
    {
        if(!empty($params['user_name']))
        {
            $this->db->where(self::$name,$params['user_name']);
        }

        if(!empty($params['password']))
        {
            $this->db->where(self::$password,$params['password']);
        }

        if(!empty($params['skill_id']))
        {
            $this->db->where(self::$id,$params['skill_id']);
        }
        $this->db->order_by(self::$id,'desc');
        $this->db->limit(1);
        $query = $this->db->get(self::$table_name);
        if($query){
            return $query->row();
        }
        else{
            return false;
        }
    }
}