<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Update status enum: pending → diterima/ditolak → diproses → selesai
     */
    public function up(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            // For MySQL: modify the enum column
            DB::statement("ALTER TABLE service_bookings MODIFY COLUMN status ENUM('pending','diterima','ditolak','diproses','selesai','dibatalkan') NOT NULL DEFAULT 'pending'");
        }

        // Migrate old 'ditugaskan' values to 'diterima'
        DB::statement("UPDATE service_bookings SET status = 'diterima' WHERE status = 'ditugaskan'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback: map back old values
        DB::statement("UPDATE service_bookings SET status = 'ditugaskan' WHERE status = 'diterima'");
        DB::statement("UPDATE service_bookings SET status = 'dibatalkan' WHERE status = 'ditolak'");
        
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE service_bookings MODIFY COLUMN status ENUM('pending','ditugaskan','diproses','selesai','dibatalkan') NOT NULL DEFAULT 'pending'");
        }
    }
};
