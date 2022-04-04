<?php

namespace App\Http\Repositories;

use App\Models as Models;
use App\Filters as Filters;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository
{
  private $user;

  public function __construct(Models\User $user)
  {
    $this->user = $user;
  }

  public function getAll(Filters\UserFilter $filters = null)
  {
    try {
      $query = $this->user->query();

      $items = [];
      $size = null;
      $total = $query->count();

      if ($filters->limit) {
        $items = $query->skip($filters->offset)->take($filters->limit)->get();
        $size = isset($items) ? sizeof($items) : 0;
      } else {
        $items = $query->get();
        $size = isset($items) ? sizeof($items) : 0;
      }

      $result = [
        "items" => $items,
        "size" => $size,
        "total" => $total,
      ];

      return $result;
    } catch (\Exception $e) {
      throw new \Exception(json_encode([
        "message" => `Erro ao buscar (sql)`,
        "exception" => $e->getMessage()
      ]));
    }
  }

  public function getId($id)
  {
    try {
      return $this->user->findOrFail($id);
    } catch (\Exception $e) {
      throw new \Exception(json_encode([
        "message" => `Erro ao buscar (sql)`,
        "exception" => $e->getMessage()
      ]));
    }
  }

  public function existsId($id)
  {
    try {
      return $this->user->where('id', $id)->exists();
    } catch (\Exception $e) {
      throw new \Exception(json_encode([
        "message" => `Erro ao buscar (sql)`,
        "exception" => $e->getMessage()
      ]));
    }
  }

  public function insert(Models\User $user)
  {
    try {
      return $this->user->insertGetId([
        'name' => $user->name,
        'phone' => $user->phone,
        'photo' => $user->photo,
        'email' => $user->email,
        'password' => bcrypt($user->password)
      ]);
    } catch (\Exception $e) {
      throw new \Exception(json_encode([
        "message" => `Erro ao inserir (sql)`,
        "exception" => $e->getMessage()
      ]));
    }
  }

  public function update($id, Models\User $user)
  {
    try {
      return $this->user
        ->where('id', $id)
        ->update([
          'name' => $user->name,
          'phone' => $user->phone,
          'photo' => $user->photo,
          'email' => $user->email,
          'password' => $user->password,
        ]);
    } catch (\Exception $e) {
      throw new \Exception(json_encode([
        "message" => `Erro ao atualizar (sql)`,
        "exception" => $e->getMessage()
      ]));
    }
  }

  public function destroy($id)
  {
    try {
      return $this->user
        ->where('id', $id)
        ->delete();
    } catch (\Exception $e) {
      throw new \Exception(json_encode([
        "message" => `Erro ao deletar (sql)`,
        "exception" => $e->getMessage()
      ]));
    }
  }
}
