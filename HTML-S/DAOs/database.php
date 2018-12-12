<?php
    //Executa Querry
    function DBExecute($query){
        $link = DBConnect();
        $result = @mysqli_query($link, $query) or die(mysqli_error($link));
        DBclose($link);
        return $result;
    }
    
    //Grava Registros
    function DBCreate($table, array $data){
        $dat = DBEscape($data);
        
        $fields = implode(', ', array_keys($dat));
        $values = "'".implode("', '", $dat)."'";
        
        $query = "INSERT INTO {$table} ( {$fields} ) VALUES ( {$values} )";
        
        return DBExecute($query);
    }
    
    //Ler Registros
    function DBRead($table, $params = null, $coluna = '*'){
        /*Se $params tem valor ? então recebe ... : senão*/
        $params = ($params) ? " {$params}": null;
        $query = "SELECT {$coluna} FROM {$table}{$params}";
        $result = DBExecute($query);
        /*Numero de Linhas na tabela*/
        if(!mysqli_num_rows($result)){
            return false;
        }else{
            while($res = mysqli_fetch_assoc($result)){
                $data[] = $res;
            }
            return $data;
        }
    }
    
    //Altera Registros
    function DBupdate($tabela, array $data, $where = NULL){
        /*Lup de Repetição percorre array, percorre a chave(indice) e valor*/
        foreach ($data as $key => $value){
            $fields[] = "{$key} = '{$value}'";
        }
        $fields = implode(', ', $fields);
        
        $where = ($where) ? " WHERE {$where}" : null;
        $querry = "UPDATE {$tabela} SET {$fields}{$where}";
        var_dump($querry);
        return DBExecute($querry);
    }
    
    //Deletar item Tabela
    function DBExcluir($tabela, $where = NULL){
        $where = ($where) ? " WHERE {$where}" : null;
        $querry = "DELETE FROM {$tabela}{$where}";
        return DBExecute($querry);
    }