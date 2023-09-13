<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('author_id')
                ->nullable()
                ->constrained('moonshine_users')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->string('slug')
                ->nullable();
            $table->integer('status')
                ->unsigned()
                ->default(0);
            $table->integer('rating')
                ->unsigned()
                ->default(0);
            $table->text('thumbnail')
                ->nullable();
            $table->timestamp('published_at')
                ->nullable();
            $table->string('title');
            $table->string('seo_title')
                ->nullable();
            $table->text('seo_description')
                ->nullable();
            $table->longText('body');

            $table->softDeletes('deleted_at', $precision = 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(app()->isLocal()) {
            Schema::dropIfExists('articles');
        }
    }
};
