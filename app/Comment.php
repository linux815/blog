<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Article;

/**
 * App\Comment
 *
 * @property int $id
 * @property int $user_id
 * @property int $article_id
 * @property string $comment
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property User $user
 * @property Article $article
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUserId($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    protected $table = 'comments';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'article_id', 'comment', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
