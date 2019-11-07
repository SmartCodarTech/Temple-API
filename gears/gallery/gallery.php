<?php

 use Engine\Core\Controller ;
 
 class Gallery extends Controller{

    /*
    ==== Name Of Gear
    */
    private $gear = "gallery";
    
    function index(){

        do_login();
        user_permissions();
        global $wear;
        $template = $this->loadView($wear->back . "/gallery/gallery");
        $photo = $this->loadModel($this->gear,"sun_gallery_model");
        $group = $this->loadModel($this->gear,"sun_gallery_group_model");
        $photos = $photo->get_gallery();
        $groups = $group->get_groups();
        $template->set("groups" , $groups);
        $template->set("items" , $photos);
        $template->set("page" , SITE_NAME . " | Gallery Items");
        $template->render();
          
    }

    function addItem(){

        global $wear;
        global $session;
        do_login();
        user_permissions();
        $template = $this->loadView($wear->back . "/gallery/add");
        $photo = $this->loadModel($this->gear,"sun_photos_model");
        $photos = $photo->get_photos();
        $template->set("photos" , $photo);
        $template->set("page" , SITE_NAME . " | gallery Add Item ");
        $template->render();
        
        
    }
    function addGroup(){
   
    $login = $this->loadModel($this->gear,"sun_gallery_group_model");
    $login->create_group();
        
        
    }
    function saveGroup($id){
   
    $login = $this->loadModel($this->gear,"sun_gallery_group_model");
    $login->save_group($id);
        
        
    }
    
    function deleteGroup($id){
   
    $login = $this->loadModel($this->gear,"sun_gallery_group_model");
    $login->delete_group($id);
        
        
    }
    
    
    function addGalleryItem($id){
   
    $login = $this->loadModel($this->gear,"sun_gallery_model");
    $login->create_gallery_item($id);
        
        
    }
    function saveGalleryItem(){
   
    $login = $this->loadModel($this->gear,"sun_gallery_model");
    $login->save_gallery_item();
        
        
    }
     function deleteGalleryItem($id){
   
    $login = $this->loadModel($this->gear,"sun_gallery_model");
    $login->delete_gallery_item($id);
        
        
    }
    
    
    

 }
