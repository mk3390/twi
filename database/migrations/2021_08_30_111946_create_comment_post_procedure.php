<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCommentPostProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = '
        CREATE PROCEDURE `getCommentByPost`(IN `post` VARCHAR(255), IN `limits` INT)
        BEGIN  
 
        set @sql = concat(" SELECT comments.id,c2.id,comments.comment,users.name,comments.post_id,comments.created_at FROM `comments` left join comments c2 on c2.post_id=comments.post_id and c2.id>=comments.id join users on users.id=comments.user_id WHERE c2.post_id in (" , post , ") group by comments.comment HAVING COUNT(*) <= ");
        set @sql = concat(@sql, limits);
    set @sql = concat(@sql, " order by c2.post_id,c2.created_at desc");
        PREPARE stmt FROM @sql;
        EXECUTE stmt;
        
    END
        ';
        
        DB::unprepared("DROP procedure IF EXISTS getCommentByPost");
        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP procedure IF EXISTS getCommentByPost");
    }
}
