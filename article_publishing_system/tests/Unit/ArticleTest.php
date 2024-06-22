<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Article;
use App\Models\User;

class ArticleTest extends TestCase
{
    public function testCreateArticle()
    {
        $user = User::where('id', 3)->first();

        $response = $this->actingAs($user)->post('/articles', [
            'article_title' => 'Test Article',
            'article_content' => 'This is a test article content.',
            'is_published' => true,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('articles', [
            'article_title' => 'Test Article',
            'article_content' => 'This is a test article content.',
            'author_id' => $user->id,
            'is_published' => true,
        ]);
    }

    public function testUpdateArticle()
    {
        $user = User::where('id', 3)->first();
        $article = Article::factory()->create(['author_id' => 3]);

        $response = $this->actingAs($user)->put("/articles/{$article->id}", [
            'article_title' => 'Updated Article',
            'article_content' => 'This is an updated article content.',
            'is_published' => true,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'article_title' => 'Updated Article',
            'article_content' => 'This is an updated article content.',
            'is_published' => true,
        ]);
    }


    public function testDeleteArticle()
    {
        $user = User::where('id', 3)->first();
        $article = Article::factory()->create(['author_id' => $user->id]);

        $response = $this->actingAs($user)->delete("/articles/{$article->id}");

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }
}

