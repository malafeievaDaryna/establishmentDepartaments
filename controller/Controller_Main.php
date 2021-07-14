<?php

require_once "${_SERVER['DOCUMENT_ROOT']}/model/Model_User.php";
require_once "${_SERVER['DOCUMENT_ROOT']}/view/ViewMaker.php";

class Controller_Main {
    
    function __construct()
    {
    }
    
    function action_showWelcomePage()
    {
        $view = new UserAdding();
        echo $view->getHTMLContent();
    }
    
    function action_addUser()
    {
        $view = new UserAdding();
        echo $view->getHTMLContent();
    }
}
/*
$request = $_POST["request"];
$name = $_POST["name"];
$phone = $_POST["phone"];
$id = $_POST["id"];

Logger::getInstance()->log(__FILE__ . ' $request ' . $request . ' $id '. $id . ' $name '. $name . ' $phone '. $phone);

if (isset($request)) {
    if ($request === "getContacts") {
        $arr = $conn->getContacts();
        echo json_encode($arr);
    }
    else if ( $request === "insert" && isset($name) && isset($phone) ) {
        $arr = $conn->getContacts();
        $obj = new CContact($name, $phone);
        $conn->insertOrUpdateContact($obj);
    } else if ( $request === "delete" && isset($id) ) {
        $conn->deleteContact((int)$id);
    }
} else {
    Logger::getInstance()->log("error when parsing request");
}

*/