<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
           $table->string('photo', 100)->nullable();
           $table->string('cover', 100)->nullable();
           $table->boolean('is_locked')->nullable()->default(false);
           $table->boolean('deactivated')->nullable()->default(false);
           $table->boolean('is_suspended')->nullable()->default(false);
           $table->string('suspend_reason')->nullable();
           $table->date('suspended_at')->nullable();
           $table->text('bio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->dropColumn('cover');
            $table->dropColumn('is_locked');
            $table->dropColumn('deactivated');
            $table->dropColumn('is_suspended');
            $table->dropColumn('suspend_reason');
            $table->dropColumn('suspended_at');
            $table->dropColumn('bio');
        });
    }
}
