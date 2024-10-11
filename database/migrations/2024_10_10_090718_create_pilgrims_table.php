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
        Schema::create('pilgrims', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nik');
            $table->string('birthday_place');
            $table->date('birthday_date');
            $table->text('address');
            $table->enum('gender',['male','female']);
            $table->enum('package',['itikaf','reguler', 'vip']);
            $table->enum('room',['quint','quad', 'triple','double','single']);
            $table->string('no_passport');
            $table->date('period_passport');
            $table->string('ktp_photo');
            $table->string('kk_photo');
            $table->string('selfie_photo');
            $table->string('passport_photo');
            $table->string('no_visa')->nullable();
            $table->date('period_visa')->nullable();
            $table->unsignedBigInteger('prov_id');
            $table->foreign('prov_id')->references('id')->on('provincies')->onDelete('cascade'); // added onDelete for better integrity
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade'); // added onDelete for better integrity
            $table->unsignedBigInteger('dis_id');
            $table->foreign('dis_id')->references('id')->on('districts')->onDelete('cascade'); // added onDelete for better integrity
            $table->unsignedBigInteger('subdis_id');
            $table->foreign('subdis_id')->references('id')->on('subdistricts')->onDelete('cascade'); // added onDelete for better integrity
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilgrims');
    }
};
