<?php
    session_start(); //inicia a sessão
    /*Chammadas de arquivos*/
    require './connection.php';
    require './database.php';
    $_SESSION['msg'] = null;

    if(!isset($_POST['rota'])){
        $_SESSION['msg'] = "Não pude fases, preencha os campos*";
        header("Location: ../VIEWs/cadAnamnese.php");
    }

    switch($_POST['rota']){
    case 1:
    //Inserir na Tabela
        $anamnese = array(
            'cepaciente'    =>  $_POST['paciente'],
            'historia'      =>  $_POST['historicop'],
            'familia'       =>  $_POST['historicof'],
            'dataanamnese'  =>  $_POST['data_anamnese']
        );
        $grava = DBCreate('anamnese', $anamnese);
        if($grava){
            $_SESSION['msg'] = "Cadastro feito com Exito!";
            header("Location: ../VIEWs/cadAnamnese.php");
        }else{
            $_SESSION['msg'] = "Falha ao Cadastrar Anamnese";
            header("Location: ../VIEWs/cadAnamnese.php");
        }
        break;
    }
?>