<?php
/**
 * WebServer-FinalProject
 *
 * @autor Paula Miano <paulamiano@gmail.com>
 * (C) Copyright 2024 by Paula Miano
 */

namespace DAOs;

use Teacher\GivenCode\Abstracts\AbstractDTO;
use Teacher\GivenCode\Abstracts\IDAO;

class UserDAO implements IDAO {
    
    /**
     * @inheritDoc
     */
    public function getById(int $id) : ?AbstractDTO {
        // TODO: Implement getById() method.
    }
    
    /**
     * @inheritDoc
     */
    public function create(AbstractDTO $dto) : AbstractDTO {
        // TODO: Implement create() method.
    }
    
    /**
     * @inheritDoc
     */
    public function update(AbstractDTO $dto) : AbstractDTO {
        // TODO: Implement update() method.
    }
    
    /**
     * @inheritDoc
     */
    public function delete(AbstractDTO $dto) : void {
        // TODO: Implement delete() method.
    }
    
    /**
     * @inheritDoc
     */
    public function deleteById(int $id) : void {
        // TODO: Implement deleteById() method.
    }
}