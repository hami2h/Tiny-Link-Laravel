<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Seeder;

class LinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Link::truncate();
        $user = User::find(3);

        $links = [
            'https://fanamoozan.com/course/plc-training/',
            'https://fanamoozan.com/course/mobile-repair-training/',
            'https://fanamoozan.com/course/home-appliances-repair-training/'
        ];

        foreach ($links as $link) {
            $this->createLinkForUser($user, $link);
        }
    }


    private function createLinkForUser($user, $link)
    {
        $count = $user->links()->count();

        Link::create([
            'user_id' => $user->id,
            'url' => $link,
            'slug' => $user->id . uniqid() . $count,
        ]);
    }
}
