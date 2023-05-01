<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('contacting_contact_forms', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('name');
            $table->tinyText('message');
            $table->ipAddress();
            $table->timestamp('created_at')->nullable();
        });
    }
};
