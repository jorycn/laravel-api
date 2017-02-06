<?php

namespace App\Http\Api;

use Illuminate\Http\Request;
use App\BxjkVideo;
use App\BxjkVote;
use App\BxjkVoteSubject;
use App\BxjkVoteData;
use App\BxjkVoteOption;
use App\BxjkMessage;

class BxjkController extends ApiController
{
    public function video(Request $request)
    {
        $data = BxjkVideo::orderBy('created_at', 'desc')->where(function($query) use ($request){
                    if($request->year) $query->where('year', $request->year);
                    if($request->month) $query->where('month', $request->month);
                    if($request->top) $query->where('top', $request->top);
                });
        if($request->take){
            $data->take($request->take);
        }

        return $this->response($data->get());
    }

    public function vote(Request $request)
    {
        $vote = BxjkVote::select('id', 'title')->findOrFail($request->voteid);
        if($vote){
            $vote->subjects = BxjkVoteSubject::where('vote_id', $request->voteid)->with('options')->get();
            return $this->response($vote);
        }
    }

    public function voteLatest(Request $request)
    {
        $vote = BxjkVote::select('id', 'title')->orderBy('created_at', 'desc')->first();
        if($vote){
            $vote->subjects = BxjkVoteSubject::where('vote_id', $vote->id)->with('options')->get();
            return $this->response($vote);
        }
    }

    public function voteSubmit(Request $request)
    {
        $count = BxjkVoteData::where(function($query) use ($request) {
            $query->where('created_at', '>', date('Y-m-d H:i:s', time()-3600));
            $query->where('ip', $request->getClientIp());
        })->count();

        if($count > 1){
            return $this->response('', '你已经提交过了，请明天再来吧!', 400);
        }

        try{
            $_field = [];
            if(is_array($request->subject)){
                foreach($request->subject as $k=>$v){
                    array_push($_field, ['s'=>$k, 'o'=>$v]);

                    //更新option数
                    $update = BxjkVoteOption::findOrFail($v);
                    $update->count = $update->count + 1;
                    $update->save();
                    //更新subjects数
                    $subjectUpdata = BxjkVoteSubject::findOrFail($k);
                    $subjectUpdata->total = $subjectUpdata->total + 1;
                    $subjectUpdata->save();
                }
            }
            BxjkVoteData::create([
                'vote_id'=> $request->voteid,
                'field'=>json_encode($_field),
                'ip'=>$request->getClientIp()
            ]);

             return $this->response('', '提交成功!');
        }catch(Exception $e){
            Log::error('api_bxjk_voteSubmit'. $e->getMessage());
        }
    }

    public function messageSubmit(Request $request)
    {
        $_clientIp = $request->getClientIp();
        $count = BxjkMessage::where(function($query) use ($request, $_clientIp) {
            $query->where('created_at', '>', date('Y-m-d H:i:s', time()-3600));
            $query->where('ip', $_clientIp);
        })->count();
        
        if($count > 10){
            return $this->response('', '你已经提交过很多次了，请明天再来吧!', 400);
        }

        return $this->response(BxjkMessage::create([
            'content' => e($request->content),
            'type' => 1,
            'ip' => $_clientIp
        ]));
    }
}
