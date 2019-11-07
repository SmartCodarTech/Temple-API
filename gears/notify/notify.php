<?php

 use Engine\Core\Controller ;
 
 class Notify extends Controller{
    
    
    #----- Name Of Gear  -------#

    private $gear = "notify";
    
    #-----Contacts -------#

    function index(){

        global $wear;
        global $session;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->back . "/notify/contacts/contacts");
        $model = $this->loadModel($this->gear,"sun_notify_model");
        $contacts = $model->get_notify_contacts();
        $template->set("contacts" , $contacts);
        $template->set("page" , SITE_NAME . " | Your Notification Contacts");
        $template->render();   

    }

    #-----Create Contact -------#

    function contactGroups(){

        global $wear;
        global $session;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->back . "/notify/contacts/add_group");
        $template->set("page" , SITE_NAME . " | Create A New Contact Group");
        $template->render();   

    }

    
    #-----Send Messages -------#

    function sendMessage(){

        global $wear;
        global $session;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->back . "/notify/send_messages");
        $model = $this->loadModel($this->gear,"sun_notify_model");
        $groups = $model->get_contact_groups();
        $template->set("groups" , $groups);
        $template->set("page" , SITE_NAME . " | Send Messages");
        $template->render();   

    }


    #-----Groups -------#

    function groups(){

        global $wear;
        global $session;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->back . "/notify/contacts/groups");
         $model = $this->loadModel($this->gear,"sun_notify_model");
        $groups = $model->get_contact_groups();
        $template->set("groups" , $groups);
        $template->set("page" , SITE_NAME . " | All Contact Groups");
        $template->render();   

    }

    #-----Settings -------#

    function settings(){

        global $wear;
        global $session;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->back . "/notify/settings");
        $model = $this->loadModel($this->gear,"sun_notify_model");
        $groups = $model->get_contact_groups();
        $template->set("groups" , $groups);
        $template->set("page" , SITE_NAME . " | All Contact Groups");
        $template->render();   

    }


    #-----Add Contacts -------#

    function addContacts(){

        global $wear;
        global $session;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->back . "/notify/contacts/add_contacts");
        $template->set("page" , SITE_NAME . " | Create A New Contact");
        $template->render();   

    }

    #-----Groups -------#

    function addGroup(){
   
        do_login();
        admin_levels("Editor");
        $model = $this->loadModel($this->gear, "sun_notify_groups_model");
        $model->create_group();
    }

    #-----Contacts -------#

    function sendToGroup(){
   
        do_login();
        admin_levels("Editor");
        $model = $this->loadModel($this->gear, "sun_notify_model");
        $model->send_to_group();
    }

    #-----Contacts -------#

    function saveGroup($id){
   
        do_login();
        admin_levels("Editor");
        $model = $this->loadModel($this->gear, "sun_notify_groups_model");
        $model->save_group($id);
    }

    function createContact(){
   
        do_login();
        admin_levels("Editor");
        $model = $this->loadModel($this->gear, "sun_notify_model");
        $model->create_contact();
    }

    function saveContact($id){
   
        do_login();
        admin_levels("Editor");
        $model = $this->loadModel($this->gear, "sun_notify_model");
        $model->save_contact($id);
    }

    function addToGroup($id){
    
        do_login();
        admin_levels("Editor");
        $model = $this->loadModel($this->gear, "sun_notify_groups_model");
        $model->add_to_group($id);

    }

    function sendSingle(){
    
        do_login();
        admin_levels("Editor");
        $model = $this->loadModel($this->gear, "sun_notify_model");
        $model->send_single();

    }

    function saveSetting(){
    
        do_login();
        admin_levels("Editor");
        $model = $this->loadModel($this->gear, "sun_notify_setting_model");
        $model->save_setting();

    }

    function deleteContact($id){
   
        do_login();
        admin_levels("Editor");
        $model = $this->loadModel($this->gear, "sun_notify_model");
        $model->delete_contact($id);
    }

    function deleteGroup($id){
   
        do_login();
        admin_levels("Editor");
        $model = $this->loadModel($this->gear, "sun_notify_groups_model");
        $model->delete_group($id);

    }


    
    
    

 }
