<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Drop the existing 'name' column if it exists
            $table->dropColumn('name');

            // Add the 'person_id' column as a foreign key constrained to the 'people' table
            $table->foreignId('person_id')->constrained('person');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Reverse the migration by dropping the 'person_id' column
            $table->dropForeign(['person_id']);
            $table->dropColumn('person_id');

            // Recreate the 'name' column
            $table->string('name');
        });
    }
};
