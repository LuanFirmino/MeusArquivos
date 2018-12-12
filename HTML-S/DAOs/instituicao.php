<?php
    session_start(); //inicia a sessão
    /*Chammadas de arquivos*/
    require './connection.php';
    require './database.php';
    
    if(!isset($_POST['rota'])){ 
        $_SESSION['msg'] = "Voce esta pulando partes, preencha os campos :v*";
        header("Location: ../VIEWs/cadInstituicao.php");
    }
    switch ($_POST['rota']) {
        case 1:
        //Inserir na Tabela
            $instituicao = array(
                'nomeinstitu'   =>  $_POST['nome'],
                'foneinstitu'   =>  $_POST['telefone'],
                'enderinstitu'  =>  $_POST['endereco'],
                'siteinstitu'   =>  $_POST['site']
            );
            $grava = DBCreate('instituicoes', $instituicao);
            if($grava){
                $_SESSION['msg'] = "Instituição Cadastrado com Exito!";
                header("Location: ../VIEWs/cadInstituicao.php");
                exit;
            }else{
                $_SESSION['msg'] = "Instituição Cadastrado com Exito!";
                header("Location: ../VIEWs/cadInstituicao.php");
                exit;
            }
            break;
    }            
?>