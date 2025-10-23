<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\VaiTro;

class VaiTroController extends Controller
{
    public function index()
    {
        $data = VaiTro::orderBy("maVaiTro", "desc")->paginate(10);
        return view("admin.vaitro.read", compact("data"));
    }

    public function create()
    {
        $action = url('admin/vaitro/create-post');
        return view("admin.vaitro.create_update", compact('action'));
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'tenVaiTro' => 'required|max:50',
            'moTa' => 'nullable|max:255',
        ]);

        VaiTro::create($request->all());

        return redirect()->to('admin/vaitro')
            ->with('success', 'Thêm vai trò thành công');
    }

    public function update($maVaiTro)
    {
        $record = VaiTro::findOrFail($maVaiTro);
        $action = url("admin/vaitro/update-post/$maVaiTro");
        return view("admin.vaitro.create_update", compact('record', 'action'));
    }

    public function updatePost(Request $request, $maVaiTro)
    {
        $request->validate([
            'tenVaiTro' => 'required|max:100',
            'moTa' => 'nullable|max:255',
        ]);

        $vaiTro = VaiTro::findOrFail($maVaiTro);
        $vaiTro->update($request->all());

        return redirect('admin/vaitro')->with('success', 'Cập nhật vai trò thành công');
    }

    public function delete($maVaiTro)
    {
        $vaiTro = VaiTro::findOrFail($maVaiTro);
        $vaiTro->delete();

        return redirect('admin/vaitro')->with('success', 'Xóa vai trò thành công');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $data = VaiTro::where('maVaiTro', 'LIKE', "%$keyword%")
            ->orWhere('tenVaiTro', 'LIKE', "%$keyword%")
            ->orderBy("maVaiTro", "desc")
            ->paginate(10);

        return view("admin.vaitro.read", compact("data"));
    }
}
