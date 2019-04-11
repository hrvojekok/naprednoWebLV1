<?php

interface iRadovi {
  public function create($data);
  public function save();
  public function read();
}

class DiplomskiRadovi implements iRadovi {

      var $naziv_rada;
      var $tekst_rada;
      var $link_rada;
      var $oib_tvrtke;


      function __construct($data) {

      	$this -> naziv_rada = $data ['naziv_rada'];
      	$this -> tekst_rada = $data ['tekst_rada'];
      	$this -> link_rada = $data ['link_rada'];
      	$this -> oib_tvrtke = $data ['oib_tvrtke'];

      }

      function create($data) {
        
      }

      function save() {

        try {
            $user = 'root';
            $pass = '';
            $db = 'mysql:host=localhost;dbname=radovi';

            $pdo = new PDO($db, $user, $pass);
            $query = "INSERT INTO `diplomski_radovi_table`(`ID`, `nazivRada`, `tekstRada`, `linkRada`, `oibTvrtke`)
            VALUES('', '$this->naziv_rada', '$this->tekst_rada', '$this->link_rada', '$this->oib_tvrtke')";

            //echo($query . "<br><br>");
            $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo -> exec($query);

            //echo("Databese insertion succesfull!");
        } catch (PDOException $e) {
            //echo($e -> getMessage());
            //echo("<br><br>");
        }

        $pdo = null;

      }

      function read() {

        try {

          $user = 'root';
          $pass = '';
          $db = 'mysql:host=localhost;dbname=radovi';

          $pdo = new PDO($db, $user, $pass);
          $query = "SELECT * FROM `diplomski_radovi_table`";

          foreach($pdo->query($query) as $row) {
              //print_r($row);
              echo($row['nazivRada'] . "<br>");
              echo($row['tekstRada'] . "<br>");
              echo($row['linkRada'] . "<br>");
              echo($row['oibTvrtke'] . "<br><br>");
          }

        } catch (PDOException $e){
            die("Failed to read from database; " . $e->getMessage());
        }

      }


}

?>
