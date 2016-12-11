<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		//constructor function
		parent::__construct();
		//load any required files 
		$this->load->model('employeeModel'); 
		$this->load->library('session');
	}

	public function index()
	{
		$data['num'] = $this->employeeModel->numEmployees();
		$data['employees'] = $this->employeeModel->getAllEmployees();
		$this->load->view('welcome_message',$data);
	}

	

	public function add(){
		//this function responsible for adding employee
		//set rules
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('address','Address','required');
		$this->form_validation->set_rules('telephone','Telephone','required|callback_validPhone');
		$this->form_validation->set_rules('salary','Salary','required|callback_validSalary');
		$this->form_validation->set_rules('birthDate','Birth Date','required|callback_validDate');
		$this->form_validation->set_rules('hireDate','Hire Date','required|callback_validDate');

		if($this->form_validation->run() == false){
			//if there is error in validation
			$this->load->view('addemployee');			
		}else{
			//if there is no errors
			$data = array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'address' => $this->input->post('address'),
					'telephone' => $this->input->post('telephone'),
					'salary' => $this->input->post('salary'),
					'dateOfBirth' => $this->input->post('birthDate'),
					'dateOfHire' => $this->input->post('hireDate')
				);
			if($this->employeeModel->addEmployee($data)){
				//if inserting is done 
				$this->session->set_flashdata('added', 'You have inserted the employee');
                //Redirect to index page with error above
                redirect('home/index');
			}

		}

	}//

	public function edit(){
		$id = $this->uri->segment(3);
		 //set rules
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('address','Address','required');
		$this->form_validation->set_rules('telephone','Telephone','required|callback_validPhone');
		$this->form_validation->set_rules('salary','Salary','required|callback_validSalary');
		$this->form_validation->set_rules('birthDate','Birth Date','required|callback_validDate');
		$this->form_validation->set_rules('hireDate','Hire Date','required|callback_validDate');

		if($this->form_validation->run() == false){
			//if there is error in validation
			$data['data'] = $this->employeeModel->getData($id);
			$this->load->view('editemployee.php',$data);			
		}else{
			//if there is no errors
			
					$name = $this->input->post('name');
					$email = $this->input->post('email');
					$address = $this->input->post('address');
					$telephone = $this->input->post('telephone');
					$salary = $this->input->post('salary');
					$dateOfBirth = $this->input->post('birthDate');
					$dateOfHire = $this->input->post('hireDate');
				$id = $this->uri->segment(3);
				$this->employeeModel->update($id,$name,$email,$address,$telephone,$salary,$dateOfBirth,$dateOfHire);
				//if inserting is done 
				$this->session->set_flashdata('edited', 'You have Edited the employee data');
                //Redirect to index page with error above
                redirect('home/index');
			
		}	
		//end edit page
	}

	public function delete(){
		//delete page 
		$id = $this->uri->segment(3);
		if($this->employeeModel->deleteEmployee($id)){
			$this->session->set_flashdata('deleted', 'You have deleted the employee data');
                //Redirect to index page with error above
                redirect('home/index');
		}
	}

	public function deleteAll(){
		//function to delete all employees
		if($this->employeeModel->deleteAllEmployees()){
			$this->session->set_flashdata('deleteAll', 'You have deleted all employees .');
                //Redirect to index page with error above
                redirect('home/index');
		}
	}

	//validation methods 
	//valid date
	public function validDate($str)
	{
		list($year, $month, $day) = explode('/', $str);	
		if (is_numeric($year) && is_numeric($month) && is_numeric($day)){
       		 return checkdate($month,$day,$year);
    	}else{
    		$this->form_validation->set_message('validDate', 'The %s field must be in format yyyy/mm/dd');
    		return false;
    	}
	}

	//valid phone
	public function validPhone($str)
	{
		if(!preg_match("/^022\d{7}$/", $str) or !strpos($str, '022') === 0){
			$this->form_validation->set_message('validPhone', 'The %s field must begin with 022');
    		return false;	
		}
	}

	//valid salary
	public function validSalary($str)
	{
		if(!is_numeric($str) or $str == 0 or $str < 0){
			$this->form_validation->set_message('validSalary', 'The %s field must be not zero not negative');
    		return false;
		}
	}
	

	//end home controller
}
?>