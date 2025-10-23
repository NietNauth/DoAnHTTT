<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

class ProductsController extends Controller
{
	public function detail($id)
	{
		// Lấy thông tin sản phẩm
		$product = DB::table('SanPham')
			->where('maSanPham', $id)
			->first();

		if (!$product) {
			return redirect()->route('frontend.products.index')
				->with('error', 'Sản phẩm không tồn tại.');
		}

		// Lấy danh sách hình ảnh của sản phẩm, theo thứ tự
		$images = DB::table('SanPhamHinhAnh')
			->where('maSanPham', $id)
			->orderBy('thuTu', 'asc')
			->get();

		// Lấy danh sách thuộc tính sản phẩm (màu sắc, số lượng)
		$attributes = DB::table('SanPhamThuocTinh')
			->where('maSanPham', $id)
			->get();

		return view('index.main.detail_product', [
			'product' => $product,
			'images' => $images,
			'attributes' => $attributes,
		]);
	}

	public function category($maDanhMuc)
	{
		// Lấy thông tin danh mục
		$category = DB::table('DanhMuc')
			->where('maDanhMuc', $maDanhMuc)
			->first();

		if (!$category) {
			return redirect()->route('frontend.products.index')
				->with('error', 'Danh mục không tồn tại.');
		}

		// Lấy danh sách sản phẩm trong danh mục, phân trang 12 sản phẩm/trang
		$products = DB::table('SanPham')
			->where('maDanhMuc', $maDanhMuc)
			->orderBy('ngayCapNhat', 'desc')
			->paginate(12);

		// Load ảnh và thuộc tính cho mỗi sản phẩm
		foreach ($products as $product) {
			$product->images = DB::table('SanPhamHinhAnh')
				->where('maSanPham', $product->maSanPham)
				->orderBy('thuTu', 'asc')
				->get();

			$product->attributes = DB::table('SanPhamThuocTinh')
				->where('maSanPham', $product->maSanPham)
				->get();
		}

		return view('index.main.category_product', [
			'category' => $category,
			'products' => $products,
		]);
	}

	public function allProducts()
	{
		// Lấy tất cả sản phẩm, sắp xếp theo ngày cập nhật mới nhất
		$products = DB::table('SanPham')
			->orderBy('ngayCapNhat', 'desc')
			->get();

		// Lấy tất cả hình ảnh cùng lúc (tránh N+1 query)
		$productIds = $products->pluck('maSanPham')->toArray();
		$images = DB::table('SanPhamHinhAnh')
			->whereIn('maSanPham', $productIds)
			->orderBy('thuTu', 'asc')
			->get()
			->groupBy('maSanPham');

		// Lấy tất cả thuộc tính cùng lúc
		$attributes = DB::table('SanPhamThuocTinh')
			->whereIn('maSanPham', $productIds)
			->get()
			->groupBy('maSanPham');

		// Gán hình ảnh và thuộc tính vào từng sản phẩm
		foreach ($products as $product) {
			$product->images = $images[$product->maSanPham] ?? collect();
			$product->attributes = $attributes[$product->maSanPham] ?? collect();
		}

		return view('index.main.all_products', [
			'products' => $products,
		]);
	}


}
