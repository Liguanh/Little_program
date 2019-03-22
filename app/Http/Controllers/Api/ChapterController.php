<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Chapter;

class ChapterController extends Controller
{
    //

	//获取小说章节列表成功
    public function chapterList($novelId)
    {
    	$chapter = new Chapter();

    	$list = $chapter->getApiChapterList($novelId);

    	$return = [
    		'code' => 2000,
    		'msg'  => "获取小说章节列表成功",
    		'data' => $list
    	];

    	return json_encode($return);
    }

    //获取章节详情
    public function chapterInfo($id)
    {
    	$chapter = new Chapter();

    	$info = $chapter->getChapter($id);//获取当前章节详情

    	$prev = $chapter->getPrevChapter($info->novel_id, $info->sort);
    	$next = $chapter->getNextChapter($info->novel_id, $info->sort);

    	if(empty($prev)){
    		$prevChapter = 0;
    	}else{
    		$prevChapter = $prev->id;
    	}

    	if(empty($next)){
    		$nextChapter = 0;
    	}else{
    		$nextChapter = $next->id;
    	}


    	$data = [
    		'prev_id'=> $prevChapter,
    		'next_id' => $nextChapter,
    		'info' => $info
    	];

    	$return = [
    		'code' => 2000,
    		'msg'  => "获取小说章节内容成功",
    		'data' => $data
    	];

    	return json_encode($return);
    }

}
