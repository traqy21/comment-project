<?php
namespace Tests\Feature\SysAdmin;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Tests\TestCase;

class PostCommentTest extends TestCase
{

    public function testListUrls(){
        $response = $this->getJson("admin/urls", $this->getHeader());
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'message',
            'data'
        ]);
    }


    public function testViewUrl(){
        $url = factory(Url::class)->create();
        $response = $this->getJson("admin/urls/{$url->id}", $this->getHeader());
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'message',
            'data'
        ]);
    }

    public function testCreateUrl(){
        $header = $this->getHeader();
        $response = $this->postJson("admin/urls", [], $header);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'original_url'
            ]
        ]);


        //null slug
        $url = factory(Url::class)->make();
        $response = $this->postJson("admin/urls", [
            "original_url" => $url->original_url
        ],$header);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'message',
        ]);


        //not null slug
        $url = factory(Url::class)->make();
        $response = $this->postJson("admin/urls", [
            "slug" => $url->slug,
            "original_url" => $url->original_url
        ],$header);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'message',
        ]);

        //not null slug
        $url = factory(Url::class)->make();
        $response = $this->postJson("admin/urls", [
            "original_url" => $url->original_url
        ],$header);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'message',
        ]);
    }


    public function testUpdateUrl(){
        $header = $this->getHeader();

        $createdUrl = factory(Url::class)->create();
        $response = $this->putJson("admin/urls/{$createdUrl->id}", [], $header);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'original_url'
            ]
        ]);

        //null slug
        $updateUrl = factory(Url::class)->make();
        $response = $this->putJson("admin/urls/{$createdUrl->id}", [
            "original_url" => $updateUrl->original_url
        ],$header);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'message',
        ]);

        //not null slug
        $updateUrl = factory(Url::class)->make();
        $response = $this->putJson("admin/urls/{$createdUrl->id}", [
            "slug" => $updateUrl->slug,
            "original_url" => $updateUrl->original_url
        ],$header);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function testDeleteUrl(){
        $header = $this->getHeader();

        $createdUrl = factory(Url::class)->create();
        $response = $this->deleteJson("admin/urls/{$createdUrl->id}", [],$header);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function testGetSlug(){
        $createdUrl = factory(Url::class)->create([
            'original_url' => 'https://www.techinasia.com/car-rental-startup-smove'
        ]);
        $response = $this->getJson("{$createdUrl->slug}");
        $response->assertStatus(301);
    }
}
