<?php

namespace app\admin\controller\v1;

use app\facade\Rbac;
use think\Controller;
use think\Request;

class Permission extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * 保存新建的权限节点
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $saveData['name'] = $request->post('name','');
        $saveData['description'] = $request->post('description','');
        $saveData['status'] = $request->post('status',0);
        $saveData['type'] = $request->post('type',0);
        $saveData['category_id'] = $request->post('category_id',0);
        $saveData['path'] = $request->post('path','');
        $saveData['create_time'] = time();
        if(Rbac::createPermission($saveData)){
            $this->result([],200,'success');
        }else{
            $this->result([],1000,'新增权限节点失败！');
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
