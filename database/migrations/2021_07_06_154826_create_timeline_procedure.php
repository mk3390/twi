<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimelineProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "
        CREATE PROCEDURE `getTimelinepost`(IN `user_id` BIGINT,IN lim INT,IN off INT)
        BEGIN
             SELECT posts.id,posts.post,posts.is_repost,posts.type,users.id as user,users.name,users.email  FROM `timelines` join posts on posts.timeline_id=timelines.id join users on users.id=posts.user_id WHERE timelines.`user_id` in (SELECT following_to  FROM `follows` WHERE `followed_by` = user_id) or timelines.user_id = user_id  LIMIT lim OFFSET off ;
        END
        ";
        
        DB::unprepared("DROP procedure IF EXISTS getTimelinepost");
        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP procedure IF EXISTS getTimelinepost");
    }
}
