<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // ID unik untuk transaksi
            $table->string('title'); // Judul transaksi
            $table->decimal('amount', 15, 2); // Jumlah uang
            $table->unsignedBigInteger('category_id'); // ID kategori (foreign key)
            $table->enum('type', ['income', 'expense']); // Jenis transaksi
            $table->date('date'); // Tanggal transaksi
            $table->timestamps(); // Kolom created_at dan updated_at

            // Relasi ke tabel categories
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
