<?php
use Engine\Helpers\Resize;

class Sun_gallery_model extends Model
{
	
	protected $table = "gallery";
	protected static $db_fields = [
									'id', 
									'element_id', 
									'caption', 
									'element_type', 
									'created_at'
	];
	
	
  /*****************************************
  *
  * @ VOID 
  * Add Gallery Item.
  *
  ******************************************/

	public function create_gallery_item($id) {
		global $session;
		global $csrf;
		
		if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) {
			
			if (isset($_POST['submit'])) {
        
        $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'caption' => $_POST['caption'],
                  'element_type'=>$_POST['element_type'],
                  'gallery_group'=>$_POST['gallery_group']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#

        $valid->field('caption')->required()->length(4,200);
        $valid->field('element_type')->required()->length(3,40);
        $valid->field('gallery_group')->required()->length(1,11)->toInt();
				
				if (empty($errors)) {
					
					$created_at = strftime("%y-%m-%d %H:%M:%S", time());
					
					$element_id = $id;
					
					$sql = "INSERT INTO " . $this->table . "(
															  caption,
															  element_id,
															  element_type,
															  gallery_group,
															  created_at
															 ) VALUES(
															 :caption,
															 :element_id,
															 :element_type,
															 :gallery_group,
															 :created_at
															 )";
					$create = $this->query(
											$sql,
											[
											'caption' => $_POST['caption'], 
											'element_id' => $element_id, 
											'element_type' => $_POST['element_type'], 
											'gallery_group' => $_POST['gallery_group'], 
											'created_at' => $created_at]
					);
					
					if ($create) {
						
						if ($_POST['element_type'] == "Image") {

							$session->message("The Item Has Been Added To The Gallery");
							redirect_to(BASE_URL . "media/");

						} elseif ($_POST['element_type'] == "Embedded Video" || 
								  $_POST['element_type'] == "Video") {
							
							$session->message("The Item Has Been Added To The Gallery");
							redirect_to(BASE_URL . "media/videos");

						} else {

							$session->message("The Item Has Been Added To The Gallery");
							redirect_to(BASE_URL . "media/audio");

						}
					} else {

						if ($_POST['element_type'] == "Image") {

							$session->message("Something Went Wrong");
							redirect_to(BASE_URL . "media/");

						} elseif ($_POST['element_type'] == "Embedded Video" || 
							      $_POST['element_type'] == "Video") {
							
							$session->message("Something Went Wrong");
							redirect_to(BASE_URL . "media/videos");

						} else {

							$session->message("Something Went Wrong");
							redirect_to(BASE_URL . "media/audio");

						}
					}
				} else {

					if (count($errors) == 1) {
						
						if ($_POST['element_type'] == "Image") {

							$session->message("There Was An Error.<br/>" . join("<br/>", $errors));
							redirect_to(BASE_URL . "media/");

						} elseif ($_POST['element_type'] == "Embedded Video" || 
								  $_POST['element_type'] == "Video") {
							
							$session->message("There Was An Error.<br/>" . join("<br/>", $errors));
							redirect_to(BASE_URL . "media/videos");

						} else {

							$session->message("There Was An Error.<br/>" . join("<br/>", $errors));	
							redirect_to(BASE_URL . "media/audio");

						}

					} else {
						if ($_POST['element_type'] == "Image") {

							$session->message("There Were Errors.<br/>" . join("<br/>", $errors));
							redirect_to(BASE_URL . "media/");

						} elseif ($_POST['element_type'] == "Embedded Video" || 
								  $_POST['element_type'] == "Video") {
							
							$session->message("There Were Errors.<br/>" . join("<br/>", $errors));
							redirect_to(BASE_URL . "media/videos");

						} else {

							$session->message("There Were Errors.<br/>" . join("<br/>", $errors));							
							redirect_to(BASE_URL . "media/audio");

						}
					}
				}
			} else {
				 // Form has not been submitted.
				
				if ($_POST['element_type'] == "Image") {

					$session->message("Submit Form");
					redirect_to(BASE_URL . "media/");

				} elseif ($_POST['element_type'] == "Embedded Video" || 
						  $_POST['element_type'] == "Video") {
					
					$session->message("Submit Form");
					redirect_to(BASE_URL . "media/videos");

				} else {
					$session->message("Submit Form");
					
					redirect_to(BASE_URL . "media/audio");

				}
			}
		} else {
			
			if ($_POST['element_type'] == "Image") {

				$session->message("Refresh The Page And Try Again");
				redirect_to(BASE_URL . "media/");

			} elseif ($_POST['element_type'] == "Embedded Video" || 
					  $_POST['element_type'] == "Video") {
				
				$session->message("Refresh The Page And Try Again");
				redirect_to(BASE_URL . "media/videos");

			} else {

				$session->message("Refresh The Page And Try Again");
				redirect_to(BASE_URL . "media/audio");

			}
		}
	}
	
	
  /*****************************************
  *
  * @ Array Of Objects 
  * Gallery Item.
  *
  ******************************************/

	function get_gallery() {
		
		$sql = "SELECT * FROM " . $this->table;
		$new = $this->query($sql, null, PDO::FETCH_OBJ);
		return $new;
	}

  /*****************************************
  *
  * @ Object 
  * Gallery Item.
  *
  ******************************************/

	function find_gallery($id) {
		
		$id = $id;
		$sql = "SELECT * FROM " . $this->table . " WHERE id=:id LIMIT 1";
		$new = $this->query($sql, array("id" => $id), PDO::FETCH_OBJ);
		if (!empty($new)) {
			return array_shift($new);
		} else {
			return $new;
		}
	}
	
	
	function delete_gallery_item($id) {
		
		global $session;
		$id = $id;
		
		$sql = "DELETE FROM " . $this->table . " WHERE id=:id LIMIT 1";
		$new = $this->query($sql, array("id" => $id));
		
		if ($new) {
			
			$session->message("The Item Was Deleted");
			redirect_to(BASE_URL . "gallery");
		} else {
			
			$session->message("The Item Was Not Deleted");
			redirect_to(BASE_URL . "gallery");
		}
	}
}
