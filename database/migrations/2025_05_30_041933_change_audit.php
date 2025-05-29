<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            // Add new column
            $table->string('text')->after('action');

            // Change 'action' to be NOT NULL (requires doctrine/dbal installed)
            $table->string('action')->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            // Reverse the changes
            $table->dropColumn('source');
            $table->string('action')->nullable()->change();
        });
    }
};