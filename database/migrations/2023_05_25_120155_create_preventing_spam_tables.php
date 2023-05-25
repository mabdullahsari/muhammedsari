<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('preventing_spam_quarantined_messages', static function (Blueprint $table) {
            $table->id();
            $table->string('detection_method');
            $table->string('message_type', 32);
            $table->json('message_value');
            $table->timestamp('quarantined_at')->nullable();
        });
    }
};
