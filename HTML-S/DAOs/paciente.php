<?php
    session_start();
    /*Chammadas de arquivos*/
    require './connection.php';
    require './database.php';
    require './Vali/validaCPF.php';
    $_SESSION['msg'] = null;

    if(!isset($_POST['rota'])){
        $_SESSION['msg'] = "Não pude fases, preencha os campos*";
        header("Location: ../VIEWs/cadpaciente.php");
    }

    switch(@$_POST['rota']){
        //Cadastro
        case 1:
            $parametro = "where cpfpaciente = '$_POST[cpf]' or emailpaciente = '$_POST[email]'";
            $info = DBRead('pacientes', $parametro ,'emailpaciente, cpfpaciente');
            foreach ($info as $inf){
                if($inf['cpfpaciente'] == $_POST['cpf']){
                    $a++;
                }
                if($inf['emailpaciente'] == $_POST['email']){
                    $b++;
                }
            }
            if($_POST['senha'] != $_POST['csenha']){
                $c++;
            }
            $teste = preg_replace("/[^0-9]/", "", @$_POST['cpf']);
            if(strlen($teste) != 11){
                $d++;
            } else if(validarCPF(@$_POST['cpf'])){
                echo 'CPF Válido';
            } else {
                $e++;
            }
            if(isset($a)||isset($b)||isset($c)||isset($d)||isset($e)){
                if ($a!=0) {
                    $_SESSION['msg'] = "Este CPF já está cadastrado!*<br/>";
                }
                if ($b!=0) {
                    $_SESSION['msg'] = $_SESSION['msg'] . "Este e-mail está em uso!*<br/>";
                }
                if ($c!=0) {
                    $_SESSION['msg'] = $_SESSION['msg'] . "Senhas não conferem!*<br/>";
                }
                if ($d!=0) {
                    $_SESSION['msg'] = $_SESSION['msg'] . "CPF deve ter no minimo de 11 caracteres*<br/>";
                }
                if ($e!=0) {
                    $_SESSION['msg'] = $_SESSION['msg'] . 'CPF: '.$_POST['cpf'].' - Invalido*';
                }
                header("Location: ../VIEWs/cadpaciente.php");
                exit;
            }
        //Inserir na Tabela
            $paciente = array(
                'nomepaciente'    =>  @$_POST['nome'],
                'enderpaciente'   =>  @$_POST['endereco'],
                'cpfpaciente'     =>  @$_POST['cpf'],
                'sexopaciente'    =>  @$_POST['sexo'],
                'fonepaciente'    =>  @$_POST['telefone'],
                'emailpaciente'   =>  @$_POST['email'],
                'nascpaciente'    =>  @$_POST['datnascimento'],
                'senhapac'        =>  @$_POST['senha']
            );
            $grava = DBCreate('pacientes', $paciente);
            if($grava){
                $_SESSION['msg'] = "Paciente Cadastrado com Exito!";
                header("Location: ../VIEWs/cadpaciente.php");
            }else{
                $_SESSION['msg'] = "Falha ao Cadastrar Paciente!";
                header("Location: ../VIEWs/cadpaciente.php");
            }
        break;
        //Login
        case 2:
            $parametro = "where emailpaciente = '".$_POST['login']."' and senhapac = '".$_POST['senha']."'";
            $info = DBRead('pacientes', $parametro, 'emailpaciente, senhapac, cppaciente');
            if($info){
                foreach ($info as $inf){
                    if($inf['emailpaciente'] == $_POST['login']){
                        if($inf['senhapac'] == $_POST['senha']){
                            $_SESSION['logP'] = true;
                            $_SESSION['codP'] = $info['cppaciente'];
                            header("Location: ../VIEWs/homePaciente.php");
                        }
                    }
                }
            } else {
                $_SESSION['logP'] = false;
                $_SESSION['msg'] = "Email e/ou Senha Invalida";
                header("Location: ../login.php");
            }
        break;
    }
?>