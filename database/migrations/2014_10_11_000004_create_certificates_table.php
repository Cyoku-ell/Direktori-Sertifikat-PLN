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
        Schema::create('certificates', function (Blueprint $table) {

            $table->id();

            /*
    |--------------------------------------------------------------------------
    | Owner
    |--------------------------------------------------------------------------
    */

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('perner')->index();

            /*
    |--------------------------------------------------------------------------
    | Certificate Information
    |--------------------------------------------------------------------------
    */

            $table->string('title');

            $table->string('certificate_number')->unique();

            $table->string('registration_number')->nullable();

            $table->string('institution');

            $table->string('accreditor');

            /*
    |--------------------------------------------------------------------------
    | Dates
    |--------------------------------------------------------------------------
    */

            // dari excel
            $table->date('issue_date');

            // optional
            $table->date('start_date')->nullable();

            $table->date('end_date')->nullable();

            // masa berlaku sertifikat
            $table->date('expired_at')->nullable();

            /*
    |--------------------------------------------------------------------------
    | File
    |--------------------------------------------------------------------------
    */

            $table->string('pdf')->nullable();

            /*
    |--------------------------------------------------------------------------
    | Status
    |--------------------------------------------------------------------------
    */

            // apakah owner sudah ditemukan
            $table->boolean('is_matched')
                ->default(false);

            /*
    |--------------------------------------------------------------------------
    | Notes
    |--------------------------------------------------------------------------
    */

            $table->text('remarks')->nullable();

            /*
    |--------------------------------------------------------------------------
    | Audit
    |--------------------------------------------------------------------------
    */

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
