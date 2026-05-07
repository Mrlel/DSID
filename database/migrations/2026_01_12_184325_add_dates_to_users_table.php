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
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ajouter la colonne 'date_prise_service_un' de type 'date'
            $table->date('date_prise_service_un')->nullable();

            // Ajouter la colonne 'date_prise_service' de type 'date'
            $table->date('date_prise_service')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprimer les colonnes 'date_prise_service_un' et 'date_prise_service'
            $table->dropColumn('date_prise_service_un');
            $table->dropColumn('date_prise_service');
        });
    }
};
