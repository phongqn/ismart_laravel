<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Role;
use PHPUnit\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'user']);
            return $next($request);
        });
    }
    public function info()
    {

        return view('admin.user.info');
    }
    public function list(Request $request)
    {
        $status = $request->input('status');
        //nếu trang thái là thùng rác
        if ($status == 'trash') {
            $list_action = [
                'restore' => 'Khôi ngục',
                'forceDelete' => 'Xóa vĩnh viễn'
            ];
            //lấy user xoá tạm thời mới nhất->có 2 act
            $users = User::onlyTrashed()->latest()->paginate(5);
        } else {
            $list_action = [
                'delete' => 'Xóa tạm thời',
                'forceDelete' => 'Xóa vĩnh viễn'
            ];
            $keyword = "";
            if ($request->input('q')) {
                $keyword = $request->input('q');
            }
            //lấy user đang hoạt động->có 1 act
            $users = User::where('name', 'LIKE', "%{$keyword}%")->paginate(5);
        }
        $count_active = User::count();
        $count_trash = User::onlyTrashed()->count();
        $count = [$count_active, $count_trash];
        return view('admin.user.list', compact('users', 'list_action', 'count'));
    }
    public function action(Request $request)
    {
        $list_check = $request->input('list_check');
        if ($list_check) {
            foreach ($list_check as $key => $id) {
                if (Auth::id() == $id) {
                    unset($list_check[$key]);
                }
            }
            if (!empty($list_check)) {
                $action = $request->input('action');
                //khôi phục
                if ($action == 'restore') {
                    User::withTrashed()
                        ->whereIn('id', $list_check)
                        ->restore();
                    Toastr::success('Thông báo', 'Khôi phục thành công');
                    return redirect('admin/user/list');
                }
                //xoá vĩnh viễn
                if ($action == 'forceDelete') {
                    User::withTrashed()->whereIn('id', $list_check)->forceDelete();
                    Toastr::success('Thông báo', 'Xoá vĩnh viễn thành công');
                    return redirect('admin/user/list');
                }
                //xoá tạm thời
                if ($action == 'delete') {
                    User::destroy($list_check);
                    Toastr::success('Thông báo', 'Xoá tạm thành công');
                    return redirect('admin/user/list');
                }
            }
        } else {
            Toastr::error('Thông báo', 'Bạn chưa chọn phần tử cần thao tác');
            return redirect('admin/user/list');
        }
    }
    //thêm
    public function add()
    {
        $list_roles = Role::all();
        return view('admin.user.add', compact('list_roles'));
    }
    public function store(Request $request)
    {
        // $request->validate(
        //     [
        //         'name' => 'required|string|max:255',
        //         'email' => 'required|string|email|max:255|unique:users',
        //         'password' => 'required|string|min:8|confirmed',
        //     ],
        //     [
        //         'required' => ':attribute không được để trống',
        //         'max' => ':attribute có độ dài tối đa :max kí tự',
        //         'min' => ':attribute có độ dài ít nhất :min kí tự',
        //         'confirmed' => 'Xác nhận mật khẩu không thành công'
        //     ],
        //     [
        //         'name' => 'Tên người dùng',
        //         'email' => 'Email',
        //         'password' => 'Mật khẩu',
        //     ]
        // );
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->roles()->attach($request->role);
            DB::commit();
            Toastr::success('Thông báo', 'Thêm thành công');
            return redirect('admin/user/list');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Message:" . $exception->getMessage() . '---Line: ' . $exception->getLine());
        }
        // foreach ($roleIds as $roleItem) {
        //     DB::table('role_user')->insert([
        //         'role_id' => $roleItem,
        //         'user_id' => $user->id,
        //     ]);
        // }

    }
    public function delete($id)
    {
        if (Auth::id() != $id) {
            User::destroy($id);
            Toastr::success('Thông báo', 'Xoá tạm thời thành công');
            return redirect('admin/user/list');
        } else {
            Toastr::error('Thông báo', 'Lỗi !');
            return redirect('admin/user/list');
        }
    }
    public function edit($id)
    {
        $user = User::withTrashed()->find($id);
        $list_roles = Role::all();
        $rolesOfUser = $user->roles;
        return view('admin.user.edit', compact('user', 'list_roles', 'rolesOfUser'));
    }
    public function update(Request $request, $id)
    {
        // $request->validate(
        //     [
        //         'name' => 'required|string|max:255',
        //         'password' => 'required|string|min:8|confirmed',
        //     ],
        //     [
        //         'required' => ':attribute không được để trống',
        //         'max' => ':attribute có độ dài tối đa :max kí tự',
        //         'min' => ':attribute có độ dài ít nhất :min kí tự',
        //         'confirmed' => 'Xác nhận mật khẩu không thành công'
        //     ],
        //     [
        //         'name' => 'Tên người dùng',
        //         'password' => 'Mật khẩu',
        //     ]
        // );

        User::where('id', $id)->update([
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
        ]);
        try {
            DB::beginTransaction();
            User::where('id', $id)->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user = User::withTrashed()->find($id);
            $user->roles()->sync($request->role);
            DB::commit();
            Toastr::success('Thông báo', 'Thêm thành công');
            return redirect('admin/user/list');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Message:" . $exception->getMessage() . '---Line: ' . $exception->getLine());
        }
    }
}
