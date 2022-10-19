<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('posts', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('body');
            $table->string('summary');
            $table->string('state', 9)->default('draft'); // draft, published
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }
};
