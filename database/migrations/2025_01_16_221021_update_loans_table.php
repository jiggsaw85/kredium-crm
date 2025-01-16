<?php

use App\Enums\LoanType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->string('loanable_type')
                ->change()
                ->checkIn([LoanType::CASH_LOAN->value, LoanType::HOME_LOAN->value]);
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->string('loanable_type')->change();
        });
    }
};
