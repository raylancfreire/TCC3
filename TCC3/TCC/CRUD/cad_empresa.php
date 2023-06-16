
<?php
// Configurações do banco de dados
$host = 'localhost';
$dbName = 'tcc';
$username = 'root';
$password = '';

// Função para validar o formato de um CNPJ
function validarCNPJ($cnpj) {
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

    // Verifica se o CNPJ possui 14 dígitos
    if (strlen($cnpj) !== 14) {
        return false;
    }

    // Verifica se todos os dígitos são iguais (ex: 00000000000000)
    if (preg_match('/(\d)\1{13}/', $cnpj)) {
        return false;
    }

    // Validação do primeiro dígito verificador
    $soma = 0;
    for ($i = 0, $j = 5; $i < 12; $i++) {
        $soma += $cnpj[$i] * $j;
        $j = ($j === 2) ? 9 : $j - 1;
    }
    $resto = $soma % 11;
    if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)) {
        return false;
    }

    // Validação do segundo dígito verificador
    $soma = 0;
    for ($i = 0, $j = 6; $i < 13; $i++) {
        $soma += $cnpj[$i] * $j;
        $j = ($j === 2) ? 9 : $j - 1;
    }
    $resto = $soma % 11;
    return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
}
// Função para validar o formato de um email
function validarEmail($email) {
    // Verifica se o email possui um formato válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    // Verifica o domínio do email
    $domain = explode('@', $email)[1];
    if (!checkdnsrr($domain, 'MX')) {
        return false;
    }

    return true;
}


// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera os dados do formulário
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $cnpj = $_POST['cnpj'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Validação dos campos
    $errors = [];
    if (empty($nome)) {
        $errors[] = 'O campo "Nome" é obrigatório.';
    }
    if (empty($endereco)) {
        $errors[] = 'O campo "Endereço" é obrigatório.';
    }
    if (empty($telefone)) {
        $errors[] = 'O campo "Telefone" é obrigatório.';
    }
    if (empty($cnpj)) {
        $errors[] = 'O campo "CNPJ" é obrigatório.';
    } elseif (!validarCNPJ($cnpj)) {
        $errors[] = 'O campo "CNPJ" está em um formato inválido.';
    }
    if (empty($email)) {
        $errors[] = 'O campo "E-mail" é obrigatório.';
    } elseif (!validarEmail($email)) {
        $errors[] = 'O campo "E-mail" está em um formato inválido.';
    }
    if (empty($senha)) {
        $errors[] = 'O campo "Senha" é obrigatório.';
    }

    // Se não houver erros, realiza o cadastro da loja
    if (empty($errors)) {
        try {
            // Conexão com o banco de dados
            $conn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Prepara a consulta SQL
            $stmt = $conn->prepare('INSERT INTO empresas (nome, endereco, telefone, cnpj, email, senha) VALUES (:nome, :endereco, :telefone, :cnpj, :email, :senha)');
    
            // Executa a consulta
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':endereco', $endereco);
            $stmt->bindValue(':telefone', $telefone);
            $stmt->bindValue(':cnpj', $cnpj);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':senha', $senha);
    
            if ($stmt->execute()) {
                echo "<script>
                    alert('Loja cadastrada com sucesso!!!');
                    window.location.href='../login.php';
                </script>";
            }
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $errors[] = 'Já existe uma loja cadastrada com algum dado que você informou.';
            } else {
                echo 'Erro ao cadastrar a loja: ' . $e->getMessage();
            }
        }
    }
}
?>
