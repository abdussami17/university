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
        Schema::create('home_contents', function (Blueprint $table) {
            $table->id();
            $table->string('mainbanner');
            
            // First Section
            $table->string('firstsection_title');
            $table->string('firstsection_box1_title');
            $table->string('firstsection_box1_image');
            $table->longText('firstsection_box1_description');
            $table->string('firstsection_box2_title');
            $table->string('firstsection_box2_image');
            $table->longText('firstsection_box2_description');
            $table->string('firstsection_box3_title');
            $table->string('firstsection_box3_image');
            $table->longText('firstsection_box3_description');
            
            // Second Section
            $table->string('secondsection_title');
            $table->string('secondsection_box1_title');
            $table->string('secondsection_box1_image');
            $table->longText('secondsection_box1_description');
            $table->string('secondsection_box2_title');
            $table->string('secondsection_box2_image');
            $table->longText('secondsection_box2_description');
            $table->string('secondsection_box3_title');
            $table->string('secondsection_box3_image');
            $table->longText('secondsection_box3_description');
            
            // Third Section
            $table->string('thirdsection_title');
            $table->string('thirdsection_box1_title');
            $table->string('thirdsection_box1_image');
            $table->longText('thirdsection_box1_description');
            $table->string('thirdsection_box2_title');
            $table->string('thirdsection_box2_image');
            $table->longText('thirdsection_box2_description');
            $table->string('thirdsection_box3_title');
            $table->string('thirdsection_box3_image');
            $table->longText('thirdsection_box3_description');
            
            // Last Section
            $table->string('lastsection_title');
            $table->string('lastsection_box1_title');
            $table->string('lastsection_box1_image');
            $table->longText('lastsection_box1_description');
            $table->string('lastsection_box2_title');
            $table->string('lastsection_box2_image');
            $table->longText('lastsection_box2_description');
            $table->string('lastsection_box3_title');
            $table->string('lastsection_box3_image');
            $table->longText('lastsection_box3_description');
            
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_contents');
    }
};
