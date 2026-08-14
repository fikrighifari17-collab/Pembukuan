<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['category', 'user']);

        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', $request->end_date);
        }

        $transactions = $query->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('transactions.index', compact('transactions', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0.01',
            'date' => 'required|date',
            'description' => 'nullable|string|max:500',
        ]);

        $data['user_id'] = Auth::id();

        $transaction = Transaction::create($data);

        AuditLog::log(
            'Create Transaction',
            'Created ' . $transaction->type . ' of Rp ' . number_format($transaction->amount, 0, ',', '.') . ' under category ' . $transaction->category->name
        );

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
        ]);

        $category = Category::create($data);

        AuditLog::log(
            'Create Category',
            'Created category: ' . $category->name . ' (' . $category->type . ')'
        );

        return redirect()->route('transactions.index')->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    public function destroy(Transaction $transaction)
    {
        $details = 'Deleted ' . $transaction->type . ' of Rp ' . number_format($transaction->amount, 0, ',', '.') . ' (' . $transaction->description . ')';
        
        $transaction->delete();

        AuditLog::log('Delete Transaction', $details);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
