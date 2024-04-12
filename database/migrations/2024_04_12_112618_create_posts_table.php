<?php

use Illuminate\Database\Migrations\Migration;
//use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint;

return new class extends Migration
{
    protected $connection = 'mongodb';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $collection) {
            //$collection->index('title');
            //$collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
