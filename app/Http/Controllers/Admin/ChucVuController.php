<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ChucVu;

class ChucVuController extends Controller
{
    public function index()
    {
        $data = ChucVu::orderBy("maChucVu", "desc")->paginate(10);
        return view("admin.chucvu.read", compact("data"));
    }

    public function create()
    {
        $action = url('admin/chucvu/create-post');
        return view("admin.chucvu.create_update", compact('action'));
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'tenChucVu' => 'required|max:100',
            'moTa' => 'nullable|max:255',
        ]);

        ChucVu::create($request->all());

        return redirect()->to('admin/chucvu')
            ->with('success', 'Thêm chức vụ thành công');
    }

    public function update($maChucVu)
    {
        $record = ChucVu::findOrFail($maChucVu);
        $action = url("admin/chucvu/update-post/$maChucVu");
        return view("admin.chucvu.create_update", compact('record', 'action'));
    }

    public function updatePost(Request $request, $maChucVu)
    {
        $request->validate([
            'tenChucVu' => 'required|max:100',
            'moTa' => 'nullable|max:255',
        ]);

        $chucVu = ChucVu::findOrFail($maChucVu);
        $chucVu->update($request->all());

        return redirect('admin/chucvu')->with('success', 'Cập nhật chức vụ thành công');
    }

    public function delete($maChucVu)
    {
        $chucVu = ChucVu::findOrFail($maChucVu);
        $chucVu->delete();

        return redirect('admin/chucvu')->with('success', 'Xóa chức vụ thành công');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $data = ChucVu::where('maChucVu', 'LIKE', "%$keyword%")
            ->orWhere('tenChucVu', 'LIKE', "%$keyword%")
            ->orderBy("maChucVu", "desc")
            ->paginate(10);

        return view("admin.chucvu.read", compact("data"));
    }
}
