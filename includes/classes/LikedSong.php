<?php

    class LikedSong {

        private $con;
        private $id;
        private $songId;
        private $username;
        private $songorder;

      

        public function __construct($con , $username) {
            $this->con = $con;
            $this->username = $username;

            $query = mysqli_query($this->con, "SELECT * FROM likedsongs WHERE username='$this->username'");

            if(mysqli_num_rows($query) == 0){
                echo "<span class='noResults'>Add songs to your liked page</span>";
                return;
            }
            
            $likedsong = mysqli_fetch_array($query);

            $this->id = $likedsong['id'];
            $this->songId = $likedsong['songId'];
            $this->username = $likedsong['username'];
            $this->songorder = $likedsong['songorder'];

        }


        public function getOwner() {
			return $this->username;
		}

        public function getSongorder(){

            return $this->songorder;
        }

     

        public function getNumberOfSongs(){
            $query = mysqli_query($this->con, "SELECT DISTINCT songId  FROM likedsongs WHERE username='$this->username'");
            return mysqli_num_rows($query);
        }

        public function getSongIds(){
            $query = mysqli_query($this->con, "SELECT DISTINCT songId FROM likedsongs WHERE username='$this->username' ORDER BY songId ASC");

            $array = array();

            while($row = mysqli_fetch_array($query)){
                array_push($array, $row['songId']);
            }

            return $array;
        }

        public function getArtistIds(){
            $query = mysqli_query($this->con, "SELECT DISTINCT artistId FROM likedsongs WHERE username='$this->username' ORDER BY artistId ASC");
            $array = array();

            while($row = mysqli_fetch_array($query)){
                array_push($array, $row['artistId']);
            }

            return $array;
        }

    }

?>