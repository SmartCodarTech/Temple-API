<?php
use Engine\Helpers\Resize;

class Sun_embedded_videos_model extends Model
{
	
	protected $table = "embedded_videos";
	protected static $db_fields = [
									'id',
									'caption', 
									'link', 
									'description', 
									'created_at'
	];
	



  /*****************************************
  *
  * @ VOID 
  * Create New Embedded Video.
  *
  ******************************************/

	public function create_video() {
		global $session;
		global $csrf;
		
		if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) {
			
			if (isset($_POST['submit'])) {
			
				
				$errors = [];
				//-----Set The Data To be validated ------#
				
				$data = [
							'caption' => $_POST['caption'], 
							'link' => $_POST['link'], 
							'description' => $_POST['description'] 
				];
				//-----Instantiate Validation Class ------#
				
				$valid = new Engine\Helpers\InputValidator($data);
				//-----Start Validation ------#
				
				$valid->field('caption')->required()->length(4, 200);
				$valid->field('link', 'Video Link')->required()->length(10, 600);
				$valid->field('description')->length(5, 300);
				//---- Check For any Errors ------#
				
				if (!$valid->allValid()) {
					
					$errors = $valid->getErrors();
					 // returns an array of errors indexed by field
					
					
				}
				//---- If No Errors Process The Data ------#
				
				if (empty($errors)) {
					
					$created_at = strftime("%y-%m-%d %H:%M:%S", time());
					
					$sql = "INSERT INTO embedded_videos (
            									caption,
            									link,
            									description,
            									created_at
            									) VALUES(
            									:caption,
            									:link,
            									:description,
            									:created_at
            									)";
					$create = $this->query(
											$sql, 
											[
											'caption' => $_POST['caption'], 
											'link' => $_POST['link'], 
											'description' => $_POST['description'], 
											'created_at' => $created_at
											]
					);
					
					if ($create) {
						
						$session->message("The Video Has  Been Successfully Saved.");
						redirect_to(BASE_URL . "media/uploadMedia");

					} else {
						
						$session->message("Something Went Wrong");
						redirect_to(BASE_URL . "media/uploadMedia");

					}
				} else {

					if (count($errors) == 1) {
						
						$session->message("There Was An Error.<br/>" . join("<br/>", $errors));
						redirect_to(BASE_URL . "media/uploadMedia");

					} else {
						
						$session->message("There were errors . <br/>" . join("<br/>", $errors));
						redirect_to(BASE_URL . "media/uploadMedia");

					}
				}
			} else {
				 // Form has not been submitted.
				
				$session->message("Submit Form ");
				redirect_to(BASE_URL . "media/uploadMedia");
			}
		} else {
			
			$session->message("Refresh The Page And Try Again");
			redirect_to(BASE_URL . "media/uploadMedia");
		}
	}
	


  /*****************************************
  *
  * @ VOID 
  * Save Edited Video Link.
  *
  ******************************************/

	public function save_video($id) {
		global $session;
		global $csrf;
		$id = $id;
		if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) {
			
			if (isset($_POST['submit'])) {

				$errors = [];
				//-----Set The Data To be validated ------#
				
				$data = [
							'caption' => $_POST['caption'], 
				];
				//-----Instantiate Validation Class ------#
				
				$valid = new Engine\Helpers\InputValidator($data);
				//-----Start Validation ------#
				
				$valid->field('caption')->required()->length(4, 200);

				//---- Check For any Errors ------#
				
				if (!$valid->allValid()) {
					
					$errors = $valid->getErrors();
					 // returns an array of errors indexed by field
					
					
				}
				//---- If No Errors Process The Data ------#
				
				if (empty($errors)) {
					
					$sql = "UPDATE " . $this->table . " SET 
															caption=:caption,
															link=:link,
															description=:description
															WHERE 
															id = :id";
					$update = $this->query(
											$sql, 
											[
											'caption' => $_POST['caption'], 
											'link' => $_POST['link'], 
											'description' => $_POST['description'], 
											'id' => $id
											]
					);
					
					if ($update) {
						
						$session->message("The Video Has  Been Successfully Saved.");
						redirect_to(BASE_URL . "media/mediaEditVideoLink/" . $id);

					} else {

						$session->message("Something Went Wrong");
						redirect_to(BASE_URL . "media/mediaEditVideoLink/" . $id);

					}
				} else {

					if (count($errors) == 1) {

						$session->message("There Was An Error.<br/>" . join("<br/>", $errors));
						redirect_to(BASE_URL . "media/mediaEditVideoLink/" . $id);

					} else {

						$session->message("There were errors . <br/>" . join("<br/>", $errors));
						redirect_to(BASE_URL . "media/mediaEditVideoLink/" . $id);

					}

				}

			} else {

				
				$session->message("Submit Form ");
				redirect_to(BASE_URL . "media/mediaEditVideoLink/" . $id);

			}
		} else {
			
			$session->message("Refresh The Page And Try Again");
			redirect_to(BASE_URL . "media/mediaEditVideoLink/" . $id);

		}
	}


	 
  /*****************************************
  *
  * @ array of Objects
  * array or bebbeded video objects.
  *
  ******************************************/

	function get_videos() {
		
		$sql = "SELECT * FROM " . $this->table;
		$new = $this->query($sql, null, PDO::FETCH_OBJ);
		return $new;
	}
	


  /*****************************************
  *
  * @ Object 
  * Rreturns an object of a embedded video.
  *
  ******************************************/

	function find_video($id) {
		
		$id = $id;
		$sql = "SELECT * FROM " . $this->table . " WHERE id=:id LIMIT 1";
		$new = $this->query($sql, array("id" => $id), PDO::FETCH_OBJ);
		if (!empty($new)) {
			return array_shift($new);
		} else {
			return $new;
		}
	}


  /*****************************************
  *
  * @ VOID 
  * Delete Embedded Video.
  *
  ******************************************/
	
	function delete_video($id) {
		global $session;
		$id = $id;
		$sql = "DELETE FROM " . $this->table . " WHERE id=:id LIMIT 1";
		$new = $this->query($sql, array("id" => $id));
		
		if ($new) {
			
			$session->message("The Video Was Deleted");
			redirect_to(BASE_URL . "media/videos");
		} else {
			
			$session->message("The Image Was Not Deleted");
			redirect_to(BASE_URL . "media/videos");
		}
	}
}
