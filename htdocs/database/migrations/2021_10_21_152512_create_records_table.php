<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('genre_id');    // shorthand for $table->unsignedBigInteger('id');
            $table->string('artist');
            $table->string('title');
            $table->string('title_mbid', 36)->nullable();
            $table->string('cover')->nullable();
            $table->float('price', 5, 2)->default(19.99);
            $table->unsignedInteger('stock')->default(1);
            $table->timestamps();

            // Foreign key relation
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade')->onUpdate('cascade');
        });
        // Insert some records (inside up-function, after create method)
        DB::table('records')->insert(
            [
                [
                    'genre_id' => 1,
                    'created_at' => now(),
                    'stock' => 1,
                    'artist' => 'Queen',
                    'title' => 'Greatest Hits',
                    'title_mbid' => 'fcb78d0d-8067-4b93-ae58-1e4347e20216',
                    'cover' => null,
                    'price' => 19.99
                ],
                [
                    'genre_id' => 1,
                    'created_at' => now(),
                    'stock' => 1,
                    'artist' => 'The Rolling Stones',
                    'title' => 'Sticky Fingers',
                    'title_mbid' => 'd883e644-5ec0-4928-9ccd-fc78bc306a46',
                    'cover' => null,
                    'price' => 21.00
                ],
                [
                    'genre_id' => 1,
                    'created_at' => now(),
                    'stock' => 0,
                    'artist' => 'The Beatles',
                    'title' => 'Abbey Road',
                    'title_mbid' => 'd6010be3-98f8-422c-a6c9-787e2e491e58',
                    'cover' => null,
                    'price' => 24.99
                ],
                [
                    'genre_id' => 1,
                    'created_at' => now(),
                    'stock' => 3,
                    'artist' => 'The Who',
                    'title' => 'Tommy',
                    'title_mbid' => 'fceaca05-a210-4f92-9e88-1e8b44ec8e37',
                    'cover' => null,
                    'price' => 12.50
                ],
                [
                    'genre_id' => 1,
                    'created_at' => now(),
                    'stock' => 1,
                    'artist' => 'Fleetwood Mac',
                    'title' => 'Rumours',
                    'title_mbid' => '081ea37e-db59-4332-8cd2-ad020cb93af6',
                    'cover' => null,
                    'price' => 19.99
                ],
                [
                    'genre_id' => 1,
                    'created_at' => now(),
                    'stock' => 0,
                    'artist' => 'David Bowie',
                    'title' => '"Heroes"',
                    'title_mbid' => 'f0a4ed57-10e0-4c37-81b4-36311dc7d4b6',
                    'cover' => null,
                    'price' => 19.99
                ],
                [
                    'genre_id' => 1,
                    'created_at' => now(),
                    'stock' => 3,
                    'artist' => 'David Bowie',
                    'title' => 'The Rise and Fall of Ziggy Stardust and the Spiders From Mars',
                    'title_mbid' => '7dc5edce-ead6-41e4-9c4b-240223c9bab0',
                    'cover' => null,
                    'price' => 24.99
                ],
                [
                    'genre_id' => 1,
                    'created_at' => now(),
                    'stock' => 1,
                    'artist' => 'Steve Harley & Cockney Rebel',
                    'title' => 'The Psychomodo',
                    'title_mbid' => '88776dcc-072e-4072-bc25-8b970a3f055e',
                    'cover' => 'https://coverartarchive.org/release/4650b4c9-6cc2-4139-a46d-58b9f40a697b/front-250.jpg',
                    'price' => 9.99
                ],
                [
                    'genre_id' => 1,
                    'created_at' => now(),
                    'stock' => 4,
                    'artist' => 'Roxy Music',
                    'title' => 'Siren',
                    'title_mbid' => 'c2dad882-7804-416d-980e-d06b8405e9cf',
                    'cover' => null,
                    'price' => 24.00
                ],
                [
                    'genre_id' => 3,
                    'created_at' => now(),
                    'stock' => 4,
                    'artist' => 'Ministry',
                    'title' => 'The Land of Rape and Honey',
                    'title_mbid' => '4bcaf5b9-76ba-4891-934b-1a441c62b008',
                    'cover' => 'https://coverartarchive.org/release/8fc6c9e6-5541-39de-b1e6-67157bc75646/10665793150-250.jpg',
                    'price' => 19.99
                ],
                [
                    'genre_id' => 3,
                    'created_at' => now(),
                    'stock' => 2,
                    'artist' => 'Front 242',
                    'title' => 'Front by Front',
                    'title_mbid' => '97508279-e7d3-4303-8f2a-483119ce41c7',
                    'cover' => 'https://coverartarchive.org/release/feaf508a-ef4d-4680-8bf0-0f92bcf35048/6564772390-250.jpg',
                    'price' => 16.49
                ],
                [
                    'genre_id' => 3,
                    'created_at' => now(),
                    'stock' => 3,
                    'artist' => 'Nine Inch Nails',
                    'title' => 'Pretty Hate Machine',
                    'title_mbid' => '8f156938-6462-3b3e-84ba-bfc7dd232c34',
                    'cover' => null,
                    'price' => 25.00
                ],
                [
                    'genre_id' => 3,
                    'created_at' => now(),
                    'stock' => 0,
                    'artist' => 'Einstürzende Neubauten',
                    'title' => 'Halber Mensch',
                    'title_mbid' => '94b93f48-6357-49fd-affa-7c07db1f131b',
                    'cover' => null,
                    'price' => 14.00
                ],
                [
                    'genre_id' => 5,
                    'created_at' => now(),
                    'stock' => 5,
                    'artist' => 'The Police',
                    'title' => 'Outlandos d\'Amour',
                    'title_mbid' => 'e07a2c71-dde7-37a3-8b02-44d25dd128f9',
                    'cover' => null,
                    'price' => 19.99
                ],
                [
                    'genre_id' => 5,
                    'created_at' => now(),
                    'stock' => 2,
                    'artist' => 'Japan',
                    'title' => 'Oil on Canvas',
                    'title_mbid' => 'a7472800-543f-44a1-a299-7bd07b80e9a8',
                    'cover' => 'https://coverartarchive.org/release/80910883-e38d-48b3-b1dc-8e36365e94d8/10519153003-250.jpg',
                    'price' => 9.99
                ],
                [
                    'genre_id' => 5,
                    'created_at' => now(),
                    'stock' => 4,
                    'artist' => 'The Cure',
                    'title' => 'Disintegration',
                    'title_mbid' => '11af85e2-c272-4c59-a902-47f75141dc97',
                    'cover' => null,
                    'price' => 26.00
                ],
                [
                    'genre_id' => 5,
                    'created_at' => now(),
                    'stock' => 2,
                    'artist' => 'Talking Heads',
                    'title' => 'Stop Making Sense',
                    'title_mbid' => '5f4ad828-bb45-4867-9ae9-295cfe22449d',
                    'cover' => null,
                    'price' => 9.90
                ],
                [
                    'genre_id' => 2,
                    'created_at' => now(),
                    'stock' => 1,
                    'artist' => 'Sex Pistols',
                    'title' => 'Never Mind the Bollocks',
                    'title_mbid' => '11c6c574-6442-45f8-9c25-110675725f2f',
                    'cover' => null,
                    'price' => 15.00
                ],
                [
                    'genre_id' => 2,
                    'created_at' => now(),
                    'stock' => 1,
                    'artist' => 'The Clash',
                    'title' => 'London Calling',
                    'title_mbid' => '7bec22a0-eb73-4b79-a619-b253d5c2af87',
                    'cover' => null,
                    'price' => 11.99
                ],
                [
                    'genre_id' => 12,
                    'created_at' => now(),
                    'stock' => 2,
                    'artist' => 'Atari Teenage Riot',
                    'title' => 'The Future of War',
                    'title_mbid' => 'fcba15e2-3d1e-40b3-996c-be22450bda82',
                    'cover' => 'https://coverartarchive.org/release/aeaef39a-879d-41d1-8f6e-298cbee17771/21867740528-250.jpg',
                    'price' => 21.50
                ],
                [
                    'genre_id' => 12,
                    'created_at' => now(),
                    'stock' => 3,
                    'artist' => 'Sonic Youth',
                    'title' => 'EVOL',
                    'title_mbid' => '22079997-d0d3-449a-83e0-e8ac1942740f',
                    'cover' => null,
                    'price' => 24.99
                ],
                [
                    'genre_id' => 2,
                    'created_at' => now(),
                    'stock' => 5,
                    'artist' => 'H₂O',
                    'title' => 'Nothing to Prove',
                    'title_mbid' => '60464f78-9697-4458-adfd-0e2a0109c9f5',
                    'cover' => 'https://coverartarchive.org/release/52937b1d-9124-4116-af39-f650ebacdd84/front-250.jpg',
                    'price' => 18.99
                ],
                [
                    'genre_id' => 2,
                    'created_at' => now(),
                    'stock' => 5,
                    'artist' => 'Turnstile',
                    'title' => 'Time & Space',
                    'title_mbid' => '36a6b0c0-24d3-4cae-9e7c-96ba0da9a331',
                    'cover' => 'https://coverartarchive.org/release/c05b7ae0-dab4-46b4-a5f8-2e7510eba1fb/front-250.jpg',
                    'price' => 24.99
                ],
                [
                    'genre_id' => 4,
                    'created_at' => now(),
                    'stock' => 5,
                    'artist' => 'Guns N\' Roses',
                    'title' => 'Appetite for Destruction',
                    'title_mbid' => 'b6945872-411f-4bf5-824b-7b319148a264',
                    'cover' => null,
                    'price' => 24.99
                ],
                [
                    'genre_id' => 2,
                    'created_at' => now(),
                    'stock' => 1,
                    'artist' => 'Off With Their Heads',
                    'title' => 'Home',
                    'title_mbid' => 'ae6938f1-a7a1-4864-892e-778e27f17426',
                    'cover' => null,
                    'price' => 15.99
                ],
                [
                    'genre_id' => 2,
                    'created_at' => now(),
                    'stock' => 2,
                    'artist' => 'Social Distortion',
                    'title' => 'Somewhere Between Heaven and Hell',
                    'title_mbid' => '68f75281-39f2-43fc-a63a-76a8854c777c',
                    'cover' => null,
                    'price' => 15.99
                ],
                [
                    'genre_id' => 7,
                    'created_at' => now(),
                    'stock' => 3,
                    'artist' => 'Bob Marley & The Wailers',
                    'title' => 'Uprising',
                    'title_mbid' => '62ed2ddd-498c-4d93-9b8c-d352d38e9ea9',
                    'cover' => 'https://coverartarchive.org/release/ab20031f-200c-44e8-88fb-4fca32ecbf38/front-250.jpg',
                    'price' => 29.99
                ],
                [
                    'genre_id' => 16,
                    'created_at' => now(),
                    'stock' => 0,
                    'artist' => 'House of Pain',
                    'title' => 'House of Pain',
                    'title_mbid' => 'f9490168-7fa1-4076-a5e2-ee6a246584c6',
                    'cover' => null,
                    'price' => 16.99
                ],
                [
                    'genre_id' => 4,
                    'created_at' => now(),
                    'stock' => 3,
                    'artist' => 'Volbeat',
                    'title' => 'The Strength/The Sound/The Songs',
                    'title_mbid' => '2794f3ec-ff30-4526-ab20-c188edc25024',
                    'cover' => 'https://coverartarchive.org/release/7d5cfc3e-61bd-4361-bfda-1bb18ade16b0/front-250.jpg',
                    'price' => 19.99
                ],
                [
                    'genre_id' => 2,
                    'created_at' => now(),
                    'stock' => 1,
                    'artist' => 'Suicidal Tendencies',
                    'title' => 'Join the Army',
                    'title_mbid' => '6c5e4cc7-9955-4281-a017-463be6e71b09',
                    'cover' => 'https://coverartarchive.org/release/439148c3-0e6a-3f3d-81f3-fea3d09e5280/front-250.jpg',
                    'price' => 14.99
                ],
                [
                    'genre_id' => 2,
                    'created_at' => now(),
                    'stock' => 4,
                    'artist' => 'Cock Sparrer',
                    'title' => 'Forever',
                    'title_mbid' => '4171be5b-6904-40de-b1f7-07c73bbb6690',
                    'cover' => null,
                    'price' => 17.50
                ],
                [
                    'genre_id' => 2,
                    'created_at' => now(),
                    'stock' => 0,
                    'artist' => 'SNFU',
                    'title' => 'The One Voted Most Likely to Succeed',
                    'title_mbid' => 'fcaf21bb-915c-34bb-ab08-abb35588746f',
                    'cover' => null,
                    'price' => 17.50
                ],
                [
                    'genre_id' => 2,
                    'created_at' => now(),
                    'stock' => 2,
                    'artist' => 'Descendents',
                    'title' => 'Milo Goes to College',
                    'title_mbid' => '72837739-550b-3a21-8d7a-3bb898562b6a',
                    'cover' => null,
                    'price' => 32.50
                ],
                [
                    'genre_id' => 7,
                    'created_at' => now(),
                    'stock' => 1,
                    'artist' => 'Peter Tosh',
                    'title' => 'Mama Africa',
                    'title_mbid' => '38d30631-9341-4e62-9d10-2cd372b3e0f4',
                    'cover' => null,
                    'price' => 22.50
                ]
            ]
        );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
