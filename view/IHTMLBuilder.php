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
