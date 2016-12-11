<?php 
	class EmployeeModel extends CI_Model{
		
		public function addEmployee($data){
			//function to add new employee
			return $this->db->insert('employess',$data);
		}

		public function editEmployee($id,$data){
			//function to edit employee data by id
			$this->db->where('id',$id);
			return $this->db->update('employess',$data);
		}

		public function update($id,$name,$email,$address,$telephone,$salary,$dateOfBirth,$dateOfHire){
			$query = "UPDATE employess SET name='$name',email='$email',address='$address',telephone='$telephone',salary='$salary',dateOfBirth='$dateOfBirth',dateOfHire='$dateOfHire' WHERE id=$id";
			return $this->db->query($query);
			//end update 
		}

		public function deleteEmployee($id){
			//function to delete specific employee by id
			$this->db->where('id',$id);
			return $this->db->delete('employess');
		}

		public function deleteAllEmployees(){
			//function to delete all employees
			return $this->db->query('truncate table employess');
		}

		public function numEmployees(){
			//function to know number of employees in database
			$query = $this->db->get('employess');
			return $query->num_rows();
		}

		public function getData($id){
			//function to get employee data
			$this->db->where('id',$id);
			$query = $this->db->get('employess');
			return $query->row();
		}

		public function getAllEmployees(){
			//function to get all employees from database
			$query = $this->db->get('employess');
			return $query->result();
		}

	}
?>