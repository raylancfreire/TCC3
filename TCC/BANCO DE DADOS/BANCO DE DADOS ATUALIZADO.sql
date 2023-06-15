drop database tcc;
create database tcc;
USE tcc;

-- Tabela usuarios
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome_usuario VARCHAR(255) NOT NULL,
    cpf BIGINT(14),
    endereco VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

-- Tabela produtos
CREATE TABLE produtos (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    nome_produto VARCHAR(255),
    descricao VARCHAR(255),
    marca VARCHAR(200),
    categoria VARCHAR(255),
    preco DECIMAL(9, 2),
    quantidade_produto INT,
    imagem LONGBLOB,
    path VARCHAR(255),
    empresa VARCHAR(255),
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela empresas
CREATE TABLE empresas (
    id_empresa INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    endereco VARCHAR(255) NOT NULL UNIQUE,
    telefone VARCHAR(25) NOT NULL UNIQUE,
    cnpj VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(40) NOT NULL
);

-- Tabela pedidos
CREATE TABLE pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_produto INT,
    quantidade INT,
    valor_total DECIMAL(9, 2),
    endereco_entrega VARCHAR(255),
    data_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status_pedido VARCHAR(20),
    id_empresa INT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_produto) REFERENCES produtos(id_produto),
    FOREIGN KEY (id_empresa) REFERENCES empresas(id_empresa)
);

-- Adicionar índice na coluna status_pedido da tabela pedidos
ALTER TABLE pedidos ADD INDEX idx_status_pedido (status_pedido);
