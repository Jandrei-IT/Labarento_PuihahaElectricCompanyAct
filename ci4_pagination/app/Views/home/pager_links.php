<?php

use CodeIgniter\Pager\PagerRenderer;

/** @var PagerRenderer $pager */
$pager->setSurroundCount(2);
$currentPage = $pager->getCurrentPageNumber();
$lastPage    = $pager->getPageCount();
?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="pagination">
        <li class="<?= $currentPage === 1 ? 'disabled' : '' ?>">
            <?php if ($currentPage === 1) : ?>
                <span aria-label="First page" aria-disabled="true"><i class="bi bi-chevron-double-left" aria-hidden="true"></i></span>
            <?php else : ?>
                <a href="<?= $pager->getFirst() ?>" aria-label="First page"><i class="bi bi-chevron-double-left" aria-hidden="true"></i></a>
            <?php endif ?>
        </li>

        <?php foreach ($pager->links() as $link) : ?>
            <li <?= $link['active'] ? 'class="active"' : '' ?>>
                <a href="<?= $link['uri'] ?>" <?= $link['active'] ? 'aria-current="page"' : '' ?>>
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <li class="<?= $currentPage === $lastPage ? 'disabled' : '' ?>">
            <?php if ($currentPage === $lastPage) : ?>
                <span aria-label="Last page" aria-disabled="true"><i class="bi bi-chevron-double-right" aria-hidden="true"></i></span>
            <?php else : ?>
                <a href="<?= $pager->getLast() ?>" aria-label="Last page"><i class="bi bi-chevron-double-right" aria-hidden="true"></i></a>
            <?php endif ?>
        </li>
    </ul>
</nav>