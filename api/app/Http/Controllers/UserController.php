<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models as Models;
use App\Filters as Filters;
use App\Http\Requests as Requests;
use App\Http\Services as Services;

class UserController extends Controller
{
  private $user;
  private $userFilter;
  private $userService;

  public function __construct(
    Models\User $user,
    Filters\UserFilter $userFilter,
    Services\UserService $userService
  ) {
    $this->user = $user;
    $this->userFilter = $userFilter;
    $this->userService = $userService;
  }

  /**
   * users list with filters
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function getAll(Request $request)
  {
    $filters = $this->userFilter->fill($request->all());
    $object = $this->userService->getAll($filters);

    return response()->json($object, 200);
  }

  /**
   * get by id (primary key)
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function getId($id)
  {
    try {
      $model = $this->userService->getId($id);

      return response()->json($model, 201);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  /**
   * insert model
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function insert(Requests\InsertUserRequest $request)
  {
    try {
      $model = $this->user->fill($request->all());
      $user = $this->userService->insert($model);

      return response()->json([
        'success' => 'Usuário criado com sucesso!',
        'user' => $user
      ], 200);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  /**
   * update model
   *
   * @param  \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Requests\UpdateUserRequest $request, $id)
  {
    try {
      $model = $this->user->fill($request->all());
      $user = $this->userService->update($id, $model);

      return response()->json([
        'success' => 'Usuário atualizado com sucesso!',
        'user' => $user
      ], 200);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  /**
   * delete model
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $affected = $this->userService->destroy($id);

    return response()->json([
      'success' => 'Usuário removido com sucesso!',
      'affected' => $affected
    ], 200);
  }
}
