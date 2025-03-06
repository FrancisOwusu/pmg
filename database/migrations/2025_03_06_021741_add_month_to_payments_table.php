<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained()->onDelete('cascade');

            $table->enum('contribution_type', ['dues', 'funeral_donation', 'other'])->after('amount');
            $table->foreignId('received_by')->nullable()->constrained('users')->onDelete('set null');
            $table->integer('year')->after('amount');
            $table->integer('month')->after('year'); // January = 1, December = 12
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
           $table->dropColumn(['year', 'month','contribution_type', 'received_by','student_id']);
            
        });
    }
};
