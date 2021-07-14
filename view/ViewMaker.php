<?php

abstract class IHTMLBuilder
{
    protected string $htmlContent = "";
    
    protected function produceHead(): void
    {
        $this->htmlContent = ' 
                              <html>
                                 <head>
                                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                                    <title>Title</title>
                                    <meta charset="UTF-8">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                 </head>
                                 <body>';
    }

    abstract protected function produceContent(): void;

    protected function produceFooter(): void
    {
        $this->htmlContent .=   '</body>
                               </html>';
    }
    
    public function getHTMLContent(): string
    {
        $this->produceHead();
        $this->produceContent();
        $this->produceFooter();
        
        return $this->htmlContent;
    }
}


class UserAdding extends IHTMLBuilder
{
    protected function produceContent(): void
    {
        $this->htmlContent .= ' 
        <div class="container">
            <h2>Add new employee</h2>' . 
            "<form action='" . "/Main/addUser' method='post'>" .
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
                    <select class="form-select">
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>';
    }
}

