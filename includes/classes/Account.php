<?php

    class Account {
        private $con;
        private $errorArray;

        public function __construct($con) {
            $this->con = $con;
            $this->errorArray = array();
        }


        public function login($un, $pw){
            $encryptedpw = md5($pw);

            $query = mysqli_query($this->con,"SELECT * FROM users WHERE username='$un' AND Password = '$encryptedpw'");

            if(mysqli_num_rows($query)== 1){
                return true;
            }

            else{
                array_push($this->errorArray,Constants::$loginFailed);
                
                return false;
            }


        }

        public function register($un, $fn, $ln, $em,$em2, $pw, $pw2){
            $this->validateUsername($un);
            $this->validatefirstName($fn);
            $this->validatelastName($ln);
            $this->validateEmails($em, $em2);
            $this->validatePassword($pw, $pw2);

            if(empty($this->errorArray) == true){
                //insert into db
                return $this->insertUserDetails($un,$fn,$ln,$em, $pw);
            }
            else{
                return false;
            }
        }

        public function getError($error){
            if(!in_array($error, $this->errorArray)){
                $error = "";
            }

            return "<span class='errorMessage'>$error</span>";
        }

        private function insertUserDetails($un,$fn,$ln,$em, $pw){

            $encryptedpw = md5($pw); //encrypt password in md5
            $profilePic = "assets/images/profile-pics/picture.jpg";
            $date = date("Y-m-d");

            $result = mysqli_query($this->con,"INSERT INTO users(`username`,`Firstname`,`Lastname`,`Email`,`Password`,`signUpDate`,`profilePic`) VALUES ('$un','$fn','$ln','$em','$encryptedpw','$date','$profilePic')");

            return $result;

        }


        private function validateUsername($un){
            if(strlen($un) > 25 || strlen($un) < 5){
                array_push($this->errorArray, Constants::$usernameCharacter);
                return;
            }

            //TODO: Check if username exists
            $checkUsernameQuery = mysqli_query($this->con,"SELECT username FROM users WHERE username = '$un'");

            if(mysqli_num_rows($checkUsernameQuery)!= 0){
                array_push($this->errorArray,Constants::$usernameTaken);
                return;
            }
        }
        
        private function validatefirstName($fn){
            if(strlen($fn) > 25 || strlen($fn) < 2){
                array_push($this->errorArray,Constants::$firstnameCharacter);
                return;
            }
            
        }
        
        private function validatelastName($ln){
            if(strlen($ln) > 25 || strlen($ln) < 2){
                array_push($this->errorArray,Constants::$lastnameCharacter);
                return;
            }
            
        }
        
        private function validateEmails($em, $em2){

            if($em != $em2){
                array_push($this->errorArray,Constants::$emailsDontMatch);
                return;
            }

            if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
                array_push($this->errorArray,Constants::$emailInvalid);
                return;
            }

            //TODO : check that email hasn't been used.
            $checkEmailQuery = mysqli_query($this->con,"SELECT Email FROM users WHERE Email = '$em'");
            if(mysqli_num_rows($checkEmailQuery) != 0){
                array_push($this->errorArray,Constants::$emailTaken);
                return;
            }
            
        }
        
        private function validatePassword($pw, $pw2){

            if($pw != $pw2){
                array_push($this->errorArray,Constants::$passwordsDoNotMatch);
                return;
            }

            if(preg_match('/[^A-Za-z0-9]/',$pw)){
                array_push($this->errorArray,Constants::$passwordsNotAlphanumeric);
                return;
            }

            if(strlen($pw) > 30 || strlen($pw) < 5){
                array_push($this->errorArray,Constants::$passwordCharacter);
                return;
            }
            
        }

    }

?>