<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\PurchaseRequest;
use App\Models\Employee;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $selectedDate = $request->query('date', now()->format('Y-m-d'));

        // Standard metrics
        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        $pendingRequestsCount = PurchaseRequest::where('status', 'pending')->count();
        $employeeCount = Employee::count();

        // Company Funds starting at 10 Billion, adjusted by balance
        $companyFunds = 10000000000 + $balance;

        // Recent Transactions
        $recentTransactions = Transaction::with(['category', 'user'])
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Audit Logs (only visible to owner/finance)
        $auditLogs = collect();
        if ($user->isOwner() || $user->isFinance()) {
            $auditLogs = AuditLog::with('user')
                ->orderBy('created_at', 'desc')
                ->limit(6)
                ->get();
        }

        // Employee specific info
        $myEmployeeInfo = null;
        $myPayslips = collect();
        $myPurchaseRequests = collect();
        if ($user->isKaryawan()) {
            $myEmployeeInfo = Employee::where('user_id', $user->id)->first();
            $myPurchaseRequests = PurchaseRequest::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
            if ($myEmployeeInfo) {
                $myPayslips = $myEmployeeInfo->payslips()->orderBy('month', 'desc')->get();
            }
        }

        return view('dashboard', compact(
            'totalIncome',
            'totalExpense',
            'balance',
            'companyFunds',
            'pendingRequestsCount',
            'employeeCount',
            'recentTransactions',
            'auditLogs',
            'myEmployeeInfo',
            'myPayslips',
            'myPurchaseRequests',
            'selectedDate'
        ));
    }

    public function exportReport(Request $request)
    {
        $type = $request->query('type', 'all');

        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;
        $companyFunds = 10000000000 + $balance;

        $txQuery = Transaction::with(['category', 'user'])->orderBy('date', 'desc');

        if ($type === 'income') {
            $txQuery->where('type', 'income');
        } elseif ($type === 'expense') {
            $txQuery->where('type', 'expense');
        }

        $transactions = $txQuery->get();

        return view('dashboard_report', compact(
            'totalIncome',
            'totalExpense',
            'balance',
            'companyFunds',
            'transactions',
            'type'
        ));
    }
}
