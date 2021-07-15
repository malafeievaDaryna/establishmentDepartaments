<?php
require_once "${_SERVER['DOCUMENT_ROOT']}/view/IHTMLBuilder.php";
require_once "${_SERVER['DOCUMENT_ROOT']}/model/Model_User.php";
require_once "${_SERVER['DOCUMENT_ROOT']}/model/Model_Department.php";

class UserAdding extends IHTMLBuilder
{
    const CONTROLLER = "/Main/addUser";
    
    protected function produceContent(): void
    {
        $model = new Model_Department();
        $departments = $model->getRowsAsKeyValue();
        
        $this->htmlContent .= ' 
        <div class="container">
            <h2>Add new employee</h2>' . 
            "<form action='" . self::CONTROLLER ."' method='post'>" .
               '<div class="form-group">
                    <label for="text">User:</label>
                    <input type="text" class="form-control" placeholder="Enter username" id="user" name = "user">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="form-group">
                    <label for="text">Address:</label>
                    <input type="text" class="form-control" placeholder="Enter address" id="address" name = "address">
                </div>
                <div class="form-group">
                    <label for="text">About:</label>
                    <input type="text" class="form-control" placeholder="About yourself" id="about" name = "about">
                </div>
                <div class="form-group">
                    <label for="text">Phone:</label>
                    <input type="text" class="form-control" placeholder="Phone number:" id="phone" name = "phone">
                </div>
                <div class="form-group">
                    <label class="text" for="text">Departments</label>
                    <select class="form-select" id="department_id" name="department_id">';
        
        for($i = 0, $mark = 0; $mark < count($departments); ++$i)
        {
            // skip not existing ID
            if(isset($departments[$i]))
            {
               $this->htmlContent .= "<option value='".$i."'>".$departments[$i]."</option>";
               ++$mark;
            }
        }
        
        $this->htmlContent .= '
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>';
    }
}
