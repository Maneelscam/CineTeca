<?php
$dbHost = 'Localhost';
$dbUsername = 'root';
$dbPassword = 'vandercassia07';
$dbName = 'cineteca';

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conexao->connect_errno) {
    print "Erro";
}
