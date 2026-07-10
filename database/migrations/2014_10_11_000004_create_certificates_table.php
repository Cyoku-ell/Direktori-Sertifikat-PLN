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
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('perner')->index();

            $table->string('title');

            $table->string('certificate_number')->unique();

            $table->string('registration_number')->nullable();

            $table->string('institution');

            $table->string('accreditor');

            $table->date('issue_date');

            $table->date('start_date')->nullable();

            $table->date('end_date')->nullable();

            $table->string('pdf')->nullable();


            // hasil matching owner
            $table->boolean('is_matched')
                ->default(false);

    
            $table->text('remarks')->nullable();

            // admin yang upload
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
