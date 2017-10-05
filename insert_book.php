<!doctype html>
<html>

<head>
    <title>Dodaj novu knjigu</title>
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
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="sekcijaPrva">
        <div class="container">

            <div class="col-md-10">

                <h1>Rezultati unosa</h1>

                <?php

    if (!isset($_POST['ID']) || !isset($_POST['Title'])
       || !isset($_POST['Author']) || !isset($_POST['ISBN']) 
       || !isset($_POST['Price']) || !isset($_POST['Date'])) {
        echo '<p>You have not entered all the required details.<br>
        Please go back and try again!</p>';
        exit;
    }
    
    //promenljive sa kratkim imenima
     
    $id = $_POST['ID']; 
    $title = $_POST['Title'];
    $author = $_POST['Author'];
    $isbn = $_POST['ISBN'];
    $price = $_POST['Price'];
    $date = $_POST['Date'];
    
    @$db = new mysqli ('localhost', 'root', 'komr@1988', 'my_books');
    
    if (mysqli_connect_errno()) {
        echo '<p>Error: Could not connect to database.<br>
        Please try again later!</p>';
        exit;
    }
    
    $query = "INSERT INTO Books VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ssssds' ,$id, $title, $author, $isbn, $price, $date);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo '<p>Book inserted into the database.</p>';
    } else {
        echo '<p>An error has occured.<br>
        The item was not added.</p>';
    }
    
    $db->close();
    
?>

                    <form action="newbook.html" methode="post" class="table table-hover" style="text-align: center">
                            <input type="submit" value="Dodaj Novu Knjigu" class="btn btn-boja tabela"><br><br>
                        <input type="submit" value="Početna strana" class="btn btn-boja tabela">
                        
                        </form>

            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form class="form-inline social-buttons iconSize">
                        <a href="https://www.facebook.com/upss1988"><i class="ion-social-facebook"></i></a>

                        <a href="https://www.instagram.com/betmen_licno"><i class="ion-social-instagram"></i></a>
                        <a href="https://github.com/upss1988"><i class="ion-social-github"></i></a>
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
