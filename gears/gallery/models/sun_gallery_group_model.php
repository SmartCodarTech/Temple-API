<?php
use Engine\Helpers\Resize;

class Sun_gallery_group_model extends Model
{

		protected $table= "gallery_groupings";
		protected static $db_fields = [
											'id', 
											'name', 
											'created_at'
		];
    
  /*****************************************
  *
  * @ VOID 
  * Create Gallery Group.
  *
  ******************************************/  

    public function create_group() {
	global $session;
	global $csrf;
		
		if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) {
			
			if (isset($_POST['submit'])) {
				        
        
        $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'name' => $_POST['name']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#

        $valid->field('name')->required()->length(4,200);
        
        #---- Check For any Errors ------#
			
			if (empty($errors)) {
				
				$created_at = strftime("%y-%m-%d %H:%M:%S", time());
				
				$file = $filename;
				
				$sql = "INSERT INTO " . $this->table . 
				                                     " (
				                                     	name,
				                                     	created_at
				                                     	) VALUES(
				                                     	:name,
				                                     	:created_at
				                                     	) ";
				$create = $this->query(
										$sql, 
										[
										'name' => $_POST['name'], 
										'created_at' => $created_at
										]
				);
				
				if ($create) {
					
					$session->message("The Gallery Grouping Has  Been Successfully Saved.");
					redirect_to(BASE_URL . "gallery/");

				} else {

					$session->message("Something Went Wrong");
					redirect_to(BASE_URL . "gallery/");

				}
			} else {
				if (count($errors) == 1) {

					$session->message("There Was An Error.<br/>" . join("<br/>", $errors));
					redirect_to(BASE_URL . "gallery/");

				} else {

					$session->message("There were errors <br/>" . join("<br/>", $errors));
					redirect_to(BASE_URL . "gallery/");

				}

			}
		} else {
			 // Form has not been submitted.
			
			$session->message("Submit Form ");
			redirect_to(BASE_URL . "gallery/");
		}

		} else {
			
			$session->message("Refresh The Page And Try Again");
			redirect_to(BASE_URL . "gallery/");
		}
	}

    

  /*****************************************
  *
  * @ VOID 
  * Save Gallery Group.
  *
  ******************************************/

    public function save_group($id) {
		global $session;
		global $csrf;
		$id = $id;
		if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) {
			
	    if (isset($_POST['submit'])) {
        $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'name' => $_POST['name']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#

        $valid->field('name')->required()->length(4,200);
        
        #---- Check For any Errors ------#
				
				if (empty($errors)) {
					
					$sql = "UPDATE " . $this->table2 . " SET 
															name=:name 
															WHERE 
															id = :id";
					$update = $this->query(
											$sql, 
											[
											'name' => $_POST['name'], 
											'id' => $id
											]
					);
					
					if ($update) {
						
						$session->message("The Group Has  Been Successfully Saved.");
						redirect_to(BASE_URL . "gallery/");

					} else {

						$session->message("Something Went Wrong . Nothing Was Changed");
						redirect_to(BASE_URL . "gallery/");
					}
				} else {

					if (count($errors) == 1) {

						$session->message("There Was An Error.<br/>" . join("<br/>", $errors));
						redirect_to(BASE_URL . "gallery/");

					} else {

						$session->message("There were errors <br/>" . join("<br/>", $errors));
						redirect_to(BASE_URL . "gallery/");
					}
				}
			} else {
				 // Form has not been submitted.
				
				$session->message("Submit Form ");
				redirect_to(BASE_URL . "gallery/");

			}

		} else {
			
			$session->message("Refresh The Page And Try Again");
			redirect_to(BASE_URL . "gallery/");

		}

	}
    
      /*****************************************
  *
  * @ Array of Objects
  * Add Gallery Item.
  *
  ******************************************/
    function get_groups() {
		
		$sql = "SELECT * FROM " . $this->table;
		$new = $this->query(
							$sql, 
							null, 
							PDO::FETCH_OBJ
		);
		return $new;
	}
    

      /*****************************************
  *
  * @ Object 
  * Gallery ggroup
  *
  ******************************************/
	function find_group($id) {
		
		$id = $id;
		$sql = "SELECT * FROM " . $this->table . " 
												  WHERE 
												  id=:id 
												  LIMIT 1";
		$new = $this->query(
							$sql, 
							[
							"id" => $id
							], 
							PDO::FETCH_OBJ
		);

		if (!empty($new)) {

			return array_shift($new);

		} else {

			return $new;

		}
	}
	

	  /*****************************************
  *
  * @ VOID 
  * Delete Gallery 'Group'.
  *
  ******************************************/
	function delete_group($id) {
		global $session;
		$id = $id;
		
		$sql = "DELETE FROM " . $this->table . " 
												WHERE 
												id=:id 
												LIMIT 1";
		$new = $this->query(
							$sql,
							[
							"id" => $id
							]
		);
		
		if ($new) {
			
			$session->message("The Group Was Deleted");
			redirect_to(BASE_URL . "gallery/");

		} else {
			
			$session->message("The Group Was Not Deleted");
			redirect_to(BASE_URL . "gallery/");

		}
	}

}