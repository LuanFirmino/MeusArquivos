<?php
    session_start(); //inicia a sessão
    /*Chamadas de arquivos*/
    require './connection.php';
    require './database.php';
    require './Vali/validaCPF.php';

    $_SESSION['msg'] = null;

    if(!isset($_POST['rota'])){
        $_SESSION['msg'] = "Não pude fases, preencha os campos*";
        header("Location: ../VIEWs/cadMedico.php");
    }

    switch($_POST['rota']){
        case 1:
        /*--------------------------------------------------------------------------------------*/
            $parametro = "where cpfmedico = '{$_POST[cpf]}' or emailmedico = '{$_POST[email]}' or crmmedico = '$_POST[crm]'";
            $info = DBRead('medicos', $parametro ,'emailmedico, cpfmedico, crmmedico');
            foreach ($info as $inf){
                if($inf['cpfmedico'] == $_POST['cpf']) {
                    $a++;
                }
                if($inf['emailmedico'] == $_POST['email']){
                    $b++;
                }
                if($inf['crmmedico'] == $_POST['crm']){
                    $c++;
                }
                if($_POST['senha'] != $_POST['csenha']){
                    $d++;
                }
            }
            $teste = preg_replace("/[^0-9]/", "", $_POST['cpf']);
            if(strlen($teste) != 11){
                $e++;
            } else if(validarCPF($_POST['cpf'])){
                echo 'CPF Valido<br/>';
            } else {
                $f++;
            }
            if(isset($a)||isset($b)||isset($c)||isset($d)||isset($e)||isset($f)) {
                if ($a!=0) {
                    $_SESSION['msg'] = "Este CPF ja esta cadastrado!*<br/>";
                }
                if ($b!=0) {
                    $_SESSION['msg'] = $_SESSION['msg'] . "Este Email ja esta cadastrado!*<br/>";
                }
                if ($c!=0) {
                    $_SESSION['msg'] = $_SESSION['msg'] . "Este CRM ja esta cadastrado!*<br/>";
                }
                if ($d!=0) {
                    $_SESSION['msg'] = $_SESSION['msg'] . "Senhas não conferem!*";
                }
                if ($e!=0) {
                    $_SESSION['msg'] = $_SESSION['msg'] . "CPF deve ter no minimo de 11 caracteres*";
                }
                if ($f!=0) {
                    $_SESSION['msg'] = $_SESSION['msg'] . 'CPF Invalido*';
                }
                header("Location: ../VIEWs/cadMedico.php");
                exit;
            }
        /*--------------------------------------------------------------------------------------*/
            /*Inserir na Tabela*/
            $medico = array(
                'nomemedico'    =>  $_POST['nome'],
                'crmmedico'     =>  $_POST['crm'],
                'especmedico'   =>  $_POST['especialidade'],
                'cpfmedico'     =>  $_POST['cpf'],
                'sexomedico'    =>  $_POST['sexo'],
                'fonemedico'    =>  $_POST['telefone'],
                'emailmedico'   =>  $_POST['email'],
                'nascmedico'    =>  $_POST['data_nascimento'],
                'senhamed'      =>  $_POST['senha']
            );
            $grava = DBCreate('medicos', $medico);
            if($grava){
                $_SESSION['msg'] = "Médico Cadastrado com Exito!";
                header("Location: ../VIEWs/cadMedico.php");
            }else{
                $_SESSION['msg'] = "Falha ao Cadastrar Medico";
                header("Location: ../VIEWs/cadMedico.php");
            }
        break;
        case 2:
        //Ler da Tabela
            $parametro = "where emailmedico = '".$_POST['login']."' and senhamed = '".$_POST['senha']."'";
            $info = DBRead('medicos', $parametro, 'emailmedico, senhamed, cpmedico');
            if($info){
                foreach ($info as $inf){
                    if($inf['emailmedico'] == $_POST['login']){
                        if($inf['senhamed'] == $_POST['senha']){
                            session_destroy();
                            $aux = $inf['cpmedico'];
                            setcookie('medic', "{$aux}", time()+(84600*7));
                            session_start();
                            $_SESSION['logM'] = true;
                            header("Location: ../VIEWs/homeMedico.php");
                        }
                    }
                }
            } else {
                $_SESSION['logM'] = false;
                $_SESSION['msg'] = "Email e/ou Senha Invalida";
                header("Location: ../login.php");
            }
        break;
        case 3:
        //Alterar item da Tabela
            $medico = array(
                'fonemedico'    =>  $_POST['telefone'],
                'emailmedico'   =>  $_POST['email']
            );
            $para = "cpmedico=".$_POST[''];
            var_dump(DBupdate('medicos', $medico, $para));
        break;
    }
?>