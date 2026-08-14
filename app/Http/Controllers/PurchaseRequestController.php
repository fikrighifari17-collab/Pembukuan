<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseRequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isKaryawan()) {
            $requests = PurchaseRequest::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $requests = PurchaseRequest::with(['user', 'approver'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('purchase_requests.index', compact('requests'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->isOwner()) {
            abort(403, 'Owner tidak dapat membuat request pembelian.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:500',
        ]);

        $purchaseRequest = PurchaseRequest::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description,
            'status' => 'pending',
            'user_id' => Auth::id(),
        ]);

        AuditLog::log(
            'Purchase Request Created',
            'Created request: ' . $purchaseRequest->title . ' for Rp ' . number_format($purchaseRequest->amount, 0, ',', '.')
        );

        return redirect()->route('purchase_requests.index')->with('success', 'Request pembelian berhasil diajukan.');
    }

    public function approve(PurchaseRequest $purchaseRequest)
    {
        // Only owner or finance can approve
        $user = Auth::user();
        if (!$user->isOwner() && !$user->isFinance()) {
            abort(403, 'Akses ditolak.');
        }

        // Find or create 'Pembelian Aset' category
        $category = Category::where('type', 'expense')->first();
        if (!$category) {
            $category = Category::create([
                'name' => 'Belanja Request Barang',
                'type' => 'expense'
            ]);
        }

        // Create transaction
        $transaction = Transaction::create([
            'category_id' => $category->id,
            'type' => 'expense',
            'amount' => $purchaseRequest->amount,
            'description' => 'Persetujuan Pembelian: ' . $purchaseRequest->title . ' (Diajukan oleh ' . $purchaseRequest->user->name . ')',
            'date' => now()->format('Y-m-d'),
            'user_id' => $user->id,
        ]);

        $purchaseRequest->update([
            'status' => 'approved',
            'approved_by' => $user->id,
            'transaction_id' => $transaction->id,
        ]);

        AuditLog::log(
            'Purchase Request Approved',
            'Approved request "' . $purchaseRequest->title . '" by ' . $user->name . '. Generated transaction ID: ' . $transaction->id
        );

        return redirect()->route('purchase_requests.index')->with('success', 'Request disetujui. Dana keluar otomatis dicatat di Pengeluaran.');
    }

    public function reject(PurchaseRequest $purchaseRequest)
    {
        $user = Auth::user();
        if (!$user->isOwner() && !$user->isFinance()) {
            abort(403, 'Akses ditolak.');
        }

        $purchaseRequest->update([
            'status' => 'rejected',
            'approved_by' => $user->id,
        ]);

        AuditLog::log(
            'Purchase Request Rejected',
            'Rejected request "' . $purchaseRequest->title . '" by ' . $user->name
        );

        return redirect()->route('purchase_requests.index')->with('success', 'Request pembelian ditolak.');
    }
}
