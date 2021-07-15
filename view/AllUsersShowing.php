<?php
require_once "${_SERVER['DOCUMENT_ROOT']}/view/IHTMLBuilder.php";

class AllUsersShowing extends IHTMLBuilder
{
    
    protected function produceContent(): void
    {
        $model = new Model_User();
        $users = $model->getUsers();

        $this->htmlContent .= 
               '<table class="table table-dark">
               <thead>
                 <tr>
                   <th scope="col">ID</th>
                   <th scope="col">USER</th>
                   <th scope="col">EMAIL</th>
                   <th scope="col">PHONE</th>
                   <th scope="col">ADDRESS</th>
                   <th scope="col">ABOUT</th>
                   <th scope="col">DEPARTMENT</th>
                 </tr>
               </thead>
               <tbody>';
        
        foreach($users as $value)
        {
            $this->htmlContent .= '     
                   <tr>
                     <td>' . $value->id . '</td>
                     <td>' . $value->user. '</td>
                     <td>' . $value->email. '</td>
                     <td>' . $value->phone. '</td>
                     <td>' . $value->address. '</td>
                     <td>' . $value->about. '</td>
                     <td>' . $value->departament_id. '</td>
                   </tr>';
        }
		
		$this->htmlContent .= '
                 </tbody>
               </table>';
  
    }
}

