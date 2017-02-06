<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BxjkVideo;
use App\BxjkVote;
use App\BxjkVoteSubject;
use App\BxjkVoteOption;
use App\BxjkVoteData;
use App\BxjkMessage;

class BxjkController extends DataController
{
    
    public function video()
    {
        $data = BxjkVideo::orderBy('top', 'desc')->orderBy('created_at', 'desc')->get();
        return $this->response($data);
    }

    public function videoCreate(Request $request)
    {
        return $this->response(BxjkVideo::create($request->all()));
    }

    public function videoUpdate(Request $request)
    {
        $model = BxjkVideo::findOrFail($request->id);
        $model->title = $request->title;
        $model->thumb = $request->thumb;
        $model->vid = $request->vid;
        $model->year = $request->year;
        $model->month = $request->month;

        if($model->save()){
            return $this->response($model);
        }
        Log::error('bxjk_videoUpdate error！');
    }

    public function videoDelete(Request $request)
    {
        $model = BxjkVideo::findOrFail($request->id);

        if($model->delete()){
            return $this->response($model->id);
        }
        Log::error('bxjk_videoDelete error！');
    }

    public function videoTop(Request $request)
    {
        try{
            if($request->id){
                $model = BxjkVideo::findOrFail($request->id);
                $model->top = $request->top;
                if($model->save()){
                    return $this->response($model->id);
                }
            }
        }catch(Exception $e){

        }
    }

    public function vote()
    {
        $data = BxjkVote::orderBy('created_at', 'desc')->get();
        if(count($data)>0){
            return $this->response($data);
        }else{
            return $this->response('', '暂无数据', 204);            
        }
    }

    public function voteCreate(Request $request)
    {
        return $this->response(BxjkVote::create($request->all()));
    }

    public function voteUpdate(Request $request)
    {
        $model = BxjkVote::findOrFail($request->id);
        if($model->fill($request->all())->save()){
            return $this->response($model);
        }
        Log::error('bxjk_videoUpdate error！');
    }

    public function voteDelete(Request $request)
    {
        $model = BxjkVote::findOrFail($request->id);

        if($model->delete()){
            return $this->response($model->id);
        }
        Log::error('bxjk_videoDelete error！');
    }

    public function voteSubjectList(Request $request, $_voteid = 0)
    {
        $_voteid = $request->voteid;
        if($_voteid < 1) {
            return $this->response('','参数异常，请刷新重试!', 400);
        }

        $subjects = BxjkVoteSubject::where('vote_id', $_voteid)->with('options')->get();

        if(count($subjects)>0){
            return $this->response($subjects);
        }else{
            return $this->response('', '没有数据', 204);
        }
    }

    public function voteSubject(Request $request)
    {
        $_type = ['radio'=>1, 'checkbox'=>2];
        $_voteid = 0;
        try{
            foreach($request->all() as $v){
                if($_voteid == 0) $_voteid = $v['vote_id'];
                if(!empty($v['title'])){
                    if(isset($v['id'])){
                        $subject = BxjkVoteSubject::findOrFail($v['id']);
                        $subject->fill($v)->save();
                    }else{
                        $createSubject = BxjkVoteSubject::create([
                            'vote_id' => $v['vote_id'],
                            'title' => $v['title'],
                            'type' => $v['type']
                        ]);
                    }

                    // 保存或者更新option
                    foreach($v['options'] as $option){
                        if(!empty($option['title'])){
                            if(!isset($option['id'])){
                                BxjkVoteOption::create([
                                    'vote_id' => $v['vote_id'],
                                    'subject_id' => isset($v['id'])?$v['id']:$createSubject->id,
                                    'title' => $option['title']
                                ]);
                            }else{
                                $_updateOption = BxjkVoteOption::findOrFail($option['id']);
                                $_updateOption->fill($option)->save();
                            }
                        }
                    }
                }
            }
            // 更新subject
            $subjects = BxjkVoteSubject::where('vote_id', $_voteid)->with('options')->get();
            return $this->response($subjects);
        }catch(Exception $e){
            Log::error('bxjk_vote_subject error!');
            return $this->response('','保存失败，请稍后重试',500);
        }
    }

    public function voteSubjectDelete(Request $request)
    {
        if($subjectId = $request->subjectid){
            if(!BxjkVoteOption::where('subject_id', $subjectId)->exists()){
                BxjkVoteSubject::findOrFail($subjectId)->delete();
                return $this->response('', '删除成功');
            }
            return $this->response('', '请删除选项之后再删除题目', 400);
        }
    }

    public function voteOptionDelete(Request $request)
    {
        if($optionId = $request->optionid){
            BxjkVoteOption::findOrFail($optionId)->delete();
            return $this->response('', '删除成功');
        }
    }

    public function voteData(Request $request)
    {
        if($request->voteid){
            $data = BxjkVoteData::where("vote_id", $request->voteid)->get();
            return $this->response($data);
        }
    }

    public function message(Request $request)
    {
        $data = BxjkMessage::where('type', 1)->orderBy('created_at', 'desc')->get();
        return $this->response($data);
    }
}
