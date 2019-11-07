<?php

 use Engine\Core\Controller ;
 
 class Media extends Controller{
    
     /*
    ==== Name Of Gear
    */
    private $gear = "media";


    #-----Get All Images -------#

    function index(){

        global $wear;
        global $session;
        do_login();
        user_permissions();
        $template = $this->loadView($wear->back . "/media/images");
        $photo = $this->loadModel($this->gear ,"sun_photos_model");
        $photos = $photo->get_photos();
        $template->set("photos" , $photo);
        $template->set("page" , SITE_NAME . " | Media Board");
        $template->render();
        
    }


    #-----Get All Audio -------#

    function audio(){

        global $wear;
        global $session;
        do_login();
        user_permissions();
        $template = $this->loadView($wear->back . "/media/audio");
        $photo = $this->loadModel($this->gear, "sun_audio_library_model");
        $photos = $photo->get_audios();
        $template->set("audios" , $photos);
        $template->set("page" , SITE_NAME . " | Audio Media Board");
        $template->render();
        
    }

    #-----Get All Videos -------#

    function videos(){

        global $wear;
        global $session;
        do_login();
        user_permissions();
        $template = $this->loadView($wear->back . "/media/internal_videos");
        $photo = $this->loadModel($this->gear,"sun_video_library_model");
        $photos = $photo->get_videos();
        $videos = $this->loadModel($this->gear,"sun_embedded_videos_model");
        $videoEs = $videos->get_videos();
        $template->set("videos" , $photos);
        $template->set("videoEs" , $videoEs);
        $template->set("page" , SITE_NAME . " | Video Media Board");
        $template->render();
        
    }

    function mediaEditVideoLink($id){
  

       global $wear;
        global $session;
        do_login();
        user_permissions();
        $template = $this->loadView($wear->back . "/media/edit_embedded_video");
        $videos = $this->loadModel($this->gear,"sun_embedded_videos_model");
        $video = $videos->find_video($id);
        $template->set("video" , $video);
        $template->set("page" , SITE_NAME . " | Edit External Video");
        $template->render();


    }

    #-----Get All Videos -------#

    function uploadMedia(){

        global $wear;
        global $session;
        do_login();
        user_permissions();
        $template = $this->loadView($wear->back . "/media/add_media");
        $template->set("page" , SITE_NAME . " | Upload Media");
        $template->render();
        
    }

    function addPhoto(){

        do_login();
        user_permissions();
        $login = $this->loadModel($this->gear,"sun_photos_model");
        $login->create_photo();
        
    }

    function addAudio(){

        do_login();
        user_permissions();
        $login = $this->loadModel($this->gear,"sun_audio_library_model");
        $login->create_audio();
        
    }
    function addVideo(){

        do_login();
        user_permissions();
        $login = $this->loadModel($this->gear,"sun_video_library_model");
        $login->create_video();
        
    }
    function addEmbebbededVideo(){

          do_login();
        user_permissions();
        $login = $this->loadModel($this->gear,"sun_embedded_videos_model");
        $login->create_video();
    }
    function saveEmbebbededVideo($id){

          do_login();
        user_permissions();
        $login = $this->loadModel($this->gear,"sun_embedded_videos_model");
        $login->save_video($id);
    }

    #----  Delete Photo -------#

    function deletePhoto($id,$purpose){

        do_login();
        user_permissions();
        $login = $this->loadModel($this->gear,"sun_photos_model");
        $login->delete_photo($id,$purpose);
        
    }
     #----  Delete Audio -------#
    function deleteAudio($id){

        do_login();
        user_permissions();
        $login = $this->loadModel($this->gear,"sun_audio_library_model");
        $login->delete_audio($id);
        
    }
    
    #----  Delete Video -------#
     function deleteVideo($id){

        do_login();
        user_permissions();
        $login = $this->loadModel($this->gear,"sun_video_library_model");
        $login->delete_video($id);
        
    }
    #----  Delete Embedded Video -------#
    function deleteEmbebbededVideo($id){

          do_login();
        user_permissions();
        $login = $this->loadModel($this->gear, "sun_embedded_videos_model");
        $login->delete_video($id);
    }
    

    

 }
