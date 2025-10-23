<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//sử dụng QueryBuilder thì using đối tượng sau
use DB;

class HomeController extends Controller
{
    public function index()
    {
        return view("index.main.home");
    }

    public static function hotProducts()
    {
        $products = DB::table('SanPham')
            ->leftJoin('SanPhamHinhAnh', function ($join) {
                $join->on('SanPham.maSanPham', '=', 'SanPhamHinhAnh.maSanPham')
                    ->where('SanPhamHinhAnh.thuTu', '=', 0);
            })
            ->where('SanPham.trangThai', 1)
            ->orderBy('SanPham.ngayCapNhat', 'desc')
            ->limit(6)
            ->select('SanPham.*', 'SanPhamHinhAnh.duongDan as hinhAnh')
            ->get();

        // Lấy màu cho từng sản phẩm
        foreach ($products as $product) {
            $colors = DB::table('SanPhamThuocTinh')
                ->where('maSanPham', $product->maSanPham)
                ->pluck('mauSac')
                ->unique()
                ->toArray();
            $product->mauSac = $colors;
        }

        return $products;
    }

    public static function getProductsByCategory()
    {
        // Lấy danh sách danh mục đang hoạt động
        $categories = DB::table('DanhMuc')
            ->where('trangThai', 1)
            ->orderBy('tenDanhMuc', 'asc')
            ->get();

        $result = [];

        foreach ($categories as $category) {
            // Lấy sản phẩm thuộc danh mục đó
            $products = DB::table('SanPham')
                ->leftJoin('SanPhamHinhAnh', function ($join) {
                    $join->on('SanPham.maSanPham', '=', 'SanPhamHinhAnh.maSanPham')
                        ->where('SanPhamHinhAnh.thuTu', '=', 0);
                })
                ->where('SanPham.maDanhMuc', $category->maDanhMuc)
                ->select(
                    'SanPham.maSanPham',
                    'SanPham.tenSanPham',
                    'SanPham.moTa',
                    'SanPham.giaGoc',
                    'SanPhamHinhAnh.duongDan as hinhAnh'
                )
                ->orderBy('SanPham.ngayCapNhat', 'desc')
                ->get();

            // Lấy màu sắc cho từng sản phẩm
            foreach ($products as $product) {
                $product->mauSac = DB::table('SanPhamThuocTinh')
                    ->where('maSanPham', $product->maSanPham)
                    ->pluck('mauSac')
                    ->filter()
                    ->unique()
                    ->values()
                    ->toArray();
            }

            // Gán danh sách sản phẩm vào danh mục
            $result[] = [
                'maDanhMuc' => $category->maDanhMuc,
                'tenDanhMuc' => $category->tenDanhMuc,
                'sanPham' => $products
            ];
        }

        return $result;
    }

    public static function getAllCategories()
    {
        $categories = DB::table('DanhMuc')
            ->orderBy('tenDanhMuc', 'asc')
            ->get();

        return $categories;
    }


}
