<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use Role;
// use Illuminate\Support\Facades\Role;

use App\Models\Role;
// use App\Models\User; 


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $roles = array_column(Role::cases(), 'value');
            $table->enum('role', $roles)->after('email')->default(Role::Default->value);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role');
    });
 };
}
