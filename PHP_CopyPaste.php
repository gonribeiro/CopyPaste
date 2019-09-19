<?php

// Seleciona o csv
$csv = getCSV('Pasta1.csv');		

// Abre o csv e salva em array
function getCSV($getCSV) 
{
    $file = fopen($getCSV, "r");
    $result = array();
    $i = 0;
    while (!feof($file)):
        if (substr(($result[$i] = fgets($file)), 0, 10) !== ';;;;;;;;') :
            $i++;
        endif;
    endwhile;
    fclose($file);
    return $result;
}	

// Leitura e quebra das linhas
for ($i=0; $i < count($csv); $i++) 
{
    $entradacsv[] = getLine($csv, $i);
}

// Leitura e quebra das colunas
function getLine($array, $index) 
{
    return explode(';', $array[$index]); 
}

// Percorre a lista de arquivos a serem copiados
for ($i=1; $i < count($entradacsv) ; $i++) 
{
    // Pega nome do arquivo 
    $nome_arquivo = substr(strstr(substr(strstr(trim($entradacsv[$i][1]), '\\'), 1), '\\'), 1);

    // Copia o arquivo para novo diretório
    if (!copy(trim($entradacsv[$i][1]), 'certificados_copia\\'.trim($entradacsv[$i][0]).' - '.trim($nome_arquivo))) 
    {
        echo "Não encontrado: ".$i.'-'.$nome_arquivo.'<br/>';
    }
}

/* Outros *para Excel

=CONCATENAR("'";B4;"'";",")
=Substituir(B2; texto_antigo; novo_texto)
https://www.aprenderexcel.com.br/2015/tutoriais/como-remover-ou-substituir-algum-caractere-funcao=substituir

*/

?>