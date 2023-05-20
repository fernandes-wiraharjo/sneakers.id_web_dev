<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use Carbon\Carbon;

class UserRepository extends Repository implements MasterRepositoryInterface {

  public function __construct() {
    parent::__construct(
      app(config('ladmin.user', App\Models\User::class))
    );
  }

  /**
   * Update user
   *
   * @param Request $request
   * @param [Model] $user
   * @return Void
   */
  public function updateUser(Request $request, $id) {

    if(!is_null($request->password)) {
      $request->merge([
        'password' => bcrypt($request->password)
      ]);
    }

    $user = $this->model->findOrFail($id);
    $user->update($request->all());
    if($request->has('role_id')) {
      $user->roles()->sync($request->role_id);
    }
  }

  public function createUser(Request $request) {

    $request->merge([
      'password' => bcrypt($request->password)
    ]);
    $user = $this->model->create($request->all());
    if($request->has('role_id')) {
      $user->roles()->sync($request->role_id);
    }

  }

  public function createUserCustomer(Request $request) {

    $request->merge([
      'password' => bcrypt($request->password)
    ]);
    $user = $this->model->create($request->all());
    if($request->has('role_id')) {
      $user->roles()->sync($request->role_id);
    }

    return $user;
  }

  public function updateEmailVerifiedAt($id) {
    $user = $this->model->find($id);
    $user->update([
        'email_verified_at' => Carbon::now()
    ]);
  }
}
