<?php

function get_editing_mode(){
    global $database;
        $name = "Editing Mode";
        $sql = "SELECT * FROM settings 
                                      WHERE 
                                      name=:name 
                                      LIMIT 1";       
        $new = $database->query(
                                $sql,
                                [
                                "name"=>$name
                                ],
                                PDO::FETCH_OBJ
        );
        if(!empty($new)){

            $setting = array_shift($new);
            if($setting->value === "Active"){
        
        return 'true';
    
          }else{
        
        return 'false';
             }

        }else{

            return 'false';
        }

}

function editing_core(){
  global $session;
  global $wear;
  $do_plug = "";
 
  if(get_editing_mode() === "true" && $session->is_logged_in()){

    if(get_user_level($session->user_id) === "Editor" || 
       get_user_level($session->user_id) === "Top Manager" || 
       get_user_level($session->user_id) === "Developer" ){
    
    $do_plug .= "<link rel=\"stylesheet\" href=\"". BASE_URL . "common/gears/manage/css/edit_mode.css " ."\" />";
    $do_plug .= "<link rel=\"stylesheet\" href=\"". BASE_URL . "common/gears/manage/css/jquery-impromptu.min.css " ."\" />";
    $do_plug .= "<script type=\"text/javascript\" src=\"" . BASE_URL . "common/gears/manage/js/edit_mode.js\"" ."></script>";
    $do_plug .= "<script type=\"text/javascript\" src=\"" . BASE_URL . "common/gears/manage/js/jquery-impromptu.min.js\"" ."></script>";

    }

  }
  
  return $do_plug;
  
}

function get_edit_panel(){
      global $wear;
      global $session;

    $panel = '';
      if(get_user_level($session->user_id) === "Editor" || 
       get_user_level($session->user_id) === "Top Manager" || 
       get_user_level($session->user_id) === "Developer" ){

    $panel.= '<div class="notice"></div>';

      }
    
    return $panel; 
    
}

function get_edit_upload_form(){
   global $session;
    global $wear;
    $panel = '';
 
      if(get_user_level($session->user_id) === "Editor" || 
       get_user_level($session->user_id) === "Top Manager" || 
       get_user_level($session->user_id) === "Developer" ){
    $panel .= '<div class="uploadform text-center padding-bottom2">';    
    $panel .= '<form action="'.BASE_URL.'manage/editupload" method="POST" enctype="multipart/form-data" style="margin-bottom: 5px !important;">';
    $panel .= '<div class="form-group text-center">';
    $panel .= '<div class="col-sm-7 text-center">';
    $panel .= '<input  type="file" title="Select Image To Upload" class="btn btn-sm btn-info m-b-sm" name="image">';
    $panel .= '<input  type="hidden" id="uploadfolder" name="folder" value="">';
    $panel .= '<input type="hidden" name="filename" value="" id="uploadfilename">';
    $panel .= '<input type="hidden" name="type" value="" id="type">';
    $panel .= '<input type="hidden" name="height" value="" id="height">';
    $panel .= '<input type="hidden" name="width" value="" id="width">';
    $panel .= "</div>";
    $panel .= '<div class="col-sm-2">';
    $panel .= ' <div class="lato-light text-center btn btn-primary white text-capi">';
    $panel .= '<input type="checkbox" name="crop"  class=""> Crop</div>';
    $panel .= "</div>";
    $panel .= '<div class="col-sm-3 ">';
    $panel .= '<input type="submit" name="submit" style="font-size: 16px !important;" class="btn text-size-16  btn-success form-inline" value="Upload">';
    $panel.= '</div></div>';
    $panel .= '</form>'; 

 }
    return $panel; 
    
}


function get_page_data($data){


    if(empty($data)){

        echo htmlentities("Data Is Empty Or Has Not Been Created");

    }else{

        echo $data;
    }

}