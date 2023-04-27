<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('blogging_posts', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('body')->default('');
            $table->string('summary')->default('');
            $table->string('state', 9)->default('draft'); // draft, published
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('blogging_tags', static function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
        });

        Schema::create('blogging_post_tag', static function (Blueprint $table) {
            $table->primary(['post_id', 'tag_id']);
            $table->foreignId('post_id')->constrained('blogging_posts')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tag_id')->constrained('blogging_tags')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }
};
