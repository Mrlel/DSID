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
            // Ajouter la colonne 'fonction_id'
            $table->unsignedBigInteger('fonction_id')->nullable();

            // Ajouter la contrainte de clé étrangère
            $table->foreign('fonction_id')
                ->references('id')  // colonne 'id' dans la table "fonctions"
                ->on('fonctions')   // table de référence "fonctions"
                ->onDelete('set null');  // si la fonction est supprimée, mettre 'fonction_id' à null
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
            // Supprimer la contrainte de clé étrangère
            $table->dropForeign(['fonction_id']);

            // Supprimer la colonne 'fonction_id'
            $table->dropColumn('fonction_id');
        });
    }
};
