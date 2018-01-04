<?php

/*
 * Classe para operações CRUD na tabela ARTIGO   
 */

class crudCliente {
    /*
     * Atributo para conexão com o banco de dados   
     */

    private $pdo = null;

    /*
     * Atributo estático para instância da própria classe    
     */
    private static $crudCliente = null;

    /*
     * Construtor da classe como private  
     * @param $conexao - Conexão com o banco de dados  
     */

    private function __construct($conexao) {
        $this->pdo = $conexao;
    }

    /*
     * Método estático para retornar um objeto crudBlog    
     * Verifica se já existe uma instância desse objeto, caso não, instância um novo    
     * @param $conexao - Conexão com o banco de dados   
     * @return $crudBlog - Instancia do objeto crudBlog    
     */

    public static function getInstance($conexao) {
        if (!isset(self::$crudCliente)):
            self::$crudCliente = new crudCliente($conexao);
        endif;
        return self::$crudCliente;
    }

    /*
     * Metodo para inclusão de novos registros   
     * @param $categoria - Valor para o campo categoria   
     * @param $titulo - Valor para o campo titulo   
     * @param autor  - Valor para o campo autor   
     */

    public function insert($nome, $curso, $telefone, $email) {
        if (!empty($categoria) && !empty($titulo) && !empty($autor)):
            try {
                $sql = "INSERT INTO cliente (nome, curso, telefone, email) VALUES (?, ?, ?, ?)";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1, $nome);
                $stm->bindValue(2, $curso);
                $stm->bindValue(3, $telefone);
                $stm->bindValue(4, $email);
                $stm->execute();
                echo "<script>alert('Cliente inserido com sucesso')</script>";
            } catch (PDOException $erro) {
                echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";
            }
        endif;
    }

    /*
     * Metodo para edição de registros   
     * @param $categoria - Valor para o campo categoria   
     * @param $titulo - Valor para o campo titulo   
     * @param autor  - Valor para o campo autor   
     * @param id   - Valor para o campo id   
     */

    public function update($nome, $curso, $telefone, $email, $id_cliente) {
        if (!empty($nome) && !empty($curso) && !empty($telefone) && !empty($email) && !empty($id_cliente)):
            try {
                $sql = "UPDATE cliente SET nome=?, curso=?, telefone=?, email=? WHERE id_cliente=?";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1, $nome);
                $stm->bindValue(2, $curso);
                $stm->bindValue(3, $telefone);
                $stm->bindValue(4, $email);
                $stm->bindValue(5, $id_cliente);
                $stm->execute();
                echo "<script>alert('Cliente atualizado com sucesso')</script>";
            } catch (PDOException $erro) {
                echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";
            }
        endif;
    }

    /*
     * Metodo para exclusão de registros   
     * @param id - Valor para o campo id   
     */

    public function delete($id_cliente) {
        if (!empty($id)):
            try {
                $sql = "DELETE FROM cliente WHERE id_cliente=?";
                $stm = $this->pdo->prepare($sql);
                $stm->bindValue(1, $id_cliente);
                $stm->execute();
                echo "<script>alert('Cliente excluido com sucesso')</script>";
            } catch (PDOException $erro) {
                echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";
            }
        endif;
    }

    /*
     * Metodo para consulta de artigos   
     * @return $dados - Array com os registros retornados pela consulta   
     */

    public function getAllCliente() {
        try {
            $sql = "SELECT * FROM cliente";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $dados = $stm->fetchAll(PDO::FETCH_OBJ);
            return $dados;
        } catch (PDOException $erro) {
            echo "<script>alert('Erro na linha: {$erro->getLine()}')</script>";
        }
    }

}
