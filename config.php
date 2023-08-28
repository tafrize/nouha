<?php
            $servername = 'localhost';
            $username = 'root';
            $password = '1234';
            $database='nouha';
            
            $connexion = new mysqli($servername, $username, $password,$database);
          
            if($connexion->connect_error){
                die('Erreur : ' .$connexion->connect_error);
            }
            
?>