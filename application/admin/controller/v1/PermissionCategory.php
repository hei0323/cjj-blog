<?php

namespace app\admin\controller\v1;
use app\facade\Rbac;
use think\Controller;
use think\Request;

class PermissionCategory extends Controller
{
    /**
     * 显示权限分组列表
     *
     * @return \think\Response
     */
    public function index()
    {

        $where = [];
        if($status = $this->request->get('status')) $where[] = ['status','=',$status];
        if($name = $this->request->get('name')) $where[] = ['name','like','%'.$name.'%'];
        if($des = $this->request->get('des')) $where[] = ['des','like','%'.$des.'%'];

        $result= Rbac::getPermissionCategory($where);

        if($result){
            $this->result($result,200,'success');
        }else{
            $this->result([],200,'获取权限分组列表失败!');
        }
    }

    /**
     * 新增用户权限分组
     *
     * @return \think\Response
     */
    public function create()
    {

    }

    /**
     * 新增用户权限分组
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $saveData['name'] = $this->request->post('name');
        $saveData['description'] = $this->request->post('des');
        $saveData['status'] = $this->request->post('status',2);
        $saveData['create_time'] = time();
        $result= Rbac::savePermissionCategory($saveData);
        if($result){
            $this->result([],200,'success');
        }else{
            $this->result([],200,'新增权限分组失败!');
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
        $where[] = ['id','=',$id];
        $result= Rbac::getPermissionCategory($where);

        if($result){
            $this->result($result,200,'success');
        }else{
            $this->result([],200,'获取权限分组失败!');
        }
    }

    /**
     * 保存更新的权限分组
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        $saveData['id'] = $id;
        $saveData['name'] = $request->put('name');
        $saveData['description'] = $request->put('des');
        $saveData['status'] = $request->put('status',2);
        $result= Rbac::savePermissionCategory($saveData);
        if($result){
            $this->result([],200,'success');
        }else{
            $this->result([],200,'编辑权限分组失败!');
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $result= Rbac::delPermissionCategory($id);
        if($result){
            $this->result([],200,'success');
        }else{
            $this->result([],200,'编辑权限分组失败!');
        }
    }
}
