<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    //章节表明
    protected $table = "chapter";

    //小说章节添加
    public function addRecord($data)
    {
    	return self::insert($data);
    }

    //获取小说章节列表
    public function getLists($novelId = 0)
    {

    	if($novelId == 0){
    		return self::select('chapter.id','novel.name','chapter.title','chapter.sort')
    				->leftJoin('novel','chapter.novel_id','=','novel.id')
    				->paginate(5);
    	}else{

    		return self::select('chapter.id','novel.name','chapter.title','chapter.sort')
    				->leftJoin('novel','chapter.novel_id','=','novel.id')
    				->where('novel_id',$novelId)
    				->paginate(5);	
    	}
    	
    }

    //删除章节
    public function delRecord($id)
    {
    	return self::where('id',$id)->delete();
    }

    //获取章节信息
    public function getChapter($id)
    {
    	return self::where('id',$id)->first();
    }

    //修改章节的记录
    public function editRecord($data, $id)
    {
    	return self::where('id',$id)->update($data);
    }

    //获取Api接口的小说列表
    public function getApiChapterList($novelId)
    {
        $list = self::select('id','novel_id','title')
                  ->where('novel_id',$novelId)
                  ->orderBy('sort')
                  ->get()
                  ->toArray();

        return $list;
    }

    //获取小说的第一章节
    public function getFirstChapter($novelId)
    {

        $first = self::where('novel_id',$novelId)
                    ->first();


        return $first;
    }

    //获取小说上一章节内容  $novelId 小说id  $sort 章节号
    public function getPrevChapter($novelId, $sort)
    {
        $prev = self::where('novel_id',$novelId)
                    ->where('sort', $sort-1)
                    ->first();


        return $prev;
    }

    //获取小说下一章节内容  $novelId 小说id  $sort 章节号
    public function getNextChapter($novelId, $sort)
    {
        $prev = self::where('novel_id',$novelId)
                    ->where('sort', $sort+1)
                    ->first();


        return $prev;
    }

    
}
