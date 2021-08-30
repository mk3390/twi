<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class GetPostProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "
        CREATE PROCEDURE `getSinglePost`(IN `post_id` BIGINT, IN `user_id` BIGINT)
        BEGIN
        SELECT posts.id,posts.post,posts.is_repost,posts.type,users.id as user,users.name,users.email, count(distinct comments.id) as comment_count,sum(case when reacts.type = 1 then 1 else 0 end) as likes,sum(case when reacts.type = 2 then 1 else 0 end) as bookmarks,count(DISTINCT likes.id) as user_liked,
        count(DISTINCT bookmark.id) as user_bookmark  FROM `posts`  join users on users.id=posts.user_id  left join comments on comments.post_id=posts.id left join reacts on reacts.post_id=posts.id left join reacts likes on likes.post_id=posts.id and likes.user_id=user_id and likes.type=1 
        left join reacts bookmark on bookmark.post_id=posts.id and bookmark.user_id=user_id and bookmark.type=2  WHERE posts.id=post_id;
        END
        ";
        
        DB::unprepared("DROP procedure IF EXISTS getSinglePost");
        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP procedure IF EXISTS getSinglePost");
    }
}
