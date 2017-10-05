<!DOCTYPE html>
<html>

<head>
    <title>Rezultati Markove Knjižare</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/style.css">

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- ICONS -->
    <link rel="stylesheet" href="css/icons/fontawesome/css/style.css">
    
    
    <link rel="stylesheet" href="css/icons/fontawesome/css/style.css">
    <link rel="stylesheet" href="css/icons/style.css">
</head>

<body>
    <nav>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="index.html"><img src="img/logowhite.png" alt="Logo" class="logo"></a>
                    <ul class="main-nav">
                        <li><a href="index.html" class="vesti">Početna strana</a></li>
                        <li><a href="newbook.html" class="vesti">Dodaj Novu Knjigu</a></li>
                        <li><a href="autorska.html" class="vesti">Autorska Prava</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="sekcijaPrva">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>
                        <center>Rezultati Markove Knjižare</center>
                    </h1><br><br>
                    <?php
    // kreiranje kratkih imena promenljivih
    $searchtype=$_POST['searchtype'];
    $searchterm="%{$_POST['searchterm']}%";
                    

    if (!$searchtype || !$searchterm) {
       echo '<p>Niste popunili polja za pretragu.<br/>
       Molimo Vas vratite se i pokušajte ponovo.</p>';
       exit;
    } 

    // metode bele liste
    switch ($searchtype) {
      case 'Title':
      case 'Author':
      case 'ISBN':   
        break;
      default: 
        echo '<p>Uneli ste pogrešan tip za unos. <br/>
        Molimo Vas vratite se i pokušajte ponovo.</p>';
        exit; 
    }

    // podesavanje za PDO
    $user = 'root';
    $pass = 'komr@1988';
    $host = 'localhost';
    $db_name = 'my_books';

    // podesavanje za DSN
    $dsn = "mysql:host=$host;dbname=$db_name";

    // povezivanje sa bazom
    try {
      $db = new PDO($dsn, $user, $pass); 

      // izvrsavanje upita
      $query = "SELECT ISBN, Author, Title, Price FROM Books WHERE $searchtype like :searchterm";  
      $stmt = $db->prepare($query);  
      $stmt->bindParam(':searchterm', $searchterm);
      $stmt->execute(); 

      // daj broj vracenih redova  
      echo "<p><center><strong>Broj pronađenih knjiga: ".$stmt->rowCount()."</strong></center></p>"; 

      // prikazi svaki vraceni red
      while($result = $stmt->fetch(PDO::FETCH_OBJ)) {                                                       
        echo "<p><strong><center>Ime Knjige: ".$result->Title."</strong>";                               
        echo "<br />Ime Autora: ".$result->Author;                                              
        echo "<br />ISBN: ".$result->ISBN;                                                  
        echo "<br />Cena: ".number_format($result->Price, 2)." rsd.</center></p><br><br><br>";                                         
      }         

      // prekini vezu sa bazom
      $db = NULL;
    } catch (PDOException $e) {
      echo "Error: ".$e->getMessage();
      exit;
    }
  ?>
                        <form action="index.html" methode="post" class="table table-hover" style="text-align: center">
                            <p>Vrati se na Početnu stranu</p>
                            <input type="submit" value="Potvrdi" class="btn btn-boja tabela">
                        </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form class="form-inline social-buttons iconSize">
                        <a href="https://www.facebook.com/upss1988"><i class="fa fa-facebook"></i></a>

                        <a href="https://www.instagram.com/betmen_licno"><i class="fa fa-instagram"></i></a>
                        <a href="http://plus.google.com/u/0/108637013978671242467"><i class="fa fa-google-plus"></i></a>
                    </form>
                </div>
                <div class="col-md-6">
                    <span class="copyrightParagraf">Copyright &copy; 2017 All Rights Reserved Marko Radulović.</span>
                </div>

            </div>
        </div>
    </footer>
</body>

</html>
