<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\DPS;
use App\Models\Loan;
use App\Models\Savings;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index(){

        $year = now()->year; // or manually set year

$monthly = DB::table('transactions')
    ->selectRaw("DATE_FORMAT(date, '%m') as month_num, DATE_FORMAT(date, '%b') as month_name,
                 SUM(CASE WHEN type = 'in'  THEN amount ELSE 0 END) as in_total,
                 SUM(CASE WHEN type = 'out' THEN amount ELSE 0 END) as out_total")
    ->whereYear('date', $year)
    ->groupBy('month_num', 'month_name')
    ->orderBy('month_num')
    ->get();

        $users = User::all();

        $loanBalance = Loan::where('status', 2)->sum('amount');
        $ownerBalance = User::where('status', 2)->where('role', 4)->sum('balance') ?? 0;
        $dpsBalance = DPS::where('status', 2)->sum('amount') ?? 0;
        $depositBalance = Deposit::where('status', 2)->sum('amount') ?? 0;
        $savingsBalance = Savings::sum('amount') ?? 0;
      $owners = User::where('role', 4)
              ->latest() // uses created_at by default
              ->paginate(10);

        $total = $loanBalance + $dpsBalance + $depositBalance + $savingsBalance;


    if ($total > 0) {
        $loanpercentage = round(($loanBalance / $total) * 100, 2);
        $dpsPercentage = round(($dpsBalance / $total) * 100, 2);
        $depositPercentage = round(($depositBalance / $total) * 100, 2);
        $savingsPercentage = round(($savingsBalance / $total) * 100, 2);
    } else {
        $loanpercentage = $dpsPercentage = $depositPercentage = $savingsPercentage = 0;
    }

    return view('backend.admin_layout', compact('owners','monthly', 'savingsPercentage', 'depositPercentage', 'dpsPercentage', 'loanpercentage', 'dpsPercentage', 'depositPercentage', 'savingsPercentage', 'users', 'loanBalance', 'ownerBalance', 'dpsBalance', 'depositBalance','savingsBalance'));
    }

   }

