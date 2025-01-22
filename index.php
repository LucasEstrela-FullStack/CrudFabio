
<?php
      include_once "conexao.php";

      // Verificar se houve envio do formulário via POST
      
      // echo"<pre>";
      // print_r($_SERVER);
      // echo"<pre>";
      
      if($_SERVER['REQUEST_METHOD'] == "POST"){
          // echo"Tem algo que foi enviado pelo formulário";
          $nome = $_POST['nome'];
          $sobrenome = $_POST['sobrenome'];
          $nascimento = $_POST['nascimento'];
          $endereco = $_POST['endereco'];
          $telefone = $_POST['telefone'];
      
          $conexaoComBanco = abrirBanco();
      
          $sql = "insert into pessoas (nome, sobrenome, nascimento, endereco, telefone)
              values ('$nome', '$sobrenome', '$nascimento', '$endereco', '$telefone')";
      
          if ($conexaoComBanco->query($sql) === TRUE) {
              echo ":)Contato salvo com sucesso no banco de dados :)";
          }else{
              echo ":( Erro ao salvar no banco de dados". $conexaoComBanco->error;
          }
      
          fecharBanco($conexaoComBanco);
      }
    
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Agenda de Contatos</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="cadastrar.php">Cadastrar</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <h2>Lista de Contatos</h2>
        <table>
            <thead>
                <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Nascimento</th>
                <th>Endereço</th>
                <th>Telefone</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    // Abrir Conexão com o banco de dados
                    $conexaoComBanco = abrirBanco();

                    // Criar o SQL para consultar
                    $sql = "SELECT * FROM pessoas";

                    // Executar o SQL
                    $result = $conexaoComBanco->query($sql);

                    if ($result->num_rows > 0) {

                        while($registro = $result->fetch_assoc()){


                            ?>

                                <tr>
                                    <td><?= $registro['id']?></td>
                                    <td><?= $registro['nome']?></td>
                                    <td><?= $registro['sobrenome']?></td>
                                    <td><?= $registro['nascimento']?></td>
                                    <td><?= $registro['endereco']?></td>
                                    <td><?= $registro['telefone']?></td>
                                        <td>
                                    <a href="editar.php?id=<?= $registro['id']?>"><button>Editar</button></a>

                                    <a href="?acao=del&id=<?= $registro['id'] ?>"
                                        onclick="return confirm ('Tem certeza que deseja Excluir?')">
                                     <button>Excluir</button></a>
                                        </td>
                                </tr>
                            <?php
                        }

                    

                    }else{
                        // Exibir mensagem de tabela vazia
                        echo("<tr><td colspan='6'>Nenhum Registro Encontrado</td></tr>");
                    }
                ?>
                <tr>
                    
                </tr>
            </tbody>
        </table>
    </section>

</body>
</html>

<!-- php -S localhost:8080 -->