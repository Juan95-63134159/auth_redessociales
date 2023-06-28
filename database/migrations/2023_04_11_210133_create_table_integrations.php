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
        Schema::create('clients', function(Blueprint $table){
            $table->id();
            $table->string('nombre_cliente',15);
            $table->string('email');
            $table->string('direction');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        Schema::create('integrations', function (Blueprint $table) {
            $table->id();
            $table->string('name_app',15)->unique(); 
            $table->string('url_app');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('integrations_client', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('integration_id');
            $table->jsonb('parameters_values');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('integration_id')->references('id')->on('integrations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integrations_client');
        Schema::dropIfExists('integrations');
        Schema::dropIfExists('clients');
    }
};
