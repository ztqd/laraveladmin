<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     * 类型
    分公司
    打分项
    备注
    星级
    检查人员
    受检人员

    检查时间
    整改状态 1 需要整改 2 整改完成
    整改说明
    整改完成时间
    整改
     */
    public function up()
    {
        Schema::create('checks', function (Blueprint $table) {
            $table->increments('id')->comment('checkid');
            $table->integer('type');
            $table->string('area')->nullable();;
			$table->string('name');
            $table->string('checkcontent')->nullable();
            $table->string('memo')->nullable();;
            $table->string('starlevel');
            $table->string('checkusername')->nullable();
            $table->integer('checkuserid')->nullable();
            $table->string('inspectionname')->nullable();
 
            $table->string('checktime');
            $table->integer('status')->nullable();
            $table->string('feedback')->nullable();
            $table->string('feedbacktime')->nullable();
            $table->string('feedbackuser')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checks');
    }
}
