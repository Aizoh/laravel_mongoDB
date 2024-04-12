<?php
declare(strict_types=1);
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
        Schema::create('users', function (Blueprint $collection) {
            // $collection->id();
            // $collection->string('name');
            // $collection->string('email')->unique();
            // $collection->timestamp('email_verified_at')->nullable();
            // $collection->string('password');
            // $collection->rememberToken();
            //$collection->index('email')->unique();
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
