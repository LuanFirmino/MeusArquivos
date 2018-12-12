<?php
    session_start();
    /*Chammadas de arquivos*/
    require './connection.php';
    require './database.php';

    if(!isset($_POST['rota'])){
        $_SESSION['msg'] = "Erro - Preencha os campos*";
        header("Location: ../VIEWs/cadprocedimento.php");
    }
    switch(@$_POST['rota']){
        case 1:
        //Inserir na Tabela
            $instituicao = array(
                'ceatendimento'    =>  @$_POST['atendimento'],
                'descprocedimento' =>  @$_POST['descricao'],
                'tipoprocedimento' =>  @$_POST['tipo'],
            );
            $grava = DBCreate('procedimentos', $instituicao);
            if($grava){
                $_SESSION['msg'] = "Procedimento cadastrado com êxito!";
                header("Location: ../VIEWs/cadprocedimento.php");
            }else{
                $_SESSION['msg'] = "Falha ao cadastrar procedimento!";
                header("Location: ../VIEWs/cadprocedimento.php");
            }
        break;
    }
?>