<?php

require_once "${_SERVER['DOCUMENT_ROOT']}/model/Model_User.php";
require_once "${_SERVER['DOCUMENT_ROOT']}/view/UserAdding.php";
require_once "${_SERVER['DOCUMENT_ROOT']}/view/AllUsersShowing.php";

class Controller_Main {
    
    function __construct()
    {
    }
    
    function action_showWelcomePage()
    {
        Logger::getInstance()->log(__METHOD__);
        $view = new UserAdding();
        echo $view->getHTMLContent();
    }
    
    function action_addUser()
    {
        Logger::getInstance()->log(__METHOD__);
        $res = FALSE;
        if(isset($_POST["user"]) && $_POST["email"] && $_POST["address"] && $_POST["about"] && $_POST["phone"] && $_POST["department_id"])
        {
            $user_name = htmlspecialchars($_POST["user"]);
            $email = htmlspecialchars($_POST["email"]);
            $address = htmlspecialchars($_POST["address"]);
            $about = htmlspecialchars($_POST["about"]);
            $phone = htmlspecialchars($_POST["phone"]);
            $department_id = htmlspecialchars($_POST["department_id"]);

            $user = new User($user_name, $email, $phone, $address, $about, $department_id);
            $model = new Model_User();
            Logger::getInstance()->log("attempt to insert ".' '.$user_name.' '.$email.' '.$phone.' '.$address.' '.$about.' '.$department_id);
            $res = $model->insertUser($user);
        }
        
        if(!$res)
        {
            Logger::getInstance()->log('invalid input data or couldnt insert data');
            echo 'invalid input data or couldnt insert data';
            $view = new UserAdding();
            echo $view->getHTMLContent();
        }
        else
        {
            $view = new AllUsersShowing();
            echo $view->getHTMLContent();
        }
    }
}