<?php
/*Funções de Conexão*/    
    
    //Abrir coneçào com MySQL
    function DBConnect(){
        /*Variavel guarda conexão*/                                        /*Caso ocorra erro faça*/
        $link = mysqli_connect('localhost', 'root', NULL, 'sigma') or die(mysqli_connect_error());
        /*Setar codificação de Caracteres*/
        mysqli_set_charset($link, 'utf8') or die(mysqli_error($link));
        /*retornar a conexão*/
        return $link;
    }
    
    //fecha conexão com o MySQL
    function DBclose($link){
        mysqli_close($link) or die (mysqli_error($link));
    }
    
    //Proteção contra SQL Injection
    function DBEscape($data){
        $link  = DBConnect();
        if(!is_array($data)){
            $dados = mysqli_real_escape_string($link, $data);
        }else{
            $arr = $data;
            foreach ($arr as $key => $value){
                $key    = mysqli_real_escape_string($link, $key);
                $value  = mysqli_real_escape_string($link, $value);
                $data[$key] = $value;
            }
        }
        DBclose($link);
        return $data;
    }