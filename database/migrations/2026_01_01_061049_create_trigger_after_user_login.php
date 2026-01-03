<?php

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
        DB::unprepared("
            CREATE TRIGGER after_user_login
            AFTER UPDATE ON users
            FOR EACH ROW
            BEGIN
                IF NEW.last_login IS NOT NULL
                   AND OLD.last_login IS NULL THEN
                    INSERT INTO log_login
                        (user_id, login_time, ip_address, created_at, updated_at)
                    VALUES
                        (NEW.id, NEW.last_login, 'AUTO_TRIGGER', NOW(), NOW());
                END IF;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('DROP TRIGGER IF EXISTS trigger_after_user_login');
    }
};
