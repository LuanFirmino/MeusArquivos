<?php
    session_start();
    require '../DAOs/connection.php';
    require '../DAOs/database.php';

    if(!isset($_POST['rot'])){
        $_SESSION['msg'] = "Não pude fases, preencha os campos*";
        header("Location: ../VIEWs/Pesquisa.php");
    }
    switch($_POST['rot']){
        case 1:
            $pes = ($_POST['pesq']=='nome') ? 'nomepaciente' : ($_POST['pesq']=='cpf') ? 'cpfpaciente' : 'emailpaciente' ;
            $pesq = array(
                'nomepaciente' => "$_POST[nome]",
                "{$pes}" => "{$_POST[pesq]}"
            );
        break;
    }