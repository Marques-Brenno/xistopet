<?php

namespace app\database\models;

use app\database\Connect;

class ClientNotificationType extends Model
{
    protected string $table = 'tb_cliente_notificacao_tipo';

    public function insert(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("insert into $this->table(nome,usuario) 
                                values(
                                    AES_ENCRYPT(:nome, UNHEX(SHA2('". AES_KEY ."', 512))),
                                    :usuario
                                )");

            return $prepare->execute([
                ':nome' =>  $data['nome'],
                ':usuario' => $data['idUser']
            ]);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }

}