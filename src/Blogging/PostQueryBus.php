<?php declare(strict_types=1);

namespace Blogging;

use Blogging\Contract\GetMyPosts;
use Blogging\Contract\GetMyPostsByTag;
use Blogging\Contract\GetPostTitle;
use Blogging\Contract\GetSinglePost;

interface PostQueryBus extends GetMyPosts, GetMyPostsByTag, GetPostTitle, GetSinglePost
{
}
