<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Flash;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends AppBaseController
{
    /** @var RoleRepository $roleRepository*/
    private $roleRepository;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepository = $roleRepo;
    }

    public function index(Request $request)
    {
        $roles = $this->roleRepository->paginate(10);

        return view('roles.index')->with('roles', $roles);
    }

    public function create()
    {
        $sPermissions=Permission::orderBy('name')->get();
        $permissions=[];
        return view('roles.create',compact('sPermissions','permissions'));
    }

    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();
        
        try{
            DB::beginTransaction();

            $role = Role::create(['name'=>$input['name'],'guard_name'=>$input['guard_name']]);

            if($request->has('permission_id')) {
                $permissions=Permission::whereIn('id',$input['permission_id'])->get();
                $role->syncPermissions($permissions);
            }

            DB::commit();
            Flash::success('Role updated successfully.');
        }catch (Exception $e){
            DB::rollBack();
            Flash::error('Role updated not save.');
        }

        return redirect(route('roles.index'));
    }

    public function show($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');
            return redirect(route('roles.index'));
        }

        $permissions = $role->permissions ? $role->permissions->pluck('name','id') : [];

        return view('roles.show', compact('role', 'permissions'));
    }


    public function edit($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        $sPermissions=Permission::orderBy('name')->get();
        $permissions=$role->permissions->pluck('id')->toArray();

        return view('roles.edit',compact('sPermissions', 'permissions'))->with('role', $role);
    }

    public function update($id, UpdateRoleRequest $request)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');
            return redirect(route('role.index'));
        }

        $input=$request->all();

        try{
            DB::beginTransaction();
            $role->update(['name'=>$input['name'],'guard_name'=>$input['guard_name']]);

            if($request->has('permission_id')){
                $permissions=Permission::whereIn('id',$input['permission_id'])->get();
                $role->syncPermissions($permissions);
            }

            DB::commit();
            Flash::success('Role updated successfully.');
        }catch (Exception $e){
            DB::rollBack();
            Flash::error('Role updated not save.');
        }
        return redirect(route('roles.index'));
    }

    public function destroy($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        $this->roleRepository->delete($id);

        Flash::success('Role deleted successfully.');

        return redirect(route('roles.index'));
    }
}
