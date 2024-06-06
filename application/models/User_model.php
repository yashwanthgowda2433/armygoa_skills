<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_table extends CI_Model {
    public static $table_name = 'user';
	public static $id = 'id';
	public static $name = 'name';
	public static $email = 'email';
	public static $password = 'password';
	public static $mobile = 'mobile';
	public static $created_on = 'created_on';
	public static $modified_on = 'modified_on';
}

class User_model extends User_table {

    public function view($params=[])
    {
        $sql = self::$id.' as id,'
               .self::$name.' as name,'
               .self::$email.' as email,'
               .self::$mobile.' as mobile,'
               .self::$password.' as password,'
               .self::$created_on.' as created_on,'
               .self::$modified_on.' as modified_on' ;

        $this->db->select($sql);
        if(!empty($params['email']))
        {
            // $this->db->where(self::$name, $params['email']);
            $this->db->where(self::$email, $params['email']);
            // $this->db->or_where(self::$mobile, $params['email']);

        }
        if(!empty($params['search']))
        {
            $this->db->like(self::$name, $params['search']);
            $this->db->or_like(self::$email, $params['search']);
            $this->db->or_like(self::$mobile, $params['mobile']);

        }
       
        if(isset($params['start']) && isset($params['end']))
		{
			$this->db->limit($params['end'],$params['start']);
		}
        if(isset($params['password']))
        {
            $this->db->where(self::$password,$params['password']);

            $query = $this->db->get(self::$table_name);
        // print_r($this->db->last_query());exit;

            return $query->row();


        }
        else if(isset($params['id']))
        {
            $this->db->where(self::$id,$params['id']);

            $query = $this->db->get(self::$table_name);
            return $query->row();


        }
        else{
            $this->db->where(self::$name.' != ', 'AdminG2320');

            $query = $this->db->get(self::$table_name);
            // echo $this->db->last_query();exit;

            return $query->result();

        }
        

    }

    public function count($params=[])
    {
        $sql = '*';
        $this->db->select($sql);
        if(!empty($params['email']))
        {
            $this->db->where(self::$name, $params['email']);
            $this->db->or_where(self::$email, $params['email']);
        }
       
        // if(isset($params['start']) && isset($params['end']))
		// {
		// 	$this->db->limit($params['end'],$params['start']);
		// }
        $query = $this->db->get(self::$table_name);
        
        return $query->num_rows();
        

    }

    public function add($params=[])
    {
        $date = new DateTime();
        if(!empty($params['name']))
        {
            $this->db->set(self::$name, $params['name']);
        }
        if(!empty($params['email']))
        {
            $this->db->set(self::$email, $params['email']);
        }
        if(!empty($params['name']))
        {
            $this->db->set(self::$name, $params['name']);
            
        }
        if(!empty($params['password']))
        {
            $this->db->set(self::$password, $params['password']);
        }
        if(!empty($params['mobile']))
        {
            $this->db->set(self::$mobile, $params['mobile']);
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
        
        if(!empty($params['name']))
        {
            $this->db->set(self::$name, $params['name']);
        }
        if(!empty($params['email']))
        {
            $this->db->set(self::$email, $params['email']);
        }
        if(!empty($params['name']))
        {
            $this->db->set(self::$name, $params['name']);
            
        }
        if(!empty($params['mobile']))
        {
            $this->db->set(self::$mobile, $params['mobile']);
        }
        if(!empty($params['password']))
        {
            $this->db->set(self::$password, $params['password']);
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