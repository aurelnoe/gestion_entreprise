<?php

function formulaireEmploye($title,$employe,$titleBtn,$action,$message=null,$errorCode=null)
{
    if($errorCode && $errorCode == 9999){
        echo "<div class='alert alert-danger text-center'>Code : $errorCode,\n Message : $message</div></div>";
    }

    echo html();
    ?>
        <div class="container m-auto">

            <h1 class="text-center"><?php echo $title ?></h1>
        
            <form class="form w-50 m-auto border rounded p-3 my-3" action="list-EmployeController.php?action=<?php echo $action;?>&no_employe=<?php echo ($_GET['action']=='update')?$_GET['no_employe']:"";?>" method="POST">        
                <div class="form-group">
                    <label for="no_employe">Numéro de l'employé</label>
                    <input type="number" class="form-control" name="no_employe" <?php if(($_GET['action']) == 'update'){echo " readonly";}?> placeholder="<?php if(($_GET['action']) == 'update'){echo $employe->getNoEmploye();}?>">
                </div>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" class="form-control" value="<?php if(($_GET['action']) == 'update') {echo $employe->getNom();}?>">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" class="form-control" value="<?php if(($_GET['action']) == 'update'){echo $employe->getPrenom();}?>">
                </div>
                <div class="form-group">
                    <label for="emploi">Emploi</label>
                    <input type="text" name="emploi" class="form-control" value="<?php if(($_GET['action']) == 'update') {echo $employe->getEmploi();}?>">
                </div>
                <div class="form-group">
                    <label for="embauche">Embauche</label>
                    <input type="date" name="embauche" class="form-control" value="<?php if(($_GET['action']) == 'update') {echo $employe->getEmbauche()->format('Y-m-d');}?>">
                </div>
                <div class="form-group">
                    <label for="salaire">Salaire</label>
                    <input type="number" name="salaire" class="form-control" value="<?php if(($_GET['action']) == 'update') {echo $employe->getSalaire();}?>">
                </div>
                <div class="form-group">
                    <label for="commission">Commission</label>
                    <input type="number" name="commission" class="form-control" value="<?php if(($_GET['action']) == 'update') {echo $employe->getCommission();}?>">
                </div>
                <div class="form-group">
                    <label for="sup">Supérieur</label>
                    <input type="number" name="sup" class="form-control" value="<?php if(($_GET['action']) == 'update') {echo $employe->getSup();}?>">
                </div>
                <div class="form-group">
                    <label for="no_service">Numéro de service</label>
                    <input type="number" name="no_service" class="form-control" value="<?php if(($_GET['action']) == 'update') {echo $employe->getNoService();}?>">
                </div>
                <div class="form-group">
                    <label for="NOPROJ">Numéro de projet</label>
                    <input type="number" name="NOPROJ" class="form-control" value="<?php if(($_GET['action']) == 'update') {echo $employe->getNoProj();}?>">
                </div>
        
                <div class="m-auto text-center">
                    <button type="submit" class="btn btn-primary w-75"><?php echo $titleBtn ?></button>
                </div>        
            </form>
            <div class="text-center my-5">
                <a href="list-EmployeController.php" class="btn btn-success w-25 m-auto">Retour à l'accueil</a>
            </div>
        </div>  
    </body>
</html>
<?php
}

function listEmploye($admin,$employes,$allChef,$message=null,$errorCode=null)
{
    if($errorCode && $errorCode == 1062){
        $message = "L'employé existe déja dans la base de données!";
        echo "<div class='alert alert-danger text-center'>Code : $errorCode,\n Message : $message</div>";
    }
    else if($errorCode && $errorCode == 1027){
        $message = "L'employé n'a pas pu être modifié!";
        echo "<div class='alert alert-danger text-center'>Code : $errorCode,\n Message : $message</div>";
    }
    else if($errorCode && $errorCode == 9998){
        echo "<div class='alert alert-danger text-center'>Code : $errorCode,\n Message : $message</div>";
    }

    echo html();
    ?>
    <div class="container-fluid m-auto">
        <div class="row pt-4 m-auto text-center">
            <div class="col-3">
                <a class="btn btn-primary w-75" href="../index.php">ACCUEIL</a>
            </div>
            <div class="col-6">
                <h1 class="">Liste des employés</h1>
            </div>
            <?php
            if ($admin) {
            ?>
            <div class="col-3">
                <a class="btn btn-success w-75" href="formulaireEmployeController.php?action=add">Ajout employé</a>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="text-center">
            <div class="w-100 pt-4">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th></th>
                            <th scope="col">Num employé</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Emploi</th>
                            <th scope="col">Date d'embauche</th>
                            <?php
                                if ($admin) 
                                {
                                ?>
                                <th scope="col">Salaire</th>
                                <th scope="col">Commission</th>
                                <?php
                                }
                            ?>
                            <th scope="col">Supérieur</th>
                            <th scope="col">Num service</th>
                            <th scope="col">Num de projet</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // echo '<pre>';
                            // var_dump($chef);
                            // echo '</pre>';
                                                            
                            echo '<tr>';

                            if (!empty($employes)) {
                                
                                foreach ($employes as $employe) {  //Pour chaque employé

                                ?>
                                    <td>
                                        <a href="details-EmployeController.php?no_employe=<?php echo $employe->getNoEmploye(); ?>" class="btn btn-success">Détails</a>
                                    </td>
                                    <td><?php echo $employe->getNoEmploye(); ?></td>
                                    <td><?php echo $employe->getNom(); ?></td>
                                    <td><?php echo $employe->getPrenom(); ?></td>
                                    <td><?php echo $employe->getEmploi(); ?></td>
                                    <td><?php echo $employe->getEmbauche()->format("d-m-Y"); ?></td>
                                    <?php
                                        if ($admin) 
                                        {
                                        ?>
                                        <td><?php echo $employe->getSalaire(); ?></td>
                                        <td><?php echo $employe->getCommission(); ?></td>
                                        <?php       
                                        }
                                    ?>
                                    <td><?php echo $employe->getSup(); ?></td>
                                    <td><?php echo $employe->getNoService(); ?></td>
                                    <td><?php echo $employe->getNoProj(); ?></td>                                                                           
                                    
                                    <?php
                                    echo '<td>';
                                        $occupe = array_search($employe->getNoEmploye(),$allChef);
                                        //var_dump($allChef);
                                        if ($admin && !$occupe) 
                                        {
                                            ?>
                                                <a href="list-EmployeController.php?action=delete&no_employe=<?php echo $employe->getNoEmploye();?>" class="btn btn-danger w-100">Supprimer</a>
                                            <?php                                                                
                                        }
                                    echo '</td>';                                                                                                                                                                                                                                                                                                                                                         
                                    ?>

                                    <td>
                                    <?php
                                    if ($admin) 
                                    {                                        
                                    ?>
                                        <a href="formulaireEmployeController.php?action=update&no_employe=<?php echo $employe->getNoEmploye();?>" class="btn btn-primary w-100">Modifier</a>                                
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
            <div>                
        </div>
    </div>
</body>
</html>
<?php
}

function detailsEmploye($admin,$employe,$message=null,$errorCode=null)
{
    if($errorCode && $errorCode == 9999){
        echo "<div class='alert alert-danger text-center'>Code : $errorCode,\n Message : $message</div>";
    }
    echo html();
    ?>
    <div class="container-fluid text-center m-auto">
        <h1 class="my-5">Détails employé</h1>
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">Num employé</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Emploi</th>
                    <th scope="col">Date d'embauche</th>
                    <?php
                        if ($admin) 
                        {
                    ?>
                        <th scope="col">Salaire</th>
                        <th scope="col">Commission</th>  
                    <?php
                        }
                    ?>                   
                    <th scope="col">Supérieur</th>
                    <th scope="col">Num service</th>
                    <th scope="col">Num de projet</th>
                </tr>
            </thead>
            <tbody>
                <tr><?php
                //$embauche->format("d-m-Y");
                        
                    ?>
                    <td><?php echo $employe->getNoEmploye(); ?></td>
                    <td><?php echo $employe->getNom(); ?></td>
                    <td><?php echo $employe->getPrenom(); ?></td>
                    <td><?php echo $employe->getEmploi(); ?></td>
                    <td><?php echo $employe->getEmbauche()->format("d-m-Y"); ?></td>
                    <?php
                        if ($admin) 
                        {
                        ?>
                        <td><?php echo $employe->getSalaire(); ?></td>
                        <td><?php echo $employe->getCommission(); ?></td>
                        <?php       
                        }
                    ?>
                    <td><?php echo $employe->getSup(); ?></td>
                    <td><?php echo $employe->getNoService(); ?></td>
                    <td><?php echo $employe->getNoProj(); ?></td>
                </tr>
            </tbody>
        </table>

        <div class="m-auto my-5">
            <a href="list-EmployeController.php" class="btn btn-success w-25">Retour liste employés</a>
        </div>
    </div>
</body>
</html>
<?php
}
?>