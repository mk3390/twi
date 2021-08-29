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
             SELECT posts.id,posts.post,posts.is_repost,posts.type,users.id as user,users.name,users.email, count(distinct comments.id) as comment_count,sum(case when reacts.type = 1 then 1 else 0 end) as likes,sum(case when reacts.type = 2 then 1 else 0 end) as bookmarks,( CASE WHEN reacts.type = 1 and reacts.user_id=user_id THEN 1 ELSE 0  END) AS user_liked,( CASE WHEN reacts.type = 2 and reacts.user_id=user_id THEN 1 ELSE 0  END) AS user_bookmark  FROM `timelines` join posts on posts.timeline_id=timelines.id join users on users.id=posts.user_id  left join comments on comments.post_id=posts.id left join reacts on reacts.post_id=posts.id WHERE timelines.`user_id` in (SELECT following_to  FROM `follows` WHERE `followed_by` = user_id) or timelines.user_id = user_id group by posts.id  LIMIT lim OFFSET off ;
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
