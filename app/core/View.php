<?php
class View
{
    private $viewFile;
    private $viewTitle;
    private $viewData;

    public function __construct($viewFile, $viewTitle, $viewData)
    {
        $this->viewFile = $viewFile;
        $this->viewTitle = $viewTitle;
        $this->viewData = $viewData;
    }
    public function render()
    {
        if (file_exists(VIEW . $this->viewFile . '.phtml')) {
            include VIEW . $this->viewFile . '.phtml';
        }
    }
}