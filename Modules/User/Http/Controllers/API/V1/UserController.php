<?php

namespace Modules\User\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use Modules\User\Services\UserService;
use Modules\User\Transformers\UserCollection;

class UserController extends BaseController
{
    public function __construct(
        private UserService $userService
    ) {
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();

        return $this->okResponse(new UserCollection($users));
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
        //
    }
}
