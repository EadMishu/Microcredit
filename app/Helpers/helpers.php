<?php
use App\Models\DepositCollection;
use App\Models\DpsCollection;
use App\Models\LoanCollection;
use App\Models\Loan;

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