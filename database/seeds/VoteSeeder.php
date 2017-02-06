<?php

use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\BxjkVote::truncate();
        App\BxjkVoteSubject::truncate();
        App\BxjkVoteOption::truncate();
        
        for($i=0;$i<=100;$i++){
            $this->realData();
        }

        // factory(App\User::class)->create()->each(function ($u) {
        //     $u->votes()->saveMany(
        //         factory(App\BxjkVote::class, 2)->create([
        //             'uuid' => $u->uuid
        //         ])->each(function($vote) {
        //             $vote->subjects()->saveMany(
        //                 factory(App\BxjkVoteSubject::class, 2)->create([
        //                     'vote_id' => $vote->id
        //                 ])->each(function($subject) {
        //                     $subject->options()->saveMany(
        //                         factory(App\BxjkVoteOption::class, 4)->create([
        //                             'vote_id' => $subject->vote_id,
        //                             'subject_id' => $subject->id
        //                         ])
        //                     );
        //                 })
        //             );
                    
        //         })
        //     );
        // });
    }

    public function realData()
    {
        

        $vote = factory(App\BxjkVote::class)->create([
            'title' => '2016第十期'
        ]);

        $subject1 = factory(App\BxjkVoteSubject::class)->create([
            'vote_id' => $vote->id,
            'title' => '儿童进食时规定进食时间是多久？'
        ]);
        for($i=0;$i<4;$i++){
            factory(App\BxjkVoteOption::class)->create([
                'vote_id' => $subject1->vote_id,
                'subject_id' => $subject1->id,
                'title' => ($i*10).'分钟',
            ]);
        }

        $subject2 = factory(App\BxjkVoteSubject::class)->create([
            'vote_id' => $vote->id,
            'title' => '母乳喂养婴儿辅食添加时间是什么时候？'
        ]);
        for($i=0;$i<4;$i++){
            factory(App\BxjkVoteOption::class)->create([
                'vote_id' => $subject2->vote_id,
                'subject_id' => $subject2->id,
                'title' => $i.'个月'
            ]);
        }

        $subject3 = factory(App\BxjkVoteSubject::class)->create([
            'vote_id' => $vote->id,
            'title' => '7-12月龄婴儿实际需铁量（）推荐摄入？'
        ]);
        for($i=0;$i<4;$i++){
            factory(App\BxjkVoteOption::class)->create([
                'vote_id' => $subject3->vote_id,
                'subject_id' => $subject3->id,
                'title' => '0.72mg/d, 10mg/d'
            ]);
        }

        $subject4 = factory(App\BxjkVoteSubject::class)->create([
            'vote_id' => $vote->id,
            'title' => '面哪一项不是母乳喂养的禁忌症？'
        ]);
        for($i=0;$i<4;$i++){
            factory(App\BxjkVoteOption::class)->create([
                'vote_id' => $subject4->vote_id,
                'subject_id' => $subject4->id,
                'title' => '母亲患有丙型肝炎'
            ]);
        }

        $subject5 = factory(App\BxjkVoteSubject::class)->create([
            'vote_id' => $vote->id,
            'title' => '母乳中维生素D的含量是多少？'
        ]);
        for($i=0;$i<4;$i++){
            factory(App\BxjkVoteOption::class)->create([
                'vote_id' => $subject5->vote_id,
                'subject_id' => $subject5->id,
                'title' => ($i*10).'~'.($i*20).'IU/1000m'
            ]);
        }
    }


        // factory(App\BxjkVote::class)->create([
        //     'title' => '2016第十期'
        // ])->each(function($vote) {
        //     $vote->subjects()->save(
        //         factory(App\BxjkVoteSubject::class)->create([
        //             'vote_id' => $vote->id,
        //             'title' => '儿童进食时规定进食时间是多久？'
        //         ])->each(function($subject) {
        //             $subject->options()->saveMany(
        //                 factory(App\BxjkVoteOption::class, 4)->create([
        //                     'vote_id' => $subject->vote_id,
        //                     'subject_id' => $subject->id
        //                 ])
        //             );
        //         })
        //     );
        //     $vote->subjects()->save(
        //         factory(App\BxjkVoteSubject::class, 2)->create([
        //             'vote_id' => $vote->id,
        //             'title' =>'母乳喂养婴儿辅食添加时间是什么时候？'
        //         ])->each(function($subject) {
        //             $subject->options()->saveMany(
        //                 factory(App\BxjkVoteOption::class, 4)->create([
        //                     'vote_id' => $subject->vote_id,
        //                     'subject_id' => $subject->id
        //                 ])
        //             );
        //         })
        //     );
        //     $vote->subjects()->save(
        //         factory(App\BxjkVoteSubject::class, 2)->create([
        //             'vote_id' => $vote->id,
        //             'title' =>'7-12月龄婴儿实际需铁量（）推荐摄入？'
        //         ])->each(function($subject) {
        //             $subject->options()->saveMany(
        //                 factory(App\BxjkVoteOption::class, 4)->create([
        //                     'vote_id' => $subject->vote_id,
        //                     'subject_id' => $subject->id
        //                 ])
        //             );
        //         })
        //     );
        //     $vote->subjects()->save(
        //         factory(App\BxjkVoteSubject::class, 2)->create([
        //             'vote_id' => $vote->id,
        //             'title' =>'面哪一项不是母乳喂养的禁忌症？'
        //         ])->each(function($subject) {
        //             $subject->options()->saveMany(
        //                 factory(App\BxjkVoteOption::class, 4)->create([
        //                     'vote_id' => $subject->vote_id,
        //                     'subject_id' => $subject->id
        //                 ])
        //             );
        //         })
        //     );
        //     $vote->subjects()->save(
        //         factory(App\BxjkVoteSubject::class, 2)->create([
        //             'vote_id' => $vote->id,
        //             'title' =>'母乳中维生素D的含量是多少？'
        //         ])->each(function($subject) {
        //             $subject->options()->saveMany(
        //                 factory(App\BxjkVoteOption::class, 4)->create([
        //                     'vote_id' => $subject->vote_id,
        //                     'subject_id' => $subject->id
        //                 ])
        //             );
        //         })
        //     );
        // });
    
}
