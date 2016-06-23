<?php

/**
 * 用户控制器
 */
namespace App\Http\Controllers\Api\V1;

class UserController extends BaseController
{
    /**
     * 获取用户信息
     *
     * @return mixed
     */
    public function me()
    {
        return $this->response->array($this->auth->user());
    }

    /**
     * 修改用户信息
     *
     * @return mixed
     */
    public function up()
    {
        // TODO
    }

}
