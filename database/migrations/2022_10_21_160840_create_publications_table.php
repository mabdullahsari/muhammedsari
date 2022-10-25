<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('publications', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->unique();
            $table->timestamp('publish_at')->nullable();
        });
    }
};
