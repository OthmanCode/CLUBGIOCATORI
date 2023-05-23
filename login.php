<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "club";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error)
    {
        die("Connessione al database fallita: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $username = $_POST["User"];
        $password = $_POST["Pass"];

        if (verificaCredenziali($conn, $username, $password)) 
        {
            header("Location: dashboard.php");
            exit();
        } 
        else 
        {
            $errore = "Credenziali non valide. Riprova.";
        }
    }

    function verificaCredenziali($conn, $username, $password) 
    {
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

        $query = "SELECT * FROM Users WHERE User = '$username' AND Pass = '$password'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    function isUtenteLoggato() 
    {
        return isset($_SESSION["username"]);
    }
?>

<?php include('templates/header.php'); ?>
    
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-5">
            <form method="POST" class="login-form" action="login.php">
                <h2 class="text-center">Accedi</h2>
                <div class="form-group">
                    <label>Nome</label>
                    <input class="form-control" type="text" name="User" value="<?php echo $username ?>">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" type="password" name="Pass" value="<?php echo $password ?>">
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-success" value="Accedi">

                    <!-- <p class="text-danger text-center"><?php echo($error) ?></p> -->
                </div>
            </form>
            </div>
        </div>
    </div>

<?php include('templates/pageEnd.php'); ?>



    