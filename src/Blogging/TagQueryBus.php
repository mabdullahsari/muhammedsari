<?php declare(strict_types=1);

namespace Blogging;

use Blogging\Contract\GetAllTags;
use Blogging\Contract\GetSingleTag;

interface TagQueryBus extends GetAllTags, GetSingleTag {}
