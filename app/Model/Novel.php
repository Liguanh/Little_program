<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Novel extends Model
{
    //
    protected $table = "novel";

    //获取列表
    public function getLists()
    {
    	return self::select('novel.id','c_name','author_name','c_id','a_id','name','image_url','status','tags')
    	    ->join('category','novel.c_id','=','category.id')//连分类表
    		->join('author','novel.a_id','=','author.id')
    		->orderBy('novel.id','desc')
    		->paginate(4);
    }

    //小说添加
    public function addRecord($data)
    {
    	return self::insert($data);
    }

    //小说修改
    public function editRecord($data, $id)
    {
    	return self::where('id',$id)->update($data);    
    }

    //执行删除操作
    public function delRecord($id)
    {
    	return self::where('id',$id)->delete();
    }

    //获取小说详情
    public function getNovelInfo($id)
    {
    	return self::where('id', $id)->first();
    }


    //获取小程序首页的banner图
    public function getBanners($num =3)
    {
        $list = self::select('id','image_url')
                ->orderBy('id','desc')
                ->limit($num)
                ->get()
                ->toArray();


        return $list;
    }

    //获取最新小说
    public function getNews($num = 3)
    {
        $list = self::select('novel.id','name','image_url','author_name','tags','desc')
                    ->leftJoin('author','novel.a_id','=','author.id')
                    ->orderBy('novel.id','desc')
                    ->limit($num)
                    ->get()
                    ->toArray();

        return $list;
    }

    //获取首页点击排行
    public function getClicks($num = 3)
    {
        $list = self::select('novel.id','name','image_url','author_name','tags','desc','status','clicks')
                    ->leftJoin('author','novel.a_id','=','author.id')
                    ->orderBy('novel.clicks','desc')
                    ->limit($num)
                    ->get()
                    ->toArray();

        return $list;
    }

     //获取阅读排行
    public function getReadRank($num = 8)
    {
        $list = self::select('novel.id','name','read_num')
                    ->leftJoin('author','novel.a_id','=','author.id')
                    ->orderBy('novel.read_num','desc')
                    ->limit($num)
                    ->get()
                    ->toArray();

        return $list;
    }

    //通过分类id查询小说列表啊
    public function getNovelByCid($cid)
    {
         $list = self::select('novel.id','name','image_url','author_name','tags','desc','status','clicks')
                    ->leftJoin('author','novel.a_id','=','author.id')
                    ->where('novel.c_id',$cid)
                    ->orderBy('id','desc')
                    ->get()
                    ->toArray();

        return $list;
    }

    //通过小说名字搜索小说列表
    public function getNovelByName($name)
    {
        $list = self::select('novel.id','name','image_url','author_name','tags','status','clicks')
                    ->leftJoin('author','novel.a_id','=','author.id')
                    ->where('novel.name','like', '%'.$name.'%')
                    ->orWhere('author_name',$name)
                    ->orderBy('id','desc')
                    ->get()
                    ->toArray();

        return $list;
    }
}
