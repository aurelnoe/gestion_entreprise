<?php

function html()
{
    ?>   
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
            <script src="../Communs/script.js" type="text/javascript"></script>
        </head>
        <body>   
    <?php
}

function index($message=null,$errorCode=null):void
{
    if($errorCode && $errorCode == 1042){
        echo "<div class='alert alert-danger text-center'>Code : $errorCode, Message : $message</div>";
    }
    else if($errorCode && $errorCode == 1081){
        echo "<div class='alert alert-danger text-center'>$message</div>";
    }
    echo html();   
    
    ?>   
            <div class="container m-auto text-center">

                <h1 class="py-4">Page d'accueil</h1>
                
                <div class="row py-5">
                    <div class="col-11 col-md-5 m-auto">
                        <a class="btn btn-success w-50" href="Controller/list-EmployeController.php">Employés</a>
                    </div>
                    <div class="col-11 col-md-5 m-auto">                
                        <a class="btn btn-success w-50" href="Controller/list-serviceController.php">Services</a>          
                    </div>         
                </div>
                <div class="col-11 col-md-5 m-auto">
                    <a class="btn btn-danger w-50" href="?action=deconnexion">Deconnexion</a>
                </div> 
            </div>
        </body>
    </html>
    <?php
}

function formulaireInscription($message=null,$errorCode=null):void
{
    if($errorCode && $errorCode == 1062){
        $message=" Erreur l'utilisateur éxiste déjà dans la base de données ";
        echo "<div class='alert alert-danger text-center'>Code : $errorCode, Message : $message</div>";
    }
    echo html();
    ?>
            <div class="container w-50 text-center border mt-5">
                <h1 class="m-3">Formulaire d'inscription</h1>
                <hr>
                <form action="index.php?action=add" method="POST" require>
                    <div class="form-group w-50 m-auto">
                        <label for="userName">Adresse mail</label>
                        <input type="string" name="userName" class="form-control" aria-describedby="emailHelp" require>
                    </div>
                    <div class="form-group w-50 m-auto">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-success">Envoyer</button>          
                    </div>
                </form>
                <div>
                    <a href="index.php" class="btn btn-primary my-5">Retour accueil</a>
                </div>
            </div>        
        </body>
    </html>
    <?php
}

function formulaireConnexion($message=null,$errorCode=null):void
{
    if ($errorCode == 1081) {
        
        echo "<div class='alert alert-danger text-center'>Code : $errorCode, Message : $message</div>";
    }
    echo html();
    ?>
        <div class="container w-50 text-center border mt-5">
                <h1 class="m-3">Formulaire de connexion</h1>
                <hr>
            <form action="index.php?action=connexion" class="mt-5" method="POST">
                <div class="form-group w-50 m-auto">
                    <label for="userName">Adresse mail</label>
                    <input type="string" name="userName" class="form-control" aria-describedby="emailHelp">
                </div>
                <div class="form-group w-50 m-auto">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="m-4">
                    <button type="submit" class="btn btn-primary w-75">Envoyer</button>          
                </div>        
            </form>
            
            <div class="col-11 col-md-5 m-auto">
                    <a class="btn btn-success w-75 my-4" href="index.php?action=inscription">Créer un compte</a>
            </div>
        </div>   
        </body>
    </html>
    <?php
}
?>