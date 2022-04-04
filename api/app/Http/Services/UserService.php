<?php

namespace App\Http\Services;

use App\Models as Models;
use App\Filters as Filters;
use App\Http\Services as Services;
use App\Http\Repositories as Repositories;

class UserService
{
  private $userRepository;

  public function __construct(Repositories\UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  /**
   * 
   *
   * @param Filters\UserFilter $filters
   * @return object
   */
  public function getAll(Filters\UserFilter $filters = null)
  {
    try {
      return $this->userRepository->getAll($filters);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  /**
   * 
   *
   * @param int $id
   * @return Models\User
   */
  public function getId($id)
  {
    try {
      if (!$id)
        throw new \Exception("Identificador do usuário não enviado");

      return $this->userRepository->getId($id);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  /**
   * 
   *
   * @param int $id
   * @return boolean
   */
  public function existsId($id)
  {
    try {
      if (!$id)
        throw new \Exception("Identificador do usuário não enviado");

      return $this->userRepository->existsId($id);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  /**
   * insert model
   *
   * @param Models\User $user
   * @return Models\User
   */
  public function insert(Models\User $user)
  {
    try {
      if (!$user->id = $this->userRepository->insert($user))
        throw new \Exception("Não foi possivel salvar o usuário", 400);

      return $this->getId($user->id);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  /**
   * update model
   *
   * @param int $id
   * @param Models\User $user
   * @return Models\User
   */
  public function update($id, Models\User $user)
  {
    try {
      if (!$this->existsId($id))
        throw new \Exception("Este usuário não existe", 400);

      if (!$this->userRepository->update($id, $user))
        throw new \Exception("Não foi possivel alterar o usuário", 400);

      return $this->getId($id);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  /**
   * delete model
   *
   * @param int $id
   * @return int $affected
   */
  public function destroy($id)
  {
    try {
      if (!$id)
        throw new \Exception("Identificador do usuário não enviado", 400);

      if (!$this->existsId($id))
        throw new \Exception("Este usuário não existe", 400);

      return $this->userRepository->destroy($id);
    } catch (\Exception $e) {
      throw $e;
    }
  }
}
