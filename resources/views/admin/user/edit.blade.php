@extends('layouts.admin')
@section('title', 'Cập nhật người dùng')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Cập nhật thông tin
            </div>
            <div class="card-body">
                <form action="{{ url('admin/user/update', $user->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Họ và tên</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="text" name="email" id="email" value="{{ $user->email }}"
                            disabled>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input class="form-control" type="password" name="password" id="password">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Xác Nhận Mật khẩu</label>
                        <input class="form-control" type="password" name="password_confirmation" id="password-confirm">
                    </div>
                    <div class="form-group">
                        <label for="">Nhóm quyền</label>
                        <select class="form-control select2_init" id="" name="role[]" multiple>
                            <option value=""></option>
                            @foreach ($list_roles as $role)
                                <option {{ $rolesOfUser->contains('id', $role->id) ? 'selected' : '' }}
                                    value=" {{ $role->id }}">
                                    {{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" value="Cập nhật" class="btn btn-primary" name="btn_update">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection
