<?php 
session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>The Game</title>
  </head>
  <body>

    <div class="container mt-5" style="max-width: 25rem;">
        <center>
            <form action="index.php" method="post">
                <div class="form-group">
                <label for="num"><b>Guess the number from 1 - 10</b></label>
                <input type="number" class="form-control" name="num" id="num" aria-describedby="helpId">
                <input type="submit" name="submit" value="Check" class="btn btn-primary mt-2"></input>
                </div>
            </form>
            <?php 

            if(isset($_POST['num']) && is_numeric($_POST['num']) && !empty($_POST['num']))
            {
                $num = $_POST['num'];
                
                if(isset($_SESSION['i']))
                {
                    $_SESSION['i']++;
                }
                else 
                {
                    $_SESSION['i'] = 1;
                }

                if(!isset($_SESSION['los']))
                {
                    $_SESSION['los'] = random_int(1, 10);
                }
                if($num > $_SESSION['los'])
                {
                    echo "Unfortunately, the number drawn is smaller than yours!<br>Give another number...<br>";
                }
                else if($num < $_SESSION['los'])
                {
                    echo "Unfortunately, the number drawn is larger than yours!<br>Give another number...<br>";
                }
                else 
                {
                    if(isset($_COOKIE['Record']))
                    {
                        if($_COOKIE['Record'] > $_SESSION['i'])
                        {
                            setcookie("Record",  $_SESSION['i'], time() + (86400 * 30), "/");
                        }
                    }
                    else 
                    {
                        setcookie("Record",  $_SESSION['i'], time() + (86400 * 30), "/");
                    }
                    echo "Congratulations! You guessed it ".  $_SESSION['i'] ." time!<br>";

                    session_destroy();
                }
            }
            else 
            {
                echo "Give the first number...<br>";
            }

            if(isset($_COOKIE['Record']))
            {
                echo "Your best score today: ". $_COOKIE['Record'];
            }
    
            ?>
        </center>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

  </body>
</html>