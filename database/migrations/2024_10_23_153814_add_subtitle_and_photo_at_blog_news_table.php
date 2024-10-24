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
        Schema::table('blog_news', function (Blueprint $table) {
            $table->string('subtitle')
                ->default('O primeiro Simpósio de Fonoaudiologia foi incrível graças a cada um de vocês que esteve presente. Agradecemos por compartilharem conhecimento e entusiasmo. Juntos, construímos uma jornada inesquecível!')
            ->after('title');
            $table->string('photo')->default('default.png')->after('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_news', function (Blueprint $table) {
            $table->dropColumn('active_access');
        });
    }
};
