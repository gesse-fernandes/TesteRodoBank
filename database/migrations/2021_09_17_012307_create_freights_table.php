<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //aqui eu crio o nome da minha tabela no banco
        Schema::create('freights', function (Blueprint $table) {
            //meu id
            $table->id();
            //a placa do veiculo precisa ser unique ja que só existe uma unica placa de veiculo nunca é a mesma não pode haver duplicada
            $table->string('board')->unique();
            //coluna dono do veiculo
            $table->string('vehicle_owner');
            //o valor do frete
            $table->decimal('price_freight',10,2);
            //a data de inicio
            $table->date('date_start');
            //a data de fim
            $table->date('date_end');
            //status coloquei como enum pois vai ser 3 opções.
            $table->enum('status',['Iniciado','em trânsito','concluído']);
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //apaga a tabela
        Schema::dropIfExists('freights');
    }
}
