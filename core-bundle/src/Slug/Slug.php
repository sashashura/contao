<?php

declare(strict_types=1);

/*
 * This file is part of Contao.
 *
 * (c) Leo Feyer
 *
 * @license LGPL-3.0-or-later
 */

namespace Contao\CoreBundle\Slug;

use Ausi\SlugGenerator\SlugGeneratorInterface;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\PageModel;
use Contao\StringUtil;

class Slug
{
    /**
     * @internal Do not inherit from this class; decorate the "contao.slug" service instead
     */
    public function __construct(private SlugGeneratorInterface $slugGenerator, private ContaoFramework $framework)
    {
    }

    /**
     * @param int|iterable $options A page ID, object or options array {@see SlugGeneratorInterface::generate()}
     */
    public function generate(string $text, int|iterable $options = [], callable $duplicateCheck = null, string $integerPrefix = 'id-'): string
    {
        if (!is_iterable($options)) {
            $pageAdapter = $this->framework->getAdapter(PageModel::class);

            if (null !== ($page = $pageAdapter->findWithDetails((int) $options))) {
                $options = $page->getSlugOptions();
            } else {
                $options = [];
            }
        }

        $text = StringUtil::prepareSlug($text);
        $slug = $this->slugGenerator->generate($text, $options);

        if (preg_match('/^[1-9]\d*$/', $slug)) {
            $slug = $integerPrefix.$slug;
        }

        if (null === $duplicateCheck) {
            return $slug;
        }

        $base = $slug;

        for ($count = 2; $duplicateCheck($slug); ++$count) {
            $slug = $base.'-'.$count;
        }

        return $slug;
    }
}
