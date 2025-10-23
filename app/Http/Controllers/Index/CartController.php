<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use App\Models\ThanhToan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
		$maSanPham = $request->input('maSanPham');
		$soLuong = max(1, (int) $request->input('soLuong', 1));
		$mauSac = $request->input('mauSac');

		if (!$mauSac) {
			return redirect()->back()->with('error', 'Vui lòng chọn màu sắc trước khi thêm vào giỏ!');
		}

		$product = DB::table('SanPham')->where('maSanPham', $maSanPham)->first();
		if (!$product) {
			return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
		}

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

		$hinhAnh = DB::table('SanPhamHinhAnh')
			->where('maSanPham', $maSanPham)
			->orderBy('thuTu', 'asc')
			->value('duongDan') ?? '';

		$cart = session()->get('cart', []);

		$cartKey = $maSanPham . '_' . $mauSac;

		if (isset($cart[$cartKey])) {
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
				'maSPTT' => $attribute->maSPTT, // thêm maSPTT vào đây
			];
		}

		session()->put('cart', $cart);

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

	/**
	 * Thanh toán giỏ hàng
	 */
	public function checkout(Request $request)
	{
		$cart = session()->get('cart', []);

		if (empty($cart)) {
			return redirect()->route('cart')->with('error', 'Giỏ hàng trống.');
		}

		// Chuyển sang view thanh toán
		return view('index.main.checkout', compact('cart'));
	}

	public function processCheckout(Request $request)
	{
		$cart = session()->get('cart', []);

		if (empty($cart)) {
			return redirect()->route('cart')->with('error', 'Giỏ hàng trống.');
		}

		// Validate thông tin khách hàng
		$request->validate([
			'hoTen' => 'required|string|max:255',
			'diaChi' => 'required|string|max:500',
			'soDienThoai' => 'required|string|max:20',
			'email' => 'nullable|email|max:255',
			'maKhuyenMai' => 'nullable|string|max:50',
			'phuongThuc' => 'required|string', // bắt buộc có phương thức thanh toán
		]);

		DB::beginTransaction();

		try {
			$user = Auth::user();
			$khachHangId = $user->khachHang->maKhachHang ?? $user->maNguoiDung;

			if (!$khachHangId) {
				return back()->with('error', 'Không xác định được khách hàng.');
			}

			// Tính tổng tiền
			$total = 0;
			foreach ($cart as $item) {
				$total += $item['giaGoc'] * $item['soLuong'];
			}

			$maKhuyenMai = $request->maKhuyenMai ?? null;
			$maDonHang = Str::upper(Str::random(10));

			// Tạo đơn hàng
			$donHang = DonHang::create([
				'maDonHang' => $maDonHang,
				'maKhachHang' => $khachHangId,
				'hoTen' => $request->hoTen,
				'diaChi' => $request->diaChi,
				'soDienThoai' => $request->soDienThoai,
				'email' => $request->email,
				'tongTien' => $total,
				'maKhuyenMai' => $maKhuyenMai,
				'ghiChu' => $request->ghiChu,
				'trangThai' => 'Chờ xử lý',
			]);

			// Tạo chi tiết đơn hàng & trừ tồn kho
			foreach ($cart as $item) {
				// Kiểm tra tồn kho trước
				$updated = DB::table('SanPhamThuocTinh')
					->where('maSPTT', $item['maSPTT'])
					->where('soLuong', '>=', $item['soLuong'])
					->decrement('soLuong', $item['soLuong']);

				if (!$updated) {
					throw new \Exception("Sản phẩm {$item['tenSanPham']} không đủ tồn kho.");
				}

				// Tạo chi tiết đơn hàng
				ChiTietDonHang::create([
					'maDonHang' => $donHang->maDonHang,
					'maSPTT' => $item['maSPTT'],
					'soLuong' => $item['soLuong'],
					'donGia' => $item['giaGoc'],
					'giamGia' => 0,
				]);
			}

			// Tạo thanh toán
			ThanhToan::create([
				'maDonHang' => $donHang->maDonHang,
				'phuongThuc' => $request->phuongThuc,
				'soTien' => $total,
				'trangThai' => 'Chưa thanh toán',
			]);

			DB::commit();

			// Xóa giỏ hàng
			session()->forget('cart');

			return redirect()->to('/')->with('success', 'Đặt hàng thành công! Mã đơn: ' . $donHang->maDonHang);

		} catch (\Exception $e) {
			DB::rollBack();
			return back()->with('error', 'Đã có lỗi xảy ra: ' . $e->getMessage());
		}
	}



}
