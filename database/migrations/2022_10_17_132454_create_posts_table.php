<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('posts', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('summary')->nullable();
            $table->text('content')->nullable();
            $table->string('state', 9)->default('draft'); // draft, published
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }
};
