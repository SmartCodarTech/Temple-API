<?php

 use Engine\Core\Controller ;
 
 class Messages extends Controller{
    
    
    /****************
    *
    * @ string
    * Gear Name .
    *
    *****************/

    private $gear = "messages";



    
    #----- Manage User Messages -------#

    function index(){

        global $wear;
        global $session;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->back . "/messages");
        $model = $this->loadModel($this->gear,"sun_messages_model");
        $messages = $model->get_messages();
        $template->set("messages" , $messages);
        $template->set("page" , SITE_NAME . " | Your Messages");
        $template->render();   

    }

        function externalMessages(){

        global $wear;
        global $session;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->front . "/members/external_messages");
        $model = $this->loadModel($this->gear,"sun_messages_model");
        $messages = $model->get_messages();
        $template->set("messages" , $messages);
        $template->set("page" , SITE_NAME . " | All Messages");
        $template->render();   

    }

    function inbox($id){

        global $wear;
        global $session;
        do_login();
        $template = $this->loadView($wear->front . "/members/inbox");
        $model = $this->loadModel($this->gear,"sun_messages_model");
        $messages = $model->get_inbox($id);
        $template->set("messages" , $messages);
        $template->set("page" , SITE_NAME . " | Your Messages");
        $template->render();   

    }

    function newMessage($id){

        global $wear;
        global $session;
        admin_levels("Editor");
        do_login();
        $template = $this->loadView($wear->front . "/members/notice");
        $template->set("id" , $id);
        $template->set("page" , SITE_NAME . " | Send MEssage");
        $template->render();   

    }

    function userSupport(){

        global $wear;
        global $session;
        admin_levels("Editor");
        do_login();
        $template = $this->loadView($wear->front . "/members/user_support");
        $model = $this->loadModel($this->gear,"sun_messages_model");
        $messages = $model->get_support();
        $template->set("messages" , $messages);
        $template->set("page" , SITE_NAME . " | Send MEssage");
        $template->render();   

    }
    
    #-----Reply Message -------#

    function replyMessage(){
   
        do_login();
        admin_levels("Editor");
        $model = $this->loadModel($this->gear, "sun_messages_model");
        $model->reply_message();
    }
    
    #-----Delete Message-------#

    function deleteMessage($id){
   
        do_login();
        admin_levels("Editor");
        $model = $this->loadModel($this->gear, "sun_messages_model");
        $model->delete_message($id);
    }

    function deleteInbox($id){
   
        do_login();
        $model = $this->loadModel($this->gear, "sun_messages_model");
        $model->delete_inbox($id);
    }

    function support(){

        global $wear;
        do_login();
        $template = $this->loadView($wear->front . "/members/support");
        $template->set("page" , SITE_NAME . " | Send Us A Support Ticket");
        $template->render(); 

    }

    function sendSupport(){

        $model=$this->loadModel($this->gear, "sun_messages_model");
        $model->send_support(); 

    }
    
    function sendNotice($id){

        $model=$this->loadModel($this->gear, "sun_messages_model");
        $model->send_notice($id); 

    }

    #----- Create New MEssage -------#

    function createMessage(){

        $model = $this->loadModel($this->gear, "sun_messages_model");
        $model->create_message();
    }
    

 }
