<?php
include 'conexao.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Pega o nome do Pokémon da URL
if (!isset($_GET['nome'])) {
    die("Pokémon não especificado.");
}

$nome = $conn->real_escape_string($_GET['nome']);

// Busca no banco
$sql = "SELECT * FROM tb_nationaldex WHERE nome_national='$nome' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Pokémon não encontrado.");
}

$poke = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title><?php echo $poke['nome_national']; ?> - Detalhes</title>
<style>
body { font-family: Arial, sans-serif; background: #f5f5f5; text-align: center; padding: 20px; }
h1 { color: #333; }
img { max-width: 300px; height: auto; margin: 20px 0; }
table { margin: 0 auto; border-collapse: collapse; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.1);}
th, td { padding: 10px 15px; border-bottom: 1px solid #ddd; text-transform: capitalize; }
th { background: #4CAF50; color: white; }
tr:nth-child(even) { background: #f2f2f2; }
</style>
</head>
<body>

<h1><?php echo $poke['nome_national']; ?> (#<?php echo $poke['numero_national']; ?>)</h1>
<img src="<?php echo $poke['imagem']; ?>" alt="<?php echo $poke['nome_national']; ?>">

<table>
<tr>
    <th>Tipo 1</th>
    <td><?php echo $poke['tipo1']; ?></td>
</tr>
<tr>
    <th>Tipo 2</th>
    <td><?php echo $poke['tipo2'] ?? '-'; ?></td>
</tr>
</table>

</body>
</html>
<?php $conn->close(); ?>
