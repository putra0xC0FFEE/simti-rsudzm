<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            if (!Schema::hasColumn('rooms', 'room_id')) {
                $table->string('room_id')->nullable()->unique()->after('id');
            }
            if (!Schema::hasColumn('rooms', 'kategori')) {
                $table->string('kategori')->nullable()->after('room_id');
            }
        });

        if (Schema::hasColumn('rooms', 'kode')) {
            DB::statement('UPDATE rooms SET room_id = kode WHERE room_id IS NULL');
            Schema::table('rooms', function (Blueprint $table) {
                $table->dropColumn('kode');
            });
        }
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('kode')->nullable()->after('name');
        });
        DB::statement('UPDATE rooms SET kode = room_id WHERE kode IS NULL');
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['room_id', 'kategori']);
        });
    }
};
