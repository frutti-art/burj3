<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotEligibleToWithdrawException;
use App\Http\Requests\WithdrawActionRequest;
use App\Models\Transaction;
use App\Services\TransactionService;
use App\Services\UserService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
        private readonly TransactionService $transactionService,
    )
    {

    }

    public function index()
    {
        $user = auth()->user();

        $transactions = $user->transactions()
            ->whereIn('status', [Transaction::STATUS_ACCEPTED, Transaction::STATUS_COMPLETED])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tailwindui.transactions-list', compact('transactions', 'user'));
    }

    public function deposit(Request $request)
    {
        $user = auth()->user();

        if (!$this->userService->userIsEligibleToDeposit($user)) {
            return redirect()->route('user.home')->with('error', 'Not eligible to deposit');
        }

        $user->update([
            'last_possible_deposit' => now(),
        ]);

        return view('tailwindui.transaction', compact( 'user'));
    }

    public function withdraw()
    {
        $user = auth()->user();

        try {
            $this->userService->checkUserEligibilityToWithdraw($user);
        } catch (UserNotEligibleToWithdrawException $e) {
            return redirect()->route('user.general')->with('error', $e->getMessage());
        }

        return view('tailwindui.withdraw', compact('user'));
    }

    public function withdrawAction(WithdrawActionRequest $request)
    {
        $user = auth()->user();

        $user->update([
            'withdraw_wallet_address' => $request->wallet_address,
        ]);

        try {
            $this->userService->checkUserEligibilityToWithdraw($user, $request->amount);
        } catch (UserNotEligibleToWithdrawException $e) {
            return redirect()->route('user.general')->with('error', $e->getMessage());
        }

        $this->transactionService->createTransactionForWithdraw($user, $request->amount, $request->wallet_address);

        return redirect()->route('user.general')->with('success', 'Withdraw request sent successfully');
    }
}
