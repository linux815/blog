<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private const PASSWORD = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        if ($this->command->confirm('Fill out the table users, articles, comments, categories fake data? [y/n]')) {
            $administrator = new User();
            $administrator->name = Role::ROLE_ADMINISTRATOR;
            $administrator->email = 'admin@app.com';
            $administrator->password = self::PASSWORD;
            $administrator->save();

            $role = Role::where('name', Role::ROLE_ADMINISTRATOR)->first();
            $administrator->attachRole($role);

            $editor = new User();
            $editor->name = Role::ROLE_EDITOR;
            $editor->email = 'editor@app.com';
            $editor->password = self::PASSWORD;
            $editor->save();

            $role = Role::where('name', Role::ROLE_EDITOR)->first();
            $editor->attachRole(Role::ROLE_EDITOR);

            $editorTwo = new User();
            $editorTwo->name = Role::ROLE_EDITOR . '_' . 2;
            $editorTwo->email = 'editor_2@app.com';
            $editorTwo->password = self::PASSWORD;
            $editorTwo->save();
            $editorTwo->attachRole($role);

            $editorBlocked = new User();
            $editorBlocked->name = Role::ROLE_EDITOR . '_' . 3;
            $editorBlocked->email = 'editor_3@app.com';
            $editorBlocked->password = self::PASSWORD;
            $editorBlocked->save();
            $editorBlocked->attachRole($role);
            $editorBlocked->delete();

            // Two categories, each with one article;
            $category = factory(\App\Category::class)->create();
            $article = factory(\App\Article::class)->create(['user_id' => $editor->id, 'category_id' => $category->id]);
            $category = factory(\App\Category::class)->create();
            $articleTwo = factory(\App\Article::class)->create(['user_id' => $editorTwo->id, 'category_id' => $category->id]);

            // Two comments
            factory(\App\Comment::class, 2)->create(['user_id' => $editor->id, 'article_id' => $articleTwo->id]);
            factory(\App\Comment::class, 2)->create(['user_id' => $editorTwo->id, 'article_id' => $article->id]);

            $this->command->info('Table successfully filled with fake data');
        }
    }
}
