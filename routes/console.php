<?php

use App\Console\Commands\DepositTransactionsCheckerCommand;
use App\Console\Commands\TransactionsValidatorCommand;
use App\Console\Commands\WithdrawTransactionsCheckerCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(TransactionsValidatorCommand::class)->everyTwoSeconds();
Schedule::command(DepositTransactionsCheckerCommand::class)->everyFifteenSeconds();
Schedule::command(WithdrawTransactionsCheckerCommand::class)->everyFifteenSeconds();

