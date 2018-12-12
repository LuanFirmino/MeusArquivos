<?php
    session_start();
    /*Chammadas de arquivos*/
    require './connection.php';
    require './database.php';

    if(!isset($_POST['rota'])){
        $_SESSION['msg'] = "Erro - Preencha os campos*";
        header("Location: ../VIEWs/cadatendimento.php");
    }
    switch(@$_POST['rota']){
    case 1:
    //Inserir na Tabela
        $atendimento = array(
            'ceinstituicao' =>  @$_POST['instituicao'],
            'cemedico'      =>  @$_COOKIE['medic'],
            'cepaciente'    =>  @$_POST['idpaciente'],
            'diagnostico'   =>  @$_POST['diagnostico'],
            'tratamento'    =>  @$_POST['tratamento'],
            'dataatend'     =>  @$_POST['horAten']
        );
        $grava = DBCreate('atendimentos', $atendimento);
        if($grava){
            $_SESSION['msg'] = "Atendimento cadastrado com êxito!";
            header("Location: ../VIEWs/cadatendimento.php");
        }else{
            $_SESSION['msg'] = "Falha ao cadastrar atendimento!";
            header("Location: ../VIEWs/cadatendimento.php");
        }
        break;
    }
?>
