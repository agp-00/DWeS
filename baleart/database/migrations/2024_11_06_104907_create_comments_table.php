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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
            $table->integer('score');
            $table->enum('status', ['y', 'n'])->default('n');
            $table->foreignId('user_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('space_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
        });

        DB::statement('
            CREATE TRIGGER update_scores_after_insert
            AFTER INSERT ON comments
            FOR EACH ROW
            BEGIN
            IF NEW.status = "y" THEN
                UPDATE spaces
                SET totalScore = totalScore + NEW.score,
                    countScore = countScore + 1
                WHERE id = NEW.space_id;
            END IF;
            IF NEW.status = "n" THEN
                UPDATE spaces
                SET totalScore = totalScore
                WHERE id = NEW.space_id;
            END IF;
            END;
        ');

        DB::statement('
            CREATE TRIGGER update_scores_after_update
            AFTER UPDATE ON comments
            FOR EACH ROW
            BEGIN
            IF NEW.status = "y" THEN
                UPDATE spaces
                SET totalScore = totalScore + NEW.score,
                    countScore = countScore + 1
                WHERE id = NEW.space_id;
            END IF;
            IF NEW.status = "n" THEN
                UPDATE spaces
                SET totalScore = totalScore - OLD.score,
                    countScore = countScore - 1
                WHERE id = NEW.space_id;
            END IF;
            END;
        ');

        DB::statement('
            CREATE TRIGGER update_scores_after_delete
            AFTER DELETE ON comments
            FOR EACH ROW
            BEGIN
            IF OLD.status = "y" THEN
                UPDATE spaces
                SET totalScore = totalScore - OLD.score,
                    countScore = countScore - 1
                WHERE id = OLD.space_id;
            END IF;
            IF OLD.status = "n" THEN
                UPDATE spaces
                SET totalScore = totalScore
                WHERE id = OLD.space_id;
            END IF;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS update_scores_after_insert');
        DB::statement('DROP TRIGGER IF EXISTS update_scores_after_update');
        DB::statement('DROP TRIGGER IF EXISTS update_scores_after_delete');
        Schema::dropIfExists('comments');
    }
};
