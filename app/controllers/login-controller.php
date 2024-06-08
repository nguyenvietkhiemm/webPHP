<?php
    class LoginController 
    {
        public function index() {
            include __DIR__.('\..\..\resources\views\login.php');
        }
    }

    return new LoginController;
?>