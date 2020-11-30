<?php

function formulaireService($title,$service,$titleBtn,$action,$errorCode=null)
{
    if($errorCode && $errorCode == 9996){
        echo "<div class='alert alert-danger text-center'>Code : $errorCode,\n Message : $message</div>";
    }
    echo afficher();
    ?>  <body>
        <div class="container m-auto">

            <h1 class="text-center"><?php echo $title ?></h1>
        
            <form class="form w-50 m-auto border rounded p-3 my-3" action="list-serviceController.php?action=<?php echo $action;?>&no_service=<?php echo ($_GET['action']=='update')?$_GET['no_service']:"";?> <?php if(($_GET['action']) == 'update')?>" method="POST">        
                <div class="form-group">
                    <label for="no_employe">Numéro de service</label>
                    <input type="number" class="form-control" name="no_service" <?php if(($_GET['action']) == 'update')?> placeholder=<?php if(($_GET['action']) == 'update'){echo $service->getNoService();}?>>
                 </div>
                <div class="form-group">
                    <label for="libelle">Nom du service</label>
                    <input type="text" name="libelle" class="form-control" value="<?php if(($_GET['action']) == 'update') {echo $service->getLibelle();}?>">
                </div>
                <div class="form-group">
                    <label for="ville">Ville</label>
                    <input type="text" name="ville" class="form-control" value="<?php if(($_GET['action']) == 'update'){echo $service->getVille();}?>">
                </div>       
                <div class="m-auto text-center">
                    <button type="submit" class="btn btn-primary w-75"><?php echo $titleBtn ?></button>
                </div>        
            </form>

            <div class="text-center my-5">
                <a href="list-ServiceController.php" class="btn btn-success w-25 m-auto">Retour aux services</a>
            </div>
        </div>      
    </body>
    
</html>
<?php
}

function listServices($admin,$services,$serviceAffect,$message=null,$errorCode=null)
{
    if($errorCode && $errorCode == 1062){
        $message=" Le service existe déjà dans la base de données !";
        echo "<div class='alert alert-danger text-center'>Code : $errorCode,\n Message : $message</div>";
    }
    else if($errorCode && $errorCode == 1027){
        $message = "Le service n'a pas pu être modifié !";
        echo "<div class='alert alert-danger text-center'>Code : $errorCode,\n Message : $message</div>";
    }
    else if($errorCode && $errorCode == 1217){
        $message=" Le service n'a pas pu être supprimé ";
        echo "<div class='alert alert-danger text-center'>Code : $errorCode,\n Message : $message</div>";
    }
    else if($errorCode && $errorCode == 9997){
        echo "<div class='alert alert-danger text-center'>Code : $errorCode,\n Message : $message</div>";
    }

    echo afficher();
    ?>  <body>
    <div class="container-fluid m-auto">
        <div class="row pt-4 m-auto text-center">        
            <div class="col-3 ">
                <a class="btn btn-primary w-75" href="../index.php">ACCUEIL</a>
            </div>
            <div class="col-6">
                <h1 class="">Liste des services</h1>
            </div>   
            <?php
            if ($admin) {
            ?>
                <div class="col-3">
                    <a class="btn btn-success w-75" href="formulaireServiceController.php?action=add">Ajout Service</a>
                </div>
            <?php    
            }
            ?>           
        </div>
        
        <form class="form-inline my-5 text-center">
            <input class="form-control w-50 m-auto" type="search" id="searchFilterService" placeholder="Search" aria-label="Search">
        </form>
    
        <table id="tableServices" class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th scope="col">Numéro du service</th>
                    <th scope="col">Nom du service</th>
                    <th scope="col">Ville</th>
                    <?php                    
                        if ($admin) 
                        { 
                        ?>
                        <th></th>   <!--Bouton supprimer-->
                        <th></th>
                        <?php
                        }
                    ?>               
                </tr>
            </thead>
            <tbody>
                
                <?php                
                    echo '<tr>';
                    if (!empty($services)) {
                         
                        foreach ($services as $service) {  //Pour chaque objet service
                        ?>
                            <td>
                                <a href="details-ServiceController.php?no_service=<?php echo $service->getNoService(); ?>" class="btn btn-success">Détails</a>
                            </td>
                            <td>
                                <?php
                                echo $service->getNoService();
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $service->getLibelle();
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $service->getVille();
                                ?>
                            </td>
                            <td>
                                <?php
                                // var_dump($service->getNoService());
                                // var_dump($serviceAffect);
                                $occupe = array_search($service->getNoService(),$serviceAffect);
                                
                                if ($admin && !$occupe) 
                                {                                                                  
                                ?>                            
                                    <a href="list-ServiceController.php?action=delete&no_service=<?php echo $service->getNoService();?>" class="btn btn-danger w-100">Supprimer</a>                           
                                <?php                                   
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($admin) 
                                {
                                ?>
                                    <a href="formulaireServiceController.php?action=update&no_service=<?php echo $service->getNoService();?>" class="btn btn-primary w-100">Modifier</a>
                                <?php
                                }
                                ?>
                            </td>                           
                        </tr>                           
                        <?php
                        }
                    }
                ?>                 
            </tbody>
        </table>
    </div>        
</body>
</html>
<?php
}

function detailsService($service,$message=null,$errorCode=null)
{
    if($errorCode && $errorCode == 9996){
        echo "<div class='alert alert-danger text-center'>Code : $errorCode,\n Message : $message</div>";
    }
    echo afficher();
    ?>  <body>
        <div class="container text-center m-auto">

        <h1 class="my-5">Détails des services</h1>
        <table class="table table-striped table-dark text-center">
            <thead>
                <tr>
                    <th scope="col">Numéro du service</th>
                    <th scope="col">Nom du service</th>
                    <th scope="col">Ville</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php
                        echo $service->getNoService();
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $service->getLibelle();
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $service->getVille();
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="m-auto my-5">
            <a href="list-ServiceController.php" class="btn btn-success w-25">Retour liste services</a>
        </div>
    </div>        
</body>
</html>
<?php
}

?>