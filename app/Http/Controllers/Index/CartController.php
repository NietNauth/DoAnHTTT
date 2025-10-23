<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
	/**
	 * Hiển thị giỏ hàng
	 */
	public function index()
	{
		$cart = session()->get('cart', []);
		return view('index.main.cart', compact('cart'));
	}

	/**
	 * Thêm sản phẩm vào giỏ
	 */
	public function buy(Request $request)
	{
		// dd($request->all());

		$maSanPham = $request->input('maSanPham');
		$soLuong = max(1, (int) $request->input('soLuong', 1));
		$mauSac = $request->input('mauSac');

		// Kiểm tra màu
		if (!$mauSac) {
			return redirect()->back()->with('error', 'Vui lòng chọn màu sắc trước khi thêm vào giỏ!');
		}

		// Lấy thông tin sản phẩm
		$product = DB::table('SanPham')->where('maSanPham', $maSanPham)->first();
		if (!$product) {
			return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
		}

		// Kiểm tra tồn kho màu
		$attribute = DB::table('SanPhamThuocTinh')
			->where('maSanPham', $maSanPham)
			->where('mauSac', $mauSac)
			->first();

		if (!$attribute) {
			return redirect()->back()->with('error', 'Màu sản phẩm không tồn tại.');
		}

		if ($attribute->soLuong < $soLuong) {
			return redirect()->back()->with('error', 'Số lượng sản phẩm không đủ.');
		}

		// Lấy hình ảnh chính
		$hinhAnh = DB::table('SanPhamHinhAnh')
			->where('maSanPham', $maSanPham)
			->orderBy('thuTu', 'asc')
			->value('duongDan') ?? '';

		// Lấy giỏ hàng từ session
		$cart = session()->get('cart', []);

		// Key riêng cho từng màu
		$cartKey = $maSanPham . '_' . $mauSac;

		if (isset($cart[$cartKey])) {
			// Cập nhật số lượng, không vượt tồn kho
			$tongSoLuong = $cart[$cartKey]['soLuong'] + $soLuong;
			if ($tongSoLuong > $attribute->soLuong) {
				return redirect()->back()->with('error', 'Số lượng trong giỏ vượt quá tồn kho.');
			}
			$cart[$cartKey]['soLuong'] = $tongSoLuong;
		} else {
			$cart[$cartKey] = [
				'tenSanPham' => $product->tenSanPham,
				'giaGoc' => $product->giaGoc,
				'soLuong' => $soLuong,
				'hinhAnh' => $hinhAnh,
				'mauSac' => $mauSac,
			];
		}

		// Lưu giỏ vào session
		session()->put('cart', $cart);

		// Redirect sang giỏ hàng với message
		return redirect()->route('cart')->with('success', 'Đã thêm sản phẩm vào giỏ hàng.');
	}

	/**
	 * Cập nhật số lượng trong giỏ
	 */
	public function update(Request $request)
	{
		$cartKey = $request->input('cartKey');
		$soLuong = max(1, (int) $request->input('soLuong', 1));
		$cart = session()->get('cart', []);

		if (isset($cart[$cartKey])) {
			$cart[$cartKey]['soLuong'] = $soLuong;
			session()->put('cart', $cart);
			return redirect()->route('cart')->with('success', 'Cập nhật giỏ hàng thành công.');
		}

		return redirect()->route('cart')->with('error', 'Sản phẩm không tồn tại trong giỏ.');
	}

	/**
	 * Xóa 1 sản phẩm khỏi giỏ
	 */

	public function remove(Request $request)
	{
		$cartKey = $request->input('cartKey');  // lấy từ form
		$cart = session()->get('cart', []);
		if (isset($cart[$cartKey])) {
			unset($cart[$cartKey]);
			session()->put('cart', $cart);
			return redirect()->route('cart')->with('success', 'Xóa sản phẩm thành công.');
		}
		return redirect()->route('cart')->with('error', 'Sản phẩm không tồn tại trong giỏ.');
	}


	/**
	 * Xóa toàn bộ giỏ hàng
	 */
	public function clear()
	{
		session()->forget('cart');
		return redirect()->route('cart')->with('success', 'Đã xóa toàn bộ giỏ hàng.');
	}
}
