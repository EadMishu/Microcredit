<?php

use App\Models\Deposit;
use App\Models\DepositCollection;
use App\Models\DPS;
use App\Models\DpsCollection;
use App\Models\Interest;
use App\Models\LoanCollection;
use App\Models\Loan;
use App\Models\Transaction;

use App\Models\Withdraw;

/**
 * uploadImage
 *
 * @param  mixed  $date
 * @return Response
 */
if (!function_exists('uploadImage')) {
function uploadImage($image)
{
    $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                    . '-' . time() . '.' . $image->getClientOriginalExtension();
    $image->move(file_path(), $imageName);
    return $imageName;
}
}

// Return the full server path to the uploads/files directory
if (!function_exists('file_path')) {
    function file_path()
    {
        return public_path('uploads/files/');
    }
}

if (!function_exists('depositSum')) {
    function depositSum($date)
    {
        $sum = DepositCollection::whereDate('date',$date)->sum('amount');
        return $sum;
    }
}
if (!function_exists('loanSum')) {
    function loanSum($date)
    {
        $sum = LoanCollection::whereDate('date',$date)->sum('amount');
        return $sum;
    }
}
if (!function_exists('dpsSum')) {
    function dpsSum($date)
    {
        $sum = DpsCollection::whereDate('date',$date)->sum('amount');
        return $sum;
    }
}
if (!function_exists('loan_balance')) {
    function loan_balance($id)
    {
        $loan = Loan::findOrFail($id);
        $loan_amount = $loan->amount + ($loan->amount * ($loan->loanType?->percentage / 100));
        $loan_collect = $loan->loanCollections?->sum('amount');
        $balance = $loan_amount - $loan_collect;
        return $balance;
    }
}

if (!function_exists('dps_balance')) {
    function dps_balance($id)
    {
        $dps = DPS::findOrFail($id);
        $dps_amount = $dps->amount + ($dps->amount * ($dps->dpsType?->percentage / 100));
        $dps_collect = $dps->dpsCollections?->sum('amount');
        $balance = $dps_amount - $dps_collect;
        return $balance;
    }
}
if (!function_exists('deposit_balance')) {
    function deposit_balance($id)
    {
        $deposit = Deposit::findOrFail($id);
        $deposit_amount = $deposit->amount + ($deposit->amount * ($deposit->depositType?->percentage / 100));
        $deposit_collect = $deposit->depositCollections?->sum('amount');
        $balance = $deposit_amount - $deposit_collect;
        return $balance;
    }
}

if (!function_exists('transactions')) {
    function transactions($date, $details, $amount,$type = 'in')
    {
        $transaction = new Transaction;
        $transaction->date = $date;
        $transaction->details = $details;
        $transaction->amount = $amount;
        $transaction->type = $type;
        $transaction->save();
        return $transaction;
        
    }
}

if (!function_exists('withdraw')) {
    function withdraw($date, $user_id, $amount)
    {
        $withdraw = new Withdraw();
        $withdraw->date = $date;
        $withdraw->user_id = $user_id;
        $withdraw->amount = $amount;
        $withdraw->save();
        return $withdraw;
        
    }
}

if (!function_exists('interest')) {
    function interest($date, $UserID, $amount)
    {
        $interest = new Interest();
        $interest->date = $date;
        $interest->user_id = $UserID;
        $interest->amount = $amount;
        $interest->save();
        return $interest;
        
    }
}