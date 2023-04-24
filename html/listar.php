<?php

$conn = new mysqli($host, $user, $password, $database);

$sql = "SELECT * FROM filmes";
$result = $conn->query($sql);

?>

<table>
  <thead>
    <tr>
      <th>Nome</th>
      <th>Diretor</th>
      <th>Categoria</th>
      <th>Sinopse</th>
      <th>Imagem</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['nome'] ?></td>
      <td><?= $row['diretor'] ?></td>
      <td><?= $row['categoria'] ?></td>
      <td><?= $row['sinopse'] ?></td>
      <td><img src="<?= $row['imagem'] ?>" alt="<?= $row['nome'] ?>"></td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php $conn->close(); ?>
